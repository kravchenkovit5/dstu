@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
    {{--<style>--}}
        {{--body{ background-image:url('../img/metrolog.jpg');--}}
        {{--}--}}
    {{--</style>--}}
@endsection

@section('body')
    @include('Pages::navbar')
    @include('Pages::viewer_body')
@endsection