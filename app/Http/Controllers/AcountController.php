<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AcountController extends Controller
{
    public function acount()
    {
        $address = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();
        return view('user.acount.acount', compact('address'));
    }
    public function acountProfile()
    {
        return view('user.acount.acount');
    }
    public function acountNewAddress(Request $request)
    {
        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->name = $request->name_address;
        $address->phone = $request->phone_address;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->home_address = $request->home_address;
        $address->save();


        $getAddress = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();

        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }

    public function acountEditAddress(Request $request)
    {
        $address = Address::find($request->id);
        // return response()->json($address);
        $view = view("user.acount.address.edit", [
            "address" => $address
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }

    public function acountUpdateAddress(Request $request)
    {
        $address = Address::find($request->id);
        $address->name = $request->name_address;
        $address->phone = $request->phone_address;
        $address->city = $request->city;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->home_address = $request->home_address;
        $address->save();

        $getAddress = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->orderBy('id', 'desc')->get();
        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }

    public function acountDeleteAddress()
    {
        Address::where('id', $_POST['id'])->delete();
        $getAddress = Address::where("user_id", auth()->user()->id)->OrderBy("type", "desc")->OrderBy('id', 'desc')->get();

        $view = view("user.acount.address.list", [
            "address" => $getAddress
        ])->render();

        return response()->json([
            'view' => $view,
            'status' => 'success'
        ], 200);
    }
    public function acountAddressDefault(Request $request)
    {

        if (!empty($request->id)) {
            foreach(Address::where('user_id', auth()->user()->id)->get() as $address){
                $address->type = 0;
                $address->save();
            }

            $address = Address::find($request->id);
            $address->type = 1;
            $address->save();

            $getAddress = Address::where('user_id', auth()->user()->id)->orderBy('type', 'desc')->get();

            $view = view("user.acount.address.list", [
                "address" => $getAddress
            ])->render();

            return response()->json([
                'view' => $view,
                'status' => 'success'
            ], 200);

        }
    }
}
