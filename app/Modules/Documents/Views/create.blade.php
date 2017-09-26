@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
@endsection

@section('body')
    @include('Pages::navbar')
    <div class="container">
        <div class="jumbotron">
            <h4>Создать документ</h4>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    {{ Html::ul($errors->all()) }}
                </div>
            @endif

            {{ Form::open(array('url' => 'docs', 'files'=> true)) }}

            <div class="form-group">
                {{ Form::label('marking', 'Название') }}
                {{--{{ Form::text('marking', Input::old('marking'), array('class' => 'form-control')) }}--}}
                {{ Form::text('marking', Input::old('marking'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Описание') }}
                {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('typedoc', 'Тип документа') }}
                {{ Form::select('typedoc', $typedoc, Input::old('typedoc'), ['class' => 'form-control'] ) }}
            </div>

            <div class="form-group">
                {{ Form::label('statusdoc', 'Статус') }}
                {{ Form::text('statusdoc', 'Создается', ['class' => 'form-control', 'readonly'] ) }}
            </div>

            <div class="form-group">
                {{ Form::label('note', 'Комментарий') }}
                {{ Form::text('note', Input::old('note'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('id_request', 'Номер заявки') }}
                {{ Form::select('id_request', $requests, Input::old('id_request'), ['class' => 'form-control'] ) }}
            </div>

            <div class="form-group">
                {{ Form::label('edoc', 'PDF-документ') }}
                {{ Form::file('edoc') }}
            </div>


            {{ Form::submit('Создать документ', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>

@endsection