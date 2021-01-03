<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function updateProfile(User $user, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:11'],
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return response()->json([
            'message' => 'Profile updated!',
            'user' => $user
        ]);
    }

    public function changePassword(User $user, Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8', new MatchOldPassword($user)],
            'new_password' => ['required', 'string', 'confirmed', 'min:8']
        ]);

        $user->fill([
            'password' => Hash::make($request->new_password)
        ])->save();

        return response()->json(['message' => 'password change successfull']);
    }
}
