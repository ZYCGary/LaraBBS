<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    // Show user's profile page
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Show user's profile edition page
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update user's profile changes
    public function update(UserRequest $request, User $user)
    {
        // Use FromRequest to handle the validation of requrests
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', 'Update your profile successfully!');
    }
}
