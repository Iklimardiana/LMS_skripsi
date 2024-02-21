<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.view', compact('profile'));
    }
    public function editProfile($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.edit', compact('profile'));
    }
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'avatar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'required',
            'entry_year' => 'required_if:role,student',
            'gender' => 'required'
        ]);

        $profile = User::findOrFail($id);

        $attributes = ['first_name', 'last_name', 'email', 'phone', 'gender', 'entry_year'];

        foreach ($attributes as $attribute) {
            if ($request->filled($attribute) && $request->input($attribute) !== $profile->{$attribute}) {
                $profile->{$attribute} = $request->input($attribute);
            }
        }

        if ($request->has('avatar')) {
            $path = "images/avatar/";

            if ($profile->avatar && $profile->avatar !== 'avatarDefault.png') {
                File::delete($path . $profile->avatar);
            }

            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('images/avatar/'), $avatarName);
            $profile->avatar = $avatarName;
        }

        $request->session()->flash('toast', [
            'type' => 'success',
            'message' => 'Profil berhasil diperbarui!'
        ]);

        $profile->save();

        return redirect('/' . $profile->role . '/profile/' . $id);
        // return redirect('/' . $profile->role . '/profile/' . $id . '?status=success');
    }
}
