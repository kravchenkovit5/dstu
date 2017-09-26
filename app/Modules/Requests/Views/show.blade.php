@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
@endsection

@section('body')
    @include('Pages::navbar')

    <div class="container">
        <h4>Просмотр заявки № {{ $req->id }}</h4>
        <div class="jumbotron">
            <p style="font-size: 18px">
                <strong>Название:</strong> {{ $req->description }}<br><br>
                <strong>Статус документа:</strong> {{ $req->status }}<br><br>
                <strong>Дата создания:</strong> {{ $req->created_at }}<br><br>
                <strong>Автор:</strong> {{ $req->author }}<br><br>
                <strong>Исполнитель</strong> {{ $req->performer }}<br><br>
                <strong>Дата обработки</strong> {{ $req->performdate }}<br><br>
                @if (!is_null($parentReq))
                    <strong>Привязанная заявка</strong>
                    {{ 'Заявка № ' . $parentReq->id .' '. $parentReq->name . '(' . $parentReq->status . ')'  }}
                    <br><br>
                @endif

            </p>
        </div>

    </div>


@endsection


