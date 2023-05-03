<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => ['required'],
            'lastName' => ['required'],
            'day' => ['required'],
            'month' => ['required'],
            'year' => ['required'],
            'email' => ['required', 'unique:users', 'max:255'],
            'phone' => ['required', 'unique:users', 'max:10', 'min:10'],
        ]);

        $dobStr = $request->year."-".$request->month."-".$request->day;
        
        $userObj = new User();

        $userObj->name = $request->firstName." ".$request->lastName;
        $userObj->email = $request->email;
        $userObj->phone = $request->phone;
        $userObj->dob = date("Y-m-d", strtotime($dobStr));
        $userObj->ip_address = $request->ipAddress;
        $userObj->user_agent = $request->userAgent;
        $userObj->device_type = $request->deviceType;
        $userObj->browser = $request->browser;
        $userObj->save();

        $id = $userObj->id;

        return response(['id' => $id, 'msg' => 'User created Successfully', 201]);
    }
}
