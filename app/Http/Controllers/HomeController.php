<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('home', ["resultUser" => $user]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("users.show", ["resultChoosenUser" => $user]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('home')->with('messagedeleteuser', 'User Deleted Successfully');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pass' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($validatedData['pass']),
            'role' => $request->role,
            'status' => $request->status,
        ]);
        return redirect()->route('home')->with('createmessage', 'User Created Successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function updatestore(Request $request, $id)
    {
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id)
            ],
            'role' => 'required',
            'status' => 'required',
        ]);

        // Find user
        $user = User::findOrFail($id);

        // Update user fields
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->status = $request['status'];

        // Update password only if provided
        if (!empty($request['pass'])) {
            $user->password = Hash::make($request['pass']);
        }

        $user->save();

        return redirect()->route('home')->with('createmessage', 'User Updataed Successfully');
    }
}
