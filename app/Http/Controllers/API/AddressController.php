<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index($user)
    {
        $address = Address::whereUserId($user)->get();
        return response()->json($address);
    }

    public function create(User $user, Request $request)    
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:11'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);
        
        $user->addresses()->save(new Address($data));
        return response()->json(true);
    }
}