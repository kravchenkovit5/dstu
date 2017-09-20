@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')

    <div class="container">
        <h4>Создание заявки</h4>

        {{ Html::ul($errors->all()) }}

        {{ Form::open( array('url' => 'reqs')) }}

        <div class="form-group">
            {{ Form::label('name', 'Название') }}
            {{ Form::text('name', null, array('class' => 'form-control' )) }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Описание') }}
            {{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => 2)) }}
        </div>

        {{ Form::submit('Создать', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>

@endsection
