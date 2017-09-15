@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')
    <div class="container">

        <h4>Обработка заявки № {{ $req->id }}</h4>

        {{ Html::ul($errors->all()) }}

        {{ Form::model($req, array('route' => array('reqs.update', $req->id), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('name', 'Имя') }}
            {{ Form::text('name', null, array('class' => 'form-control', 'readonly')) }}
        </div>

        {{--Cоздана--}}
        {{--В работе--}}
        {{--Выполнена--}}
        {{--Отклонена--}}

        <div class="form-group">
            {{ Form::label('status', 'Статус:') }}
            {{ Form::select('status', $statuses, $req->status, ['class' => 'form-control'] )
            }}
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Описание:') }}
            {{ Form::textarea('description', null, array('class' => 'form-control', 'rows' => 2 , 'readonly')) }}
        </div>

        <div class="form-group">
            {{ Form::label('create_date', 'Дата создания:') }}
            {{ Form::text('create_date', null, array('class' => 'form-control','readonly')) }}
        </div>

        <div class="form-group">
            {{ Form::label('performer', 'Исполнитель:') }}
            {{ Form::text('performer', null, array('class' => 'form-control','readonly')) }}
        </div>

        <div class="form-group">
            {{ Form::label('performdate', 'Дата обработки:') }}
            {{ Form::text('performdate', null, array('class' => 'form-control','readonly')) }}
        </div>

        <div class="form-group">
            @if (!is_null($parents))
            {{ Form::label('parent_id', 'Привязать к другой заявке:') }}
            {{ Form::select('parent_id', $parents, null, ['class' => 'form-control'] ) }}
            @endif
        </div>

        {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>


@endsection