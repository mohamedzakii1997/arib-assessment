<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Resources\UserResource;
use App\Services\AuthService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

    class AuthController extends Controller
    {


        protected $authService;

        public function __construct(AuthService $authService)
        {
            $this->authService = $authService;
        }

        public function login(LoginUserRequest $request)
        {
            $result = $this->authService->login($request);
            return $result;
        }

    public function logout(Request $request)
    {

        $result = $this->authService->logout($request);
        return $result;
    }



    }
