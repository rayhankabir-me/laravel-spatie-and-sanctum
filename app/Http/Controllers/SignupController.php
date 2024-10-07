<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    //register method
    public function register(SignupRequest $request)
    {


        $user = User::create([
            'name' => $request->post('name'),
            'username' => Str::slug($request->post('name')) . rand(1, 500),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'country_code' => $request->post('country_code'),
            'email_verified_at' => Carbon::now()->getTimestamp(),
            'is_guest' => 10,
            'password' => Hash::make($request->post('password'))
        ]);
        $user->assignRole(UserRole::CUSTOMER);
        if ($user) {
            return response(['status' => true, 'message' => 'registration successfully done..']);
        } else {
            return response(['status' => false, 'message' => "registration failed.."], 422);
        }
    }
}
