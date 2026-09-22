<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/** The signed-in user's own account: display name, profile photo and password. */
class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name'   => 'required|string|max:80',
            'avatar' => 'nullable|image|max:4096',
            'remove_avatar' => 'nullable|boolean',
        ]);

        $user->name = $data['name'];

        if ($request->boolean('remove_avatar') && $user->avatar) {
            @unlink(public_path($user->avatar));
            $user->avatar = null;
        }
        if ($request->hasFile('avatar')) {
            $dir = public_path('uploads/avatars');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            if ($user->avatar) {
                @unlink(public_path($user->avatar));
            }
            $file = $request->file('avatar');
            $name = 'user_'.$user->id.'_'.time().'.'.$file->getClientOriginalExtension();
            $file->move($dir, $name);
            $user->avatar = 'uploads/avatars/'.$name;
        }
        $user->save();

        return back()->with('ok', 'Profile updated');
    }

    public function password(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:6|confirmed',
        ]);
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->with('ok', 'Current password is incorrect.');
        }
        $user->password = Hash::make($data['password']);
        $user->save();

        return back()->with('ok', 'Password changed');
    }
}
