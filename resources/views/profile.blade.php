@extends('adminlte::page') @section('title') @section('content_header')
<h1>User Profile</h1>

@stop @section('content') @include('adminlte::partials.user-profile') @stop @yield('javascript')