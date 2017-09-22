@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')
<div class="container">

    <h4>Создать документ</h4>
    {{ Html::ul($errors->all()) }}

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
        {{ Form::text('id_request', Input::old('id_request'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('edoc', 'PDF-документ') }}
        {{ Form::file('edoc') }}
    </div>


    {{ Form::submit('Создать документ', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection