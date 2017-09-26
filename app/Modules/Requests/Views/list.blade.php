@extends('Pages::layout')

@section('head')
    @include('Requests::list_head')
@endsection

@section('body')
    @include('Pages::navbar')
    @include('Requests::list_body')
@endsection
