@extends('layout.index')

@section('content')
    <auth :auth="{{ json_encode(route('login')) }}"></auth>
@endsection
