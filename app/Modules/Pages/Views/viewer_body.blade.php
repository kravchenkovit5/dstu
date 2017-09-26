<div class="container">
    <a href="{{url('docs')}}">
        <img src="{{asset('img/back.png')}}" alt="" height="20" width="20"/> Вернуться к списку документов
    </a>
    <div style="text-align:center">
        <h4>{{ $marking . ' ' .  $descr }}</h4>

        <iframe id="ViewerFrame"
                src="{{ $source  }}"
                frameborder="0" style="overflow:hidden;height:82vh;width:67%"
                allowfullscreen webkitallowfullscreen>
        </iframe>
    </div>
</div>