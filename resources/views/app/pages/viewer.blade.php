@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
    {{--<style>--}}
        {{--body{ background-image:url('../img/metrolog.jpg');--}}
        {{--}--}}
    {{--</style>--}}
@endsection

@section('body')
    @include('app/bars/navbar')
    @include('app/pages/viewer_body')
@endsection