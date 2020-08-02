@extends('layouts.backend')

@section('body')

	@include('partials.backend.header')

	@yield('content')

	@include('partials.backend.footer')

@endsection
