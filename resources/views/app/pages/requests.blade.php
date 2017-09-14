@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/requests_head')
@endsection

@section('body')
    @include('app/bars/navbar')
    @include('app/pages/requests_body')
@endsection
