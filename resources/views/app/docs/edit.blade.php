@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')
    <div class="container">

        <h4>Редактирование {{ $doc->marking }}</h4>

        <!-- if there are creation errors, they will show here -->
        {{ Html::ul($errors->all()) }}

        {{ Form::model($doc, array('route' => array('docs.update', $doc->marking), 'method' => 'PUT')) }}

        <div class="form-group">
            {{ Form::label('description', 'Описание') }}
            {{ Form::text('description', null, array('class' => 'form-control')) }}
        </div>


        <div class="form-group">
            {{ Form::label('typedoc', 'Тип документа') }}
            {{ Form::select('typedoc', ['0' => 'Выберите тип',
                                        '1' => 'Национальный стандарт',
                                        '2' => 'Международный стандарт',
                                        '3' => 'Стандарт предприятия'],
                                        $doc->getOriginal('typedoc'),
                                        ['class' => 'form-control'] )
            }}
        </div>

        <div class="form-group">
            {{ Form::label('statusdoc', 'Статус документа') }}
            {{ Form::select('statusdoc', ['0' => 'Выберите статус',
                                          '1' => 'Действует',
                                          '2' => 'Частично действует',
                                          '3' => 'Действует будет отменен',
                                          '4' => 'Отменен'],
                                          $doc->getOriginal('statusdoc'),  //здесь вызов getOriginal потому, что у нас на этом поле
                                          ['class' => 'form-control'] )
            }}
        </div>

        <div class="form-group">
            {{ Form::label('statusdoc', 'Комментарий:') }}
            {{ Form::text('comment', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('statusdoc', 'Дата последней актуализации:') }}
            {{ Form::text('request', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('statusdoc', 'Ответственный по актуализации:') }}
            {{ Form::text('request', null, array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('statusdoc', 'Номер заявки:') }}
            {{ Form::text('request', null, array('class' => 'form-control')) }}
        </div>

        {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>


@endsection