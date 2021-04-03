<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

date_default_timezone_set('Asia/Jakarta');

class ContributorController extends Controller
{
    public function postedit($id = null)
    {
        $post = Post::find($id);

        if ($post) {
            return view('contributor.post.edit', compact('post'));
        } else {
            return redirect()->route('contributor.post.manage')->with('error', 'The ID #'.$id.' not found in database!');
        }
    }
    public function postupdate(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image' => 'max:2048|mimes:jpg,jpeg,png',
            'content' => 'required'
        ]);
    
        $posts = Post::find($request->id);

        // jika gambar lama di ubah artinya upload gambar baru
        if ( $request->image ) {
            if ( file_exists( public_path('img/post/' . $posts->image) ) ) {
                unlink( public_path('img/post/' . $posts->image) );
            }
            
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path('img/post'), $fileName);

            $posts->image = $fileName;
        // gambar lama tidak di ubah
        } else {
            $fileName = 'No Image Upload.';
        }

        $posts->user_id = $request->user_id;
        $posts->category_id = $request->category_id;
        $posts->title = $request->title;
        $posts->slug = $request->slug;
        $posts->content = $request->content;
        $posts->save();

        return redirect()->route('contributor.post.manage')->with('success', 'You have successfully update post.')->with('image', $fileName);
    }

    public function destroy(Post $post)
    {
        // echo "<pre>";
        // print_r($post->id);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($post->image);
        // echo "</pre>";

        //di cek ada atau tidak filenya dan kondisinya harus true
        if (file_exists( public_path('img/post/'. $post->image) ) ){
            //menghapus gambar di folder public
            unlink (public_path('img/post/'. $post->image) );
        }

        Post::destroy($post->id);
        return redirect()->route('posts.index')->with('success', 'You have successfully deleted post.');
    }


    public function postshow($id = null) 
    {
        $post = Post::find($id);

        if ($post) {
            return view('contributor.post.show', compact('post'));
        } else {
            return redirect()->route('contributor.post.manage')->with('error', 'The ID #'.$id.' not found in database!');
        }
    }

    public function postdestroy(Request $request) 
        {
            $post = Post::find($request->id);

             //di cek ada atau tidak filenya dan kondisinya harus true
            if (file_exists( public_path('img/post/'. $post->image) ) ){
            //menghapus gambar di folder public
            unlink (public_path('img/post/'. $post->image) );
        }

        $post->delete();
        return redirect()->route('contributor.post.manage')->with('success', 'You have successfully deleted post.');
        }

    public function editpassword()
    {
        $user = User::find(Auth::id());
        return view('contributor.contributor.editpassword', compact('user'));
    }

    public function showprofile()
    {
        $user = User::find(Auth::id());
        return view('contributor.contributor.showprofile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate(
                [
                'name' => 'required|min:3|max:25|regex:/^[a-zA-Z]+$/u',
                'email' => 'required|email',
                'password' => 'max:12'
            ],
            [
                'name.regex' => 'The name field must be letter.'
            ]
        );

        $data = User::find($request->id);
        
        $data->name = $request->name;
        $data->email = $request->email;

        if ( ! empty($request->password) ) {
            $data->password = $request->password;
        }
        $data->save();

        return redirect()->route('contributor.post.manage')->with('success', 'You have successfully updated your profile.');
    }

    public function postmanage()
        {
            $posts = Post::where('user_id', Auth::id())->orderBy('id', 'desc')->latest()->paginate(15);
            return view('contributor.post.manage', compact('posts'));
        }

    public function postcreate()
        {
            $user = User::orderBy('name', 'asc')->get();
            $categories = Category::orderBy('title', 'asc')->get();
            return view('contributor.post.create', compact('user','categories'));
        }
        
    public function poststore(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'image' => 'required|max:2048|mimes:jpg,jpeg,png',
            'content' => 'required'

        ]);

        $fileName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img/post'), $fileName);

        $posts = new Post;
        $posts->user_id = $request->user_id;
        $posts->category_id = $request->category_id;
        $posts->title = $request->title;
        $posts->slug = $request->slug;
        $posts->image = $fileName;
        $posts->content = $request->content;
        $posts->save();

        return redirect()->route('contributor.post.manage')->with('success', 'You have successfully created post.');
    }
    
}