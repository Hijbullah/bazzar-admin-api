<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAddressRequest;
use App\Http\Resources\Address as AddressResource;

class AddressController extends Controller
{
    public function index($user)
    {
        return AddressResource::collection(Address::whereUserId($user)->get());
    }

    public function create(User $user, StoreAddressRequest $request)    
    {
        $data = $request->validated();
        $address = $user->addresses()->save(new Address($data));
        return new AddressResource($address);
    }

    public function edit(Address $address, StoreAddressRequest $request)
    {
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->city = $request->city;
        $address->address = $request->address;
        $address->save();

        return new AddressResource($address);
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return response()->json(['message' => 'Address deleted']);
    }
}