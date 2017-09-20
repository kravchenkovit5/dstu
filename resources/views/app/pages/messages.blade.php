@extends('app/layout/main_layout')

@section('head')    
@include('app/pages/messages_head')    
@endsection

@section('body')   
@include('app/bars/navbar')    
@include('app/pages/messages_body')
@endsection
