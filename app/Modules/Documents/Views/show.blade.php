@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
@endsection

@section('body')
    @include('Pages::navbar')

    <div class="container">
        <a href="{{url('docs')}}">
            <img src="{{asset('img/back.png')}}" alt="" height="20" width="20"/> Вернуться к списку документов
        </a>

        <h4>Просмотр {{ $doc->marking }}</h4>
        <div class="jumbotron">
            <p style="font-size: 18px">
                <strong>Название:</strong> {{ $doc->description }}<br><br>
                <strong>Тип документа:</strong> {{ $doc->typedoc }}<br><br>
                <strong>Комментарий:</strong> {{ $doc->note }}<br><br>
                <strong>Статус документа:</strong> {{ $doc->statusdoc }}<br><br>
                <strong>Дата создания:</strong> {{ $doc->created_at }}<br><br>
                <strong>Дата последней актуализации:</strong> {{ $doc->actualdate }}<br><br>
                <strong>Ответственный по актуализации:</strong> {{ $doc->actualuser }}<br><br>
                <strong>Номер заявки:</strong> {{ $doc->id_request }}<br><br>
                @if (!empty($doc->reference))
                    <strong>Электронный документ:</strong>
                    <a href="{{ url($doc->getWebRef()) }}" target="blank">просмотреть</a>
                @else
                    <strong>Электронный pdf документ:</strong> <strong
                            style="background-color:#d9534f; color: white; padding: 5px;"> Нет ссылки </strong>
                @endif

            </p>
        </div>


    </div>


@endsection


