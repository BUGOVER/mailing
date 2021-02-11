@extends('layout.index')

@section('content')
    @auth()
        <router-view></router-view>
    @endauth
@endsection
