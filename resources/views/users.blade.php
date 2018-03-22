@extends('adminlte::page') @section('title', 'Users-AdminLTE') @section('content_header')
<h1>Users</h1>

@stop @section('content') @include('adminlte::partials.users-record') @stop @yield('javascript')