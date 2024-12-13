<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public static function request($method, $url, $data = [])
    {
        return Http::withToken(session('token'))->{$method}($url, $data);
    }
}
