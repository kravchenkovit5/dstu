@extends('app/layout/main_layout')

@section('head')
    @include('app/pages/main_head')
@endsection

@section('body')
    @include('app/bars/navbar')
    <div class="container">
        <h4>Обработка документов </h4>
        <a class="btn btn-info" href="{{ URL::to('docs/create') }}">Создать документ</a>
        <br>
        <br>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Обозначение</td>
                <td>Наименование</td>
                <td>Тип документа</td>
                <td>Статус документа</td>
                <td>Операции</td>
            </tr>
            </thead>
            <tbody>
            @foreach($docs as $key => $value)
                <tr>
                    <td>{{ $value->marking }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->typedoc }}</td>
                    <td>{{ $value->statusdoc }}</td>

                    <td>
                        <div style="display:flex">
                            <div style="margin:5px;">
                                <a class="btn btn-small btn-success" href="{{ URL::to('docs/' . $value->marking) }}">
                                    Просмотреть</a>
                            </div>
                            <div style="margin:5px;">
                                <a class="btn btn-small btn-warning"
                                   href="{{ URL::to('docs/' . $value->marking . '/edit') }}">
                                    Изменить</a>
                            </div>

                            <div style="margin:5px;">
                                {{ Form::open(array('url' => 'docs/' . $value->marking, 'class' => 'delbutton' )) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Удалить', array('class' => 'btn btn-danger',  )) }}
                                {{ Form::close() }}
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $('.delbutton').on("submit", function () {
                return confirm("Вы уверены, что хотите удалить этот документ?");
            });
        </script>

        <script type="text/javascript" language="javascript">
            $.ajax({
                type: 'GET',
                url: 'http://10.0.3.245:500/metrolog/MY_PHP/Test/check.php',
                dataType: 'jsonp',
                jsonpCallback: 'parseResponse',
                success: function (data) {
                    console.log(data);
                    if (data['is_user_logged']) {
                        console.log(data['name'] + ' is logged in');

                        var roles = new Set();
                        roles.add('Super Administrator');
                        roles.add('Administrator');
                        roles.add('Manager');
                        roles.add('Editor');

                        $('#user').html(data['name']);
                        if (!roles.has(data['usertype'])) {
                            console.log(data['name'] + ' does not have permission for the section');
                            window.location.replace('http://10.0.3.245:500/metrolog');
                        }
                    } else {
                        console.log(data['name'] + ' is not logged in');
                        window.location.replace('http://10.0.3.245:500/metrolog');
                    }
                },
                error: function () {
                    console.log('Error while get http://10.0.3.245:500/metrolog/MY_PHP/Test/check.php');
                }
            });
        </script>
    </div>

@endsection


