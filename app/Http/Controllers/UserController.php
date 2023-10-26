<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function show(string $id)
    {
        return User::findOrfail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }

    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user -> name = $validated['name'];

        $user -> save();

        return $user;
    }

    public function email(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->email = $validated['email'];

        $user->save();

        return $user;
    }

    public function password(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->password = Hash::make($validated['password']);
        $user->save();

        return $user;
    }



    public function delete(string $id)
    {
        $user = User::findOrfail($id);

        $user->delete();

        return $user;
    }
}
