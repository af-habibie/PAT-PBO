<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

date_default_timezone_set('Asia/Jakarta');

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('is_admin', 0)->orderBy('id', 'desc')->latest()->paginate(15);
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:25|regex:/^[a-zA-Z ]+$/u',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6|max:12'
            ],
            [
                'name.regex' => 'The name field must be letter.'
            ]);
        
            $users = new User;
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;
            $users->save();

        return redirect()->route('users.index')->with('success', 'You have successfully create user.');
    }

    public function show(User $user)
    {
        return view('backend.user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required|min:3|max:25|regex:/^[a-zA-Z ]+$/u',
                'email' => 'required|email',
                'password' => 'max:12',
                'photo' => 'max:2048|mimes:jpg,jpeg,png'
            ],
            [
                'name.regex' => 'The name field must be letter.'
            ]
        );

        $data = User::find($user->id);

        $data->name = $request->name;
        $data->email = $request->email;

        if ( ! empty($request->password) ) {
            $data->password = $request->password;
        }
        
        $data->save();

        return redirect()->route('users.index')->with('success', 'You have successfully update user.');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->route('users.index')->with('success', 'You have successfully delete user.');
    }
}
