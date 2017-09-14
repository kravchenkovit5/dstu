<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/shCore.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" language="javascript" src="{{ asset('js/jquery-3.2.1.js')}} "></script>

@include('app/pages/check_auth')  {{-- проверка аутентификации --}}

<script type="text/javascript" language="javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/shCore.js') }} "></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/demo.js') }}"></script>

<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            stateSave: true,
            "ajax": "{{ asset('/selectdocs') }}",
            "language": {"url": "{{ asset('js/Russian.json') }}"}
        });
        $('#example tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            window.open(document.URL + 'viewer/' + data[0], '_blank');
        });


        $('#mark').on('keyup change', function () {
            var col = table.column('0');
            col.search($('#mark').val()).draw();
        });

        $('#descr').on('keyup change', function () {
            var col = table.column('1');
            col.search($('#descr').val()).draw();
        });

        $('#typedoc').on('keyup change', function () {
            var col = table.column('2');
            col.search($('#typedoc').val()).draw();
        });
    });

</script>


