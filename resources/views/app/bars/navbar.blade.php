<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class=""><a
                            href="http://10.0.3.245:500/metrolog/index.php?option=com_content&view=section&layout=blog&id=6&Itemid=24">Главная </a>
                </li>

                <li class="dropdown {{$activeNav['main']}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('/') }}">Документы
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/') }}">Просмотр документов</a></li>
                        <li><a href="{{ url('/docs') }}" class="is_admin">Обработка документов</a></li>
                    </ul>
                </li>


                <li class="dropdown {{$activeNav['requests']}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="{{ asset('/requests') }}">Заявки
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/show_requests') }}">Просмотр заявок</a></li>
                        <li><a href="{{ url('/reqs') }}" class="is_admin">Обработка заявок</a></li>
                    </ul>
                </li>

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                <li class="{{$activeNav['messages']}}"><a href="{{ url('/messages') }}">Сообщения</a></li>
                <li class="dropdown">
                    <a data-toggle="dropdown" id="user">User <span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="http://10.0.3.245:500/metrolog/index.php?option=com_content&view=section&layout=blog&id=6&Itemid=24">Выход</a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>


<script>
    $.ajax({
        type: "GET", //GET or POST or PUT or DELETE verb
        url: "{{ url('selectnotreadmess')  }}", // Location of the service
        dataType: 'json',
        success: function (result) {//On Successfull service call
            //console.log(result);
            if (result > 0) {
                $('#mess').html('Сообщения(' + result + ')');
            } else {
                $('#mess').html('Сообщения');
            }
        },
        error: function (xhr) {
            //console.log(xhr);
        } // When Service call fails
    });

</script>