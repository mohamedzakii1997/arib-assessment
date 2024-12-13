<?php

namespace App\Services;


use App\Models\User;
use App\Repositories\DepartmentRepository;

use App\Repositories\TaskRepository;
use App\Resources\DepartmentResource;
use App\Resources\TaskResource;
use App\Resources\UserResource;
use App\Traits\ApiResponses;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class AuthService extends LaravelServiceClass
{
    use ApiResponses;


    public function login($request)
    {
        $validatedData = $request->validated();


        $credentials = ['password' => $validatedData['password']]; // Always require password

        $type = 1 ; // 1 for email 2 for phone

        // Check if the input is an email or phone
        if (filter_var($validatedData['login'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $validatedData['login'];
        } elseif (preg_match('/^\+?[0-9]{10,15}$/', $validatedData['login'])) {
            $type = 2;
            $credentials['phone'] = $validatedData['login'];
        }


        if (! Auth::attempt($credentials)){

            $this->error('Invalid Credentials ',401);
        }

        if ($type == 1)
            $user = User::firstWhere('email',$credentials['email']);
        else
            $user = User::firstWhere('phone',$credentials['phone']);



        $user->tokens()->delete();
        return $this->ok(
            'Authenticated' ,
            [
                'token'=> $user->createToken('API token for')->plainTextToken,
                'user'=>UserResource::make($user),
            ]

        );

    }

    public function logout($request = null)
    {
        $request->user()->currentAccessToken()->delete();
        Session::forget(['api_token','user']);
        return $this->ok('Logged out successfully');

    }







}
