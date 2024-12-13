@extends('layout')

@section('title', 'Home Page')

@section('content')
    <div class="text-center">
        <h1>Welcome to MyApp!</h1>
        @if(\Illuminate\Support\Facades\Session::has('user'))
        <p class="lead">Welcome, {{  \Illuminate\Support\Facades\Session::get('user')->resource['full_name'] }}</p>
        @endif
    </div>
@endsection
