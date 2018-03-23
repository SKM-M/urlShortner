@extends('adminlte::page') @section('title', 'Url Shortner') @section('content_header')
<h1>Url Shortner</h1>

@stop @section('content') @include('adminlte::partials.urlShortner')
<hr>
<div class="row">

<div class="text-center">
@if(isset($message))
<p>
	<strong>{{ $message }}</strong>
</p>
@endif
</div>
<hr>
<div class="text-center">
@if(isset($link))
<p>
<strong><a href="{{{ $link['url'] }}}">http://urlShortner/{{{ $link['hash'] }}}</a></strong>

</p>
@endif
</div>
</div>


 @stop @yield('javascript')