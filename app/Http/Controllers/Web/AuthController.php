<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Resources\UserResource;
use App\Services\ApiService;
use App\Services\AuthService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{



    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }



    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(LoginUserRequest $request)
    {


        $credentials = ['password' => $request['password']];
        //$response  = $this->authService->login($request);
        //$result = $response->getData(true);
        // Check if the response contains the necessary data
//        if ($response->status() !== 200 || empty($result['data']['token'])) {
//            return back()->withErrors(['login' => $result['message'] ?? 'Invalid credentials']);
//        }

       // $token = $result['data']['token'];
        //$user = $result['data']['user'];

        // Store token in the session
       // session(['api_token' => $token]);

        //dd($response['user']);



        // Check if login is email or phone
        if (filter_var($request['login'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request['login'];
        } elseif (preg_match('/^\+?[0-9]{10,15}$/', $request['login'])) {
            $credentials['phone'] = $request['login'];
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid email or phone format.']);
        }

        // Attempt login with the 'web' guard
        if (!Auth::guard('web')->attempt($credentials)) {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials.']);
        }

        // Get the authenticated user
        $user = Auth::guard('web')->user();

        // Role-based check (if needed)
        if ($user->role !== 'employee' && $user->role !== 'manager') {
            Auth::logout();
            return redirect()->back()->withErrors(['login' => 'Unauthorized role.']);
        }

        $user = UserResource::make($user);
        session::put('user',$user);
        //dd(\auth()->user());

        return redirect()->route('employee.home');

       // return view('home', compact('user'));
    }


    public function logout(Request $request)
    {

        $user_id = \auth()->user()->id;
        DB::table('personal_access_tokens')->where('tokenable_id',$user_id)->delete();
        Session::forget(['api_token','user']);
        \auth()->logout();
        //$this->authService->logout($request);
        return redirect()->route('showLoginForm');

    }



}
