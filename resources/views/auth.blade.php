@extends('layout.index')

@section('content')
    @guest()
        <auth :auth="{{ json_encode(route('login')) }}"></auth>
    @endguest
@endsection
