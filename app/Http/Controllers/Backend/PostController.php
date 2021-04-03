<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

date_default_timezone_set('Asia/Jakarta');


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->latest()->paginate(5);
        return view('backend.post.index', compact('posts'));
    }

    public function create()
    {
        $user = User::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('title', 'asc')->get();
        return view('backend.post.create', compact('user', 'categories'));
    }

    public function store(Request $request)
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

        return redirect()->route('posts.index')->with('success', 'You have successfully created post.')->with('image', $fileName);
    }


    public function show(Post $post)
    {
        return view('backend.post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $user = User::orderBy('name', 'asc')->get();
        $categories = Category::orderBy('title', 'asc')->get();
        return view('backend.post.edit', compact('post', 'user', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image' => 'max:2048|mimes:jpg,jpeg,png',
            'content' => 'required'    
        ]);

        $posts = Post::find( $post->id );

            //jika gambar lama di ubah artinya upload gambar baru
        if ( $request->image ) {
            if ( file_exists( public_path('img/post/' . $post->image ) ) ) {
                unlink( public_path('img/post/' . $post->image) );
        }
            
        $fileName = time().'.'.$request->image->extension();
        $request->image->move(public_path('img/post'), $fileName);

            // mengubah gambar yg di database
            $posts->image = $fileName;

        //gambar lama tidak diubah
        }else {
            $fileName = 'No Image Upload';
        }

        $posts->user_id = $request->user_id;
        $posts->category_id = $request->category_id;
        $posts->title = $request->title;
        $posts->slug = $request->slug;
        $posts->content = $request->content;
        $posts->update();
    
    return redirect()->route('posts.index')->with('success', 'You have successfully edited post.')->with('image', $fileName);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        ///di cek ada atau tidak filenya dan kondisinya harus true
        if (file_exists( public_path('img/post/'. $post->image) ) ){
            //menghapus gambar di folder public
            unlink (public_path('img/post/'. $post->image) );
        }

        Post::destroy($post->id);
        return redirect()->route('posts.index')->with('success', 'You have successfully deleted post.');
    }
}
