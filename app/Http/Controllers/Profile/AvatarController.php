<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
        // $path = $request->file('avatar')->store('avatars', 'public');

        if ($oldAvatar = $request->user()->avatar) {
            Storage::disk('public')->delete($oldAvatar);
        }

        Auth::user()->update(['avatar' => $path]);

        return Redirect::route('profile.edit')->with('message', 'Avatar updated successfully!');
    }
}
