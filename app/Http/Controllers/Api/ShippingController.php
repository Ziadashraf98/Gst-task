<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Http\Resources\ShippingResource;
use App\Models\shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
    public function index()
    {
        $shipping = shipping::all();
        return response(['success'=>true , 'data'=>ShippingResource::collection($shipping)]);
    }

    public function store(ShippingRequest $request)
    {
        $shipping = shipping::create([
            'lat'=>$request->lat,
            'long'=>$request->long,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country,
            'notes'=>$request->notes,
            'phone_number'=>Auth::user()->phone_number,
        ]);
        
        return response(['success'=>true , 'data'=>$shipping]);
    }

    public function update($id , ShippingRequest $request)
    {
        $shipping = shipping::where('phone_number' , Auth::user()->phone_number)->findOrFail($id);
        
        $shipping->update([
            'lat'=>$request->lat,
            'long'=>$request->long,
            'address'=>$request->address,
            'city'=>$request->city,
            'country'=>$request->country,
            'notes'=>$request->notes,
        ]);

        return response(['success'=>true , 'data'=>$shipping]);
    }
}
