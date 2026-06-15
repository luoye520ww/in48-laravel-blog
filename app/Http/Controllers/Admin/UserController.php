<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $data['password'] = \Hash::make($data['password']);

        // $user = new User;
        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // $user->password = \Hash::make($data['password']);
        // $user->save();

        User::create($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id], // unique:users,email,{id}
            'password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        if ($data['password']) {
            $data['password'] = \Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        // $user->name = $data['name'];
        // $user->email = $data['email'];
        // if ($data['password']) $user->password = $data['password'];
        // $user->save();

        $user->update($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) { // auth()->id()
            return back();
        }

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
