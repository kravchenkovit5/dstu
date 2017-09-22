@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')
    <div class="container">
        <a href="{{url('docs')}}">
            <img src="{{asset('img/back.png')}}" alt="" height="20" width="20"/> Вернуться к списку документов
        </a>

        <div class="jumbotron">
            <h4>Редактирование {{ $doc->marking }}</h4>

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            {{ Form::model($doc, array('route' => array('docs.update', $doc->marking), 'method' => 'PUT', 'files'=> true)) }}

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
                {{ Form::label('note', 'Комментарий:') }}
                {{ Form::text('note', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('aqtualdate', 'Дата последней актуализации:') }}
                {{ Form::text('aqtualdate', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('actualuser', 'Ответственный по актуализации:') }}
                {{ Form::text('actualuser', null, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('id_request', 'Номер заявки:') }}
                {{ Form::text('id_request', null, array('class' => 'form-control', 'readonly')) }}
            </div>

            <div class="form-group">
                @if (!empty($doc->reference))
                    {{ Form::label('edoc', 'Заменить текущий pdf файл') }}
                @endif

                {{ Form::file('edoc')  }}
                {{--<div class="btn btn-default">--}}
                    {{--<input type="file">--}}
                {{--</div>--}}
            </div>

            {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </div>


@endsection