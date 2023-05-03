<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(Request $request)
    {
        $addresses = $request->address;
        $userId = $request->userId;

        $addressObj = Address::where('user_id', $userId)->first();

        if (empty($addressObj)) {
            $addressObj = new Address();
        }

        $addressObj->user_id = $userId;

        if (isset($addresses[1])) {
            $addressObj->address1 = json_encode($addresses[1]);
        }

        if (isset($addresses[2])) {
            $addressObj->address2 = json_encode($addresses[2]);
        }

        if (isset($addresses[3])) {
            $addressObj->address3 = json_encode($addresses[3]);
        }

        $addressObj->save();

        return response(['msg' => 'Address saved Successfully', 201]);
    }
}
