@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')

    <div class="container">
        <h4>Просмотр заявки № {{ $req->id }}</h4>
        <div class="jumbotron">
            <p style="font-size: 18px">
                <strong>Название:</strong> {{ $req->description }}<br><br>
                <strong>Статус документа:</strong> {{ $req->status }}<br><br>
                <strong>Дата создания:</strong> {{ $req->create_date }}<br><br>
                <strong>Автор:</strong> {{ $req->author }}<br><br>
                <strong>Исполнитель</strong> {{ $req->performer }}<br><br>
                <strong>Дата операции</strong> {{ $req->performdate }}<br><br>
                <strong>Привязанная заявка</strong> {{ $req->id_request }}<br><br>

            </p>
        </div>


    </div>


@endsection


