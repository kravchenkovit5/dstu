@extends('Pages::layout')

@section('head')
    @include('Pages::main_head')
@endsection

@section('body')
    @include('Pages::navbar')

    <div class="container">
        <h4>Обработка заявок </h4>
        <br>

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>Номер</td>
                <td>Статус</td>
                <td>Название</td>
                <td>Дата создания</td>
                <td>Автор</td>
                <td>Исполнитель</td>
                <td>Дата обработки</td>
                <td>Операции</td>

            </tr>
            </thead>
            <tbody>
            @foreach($reqs as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->status }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->author }}</td>
                    <td>{{ $value->performer }}</td>
                    <td>{{ $value->performdate }}</td>

                    <td>
                        <div style="display:flex">
                            <div style="margin:5px;">
                                <a class="btn btn-small btn-success" href="{{ URL::to('reqs/' . $value->id) }}">
                                    Просмотреть</a>
                            </div>
                            <div style="margin:5px;">
                                <a class="btn btn-small btn-warning"
                                   href="{{ URL::to('reqs/' . $value->id . '/edit') }}">
                                    Изменить</a>
                            </div>

                            <div style="margin:5px;">
                                {{ Form::open(array('url' => 'reqs/' . $value->id, 'class' => 'delbutton' )) }}
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
                return confirm("Вы уверены, что хотите удалить эту заявку?");
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