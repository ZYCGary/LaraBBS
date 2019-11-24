<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

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
    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'Your profile is updated successfully!!');
    }
}
