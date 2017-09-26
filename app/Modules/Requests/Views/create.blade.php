@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
@endsection

@section('body')
    @include('Pages::navbar')
    <div class="container">
        <div class="jumbotron">
            <h4>Создание заявки</h4>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

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
    </div>

@endsection
