<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name') }}</title>

<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/shCore.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    td.details-control {
        background: url({{asset('img/details_open.png')}}) no-repeat center center;
        cursor: pointer;
    }

    tr.details td.details-control {
        background: url({{asset('img/details_close.png')}}) no-repeat center center;
    }
</style>


<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript" language="javascript" src="{{ asset('js/jquery-3.2.1.js')}} "></script>

@include('app/pages/check_auth')  {{-- проверка аутентификации --}}

<script type="text/javascript" language="javascript" src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/shCore.js') }} "></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/demo.js') }}"></script>

<script>

    function format(d) {
        return 'Тема: ' + d.subject + '<br>' +
                'Содержание: ' + d.body;

    }

    $(document).ready(function () {
        var dt = $('#example').DataTable({
            "rowCallback": function (row, data, index) {
                if (data.status == "не прочитано") {
                    console.log(row);
                    $(row).css("font-weight", "bold");
                    //$('td', row).css("font-weight", "bold");
                }
            },
            "language": {"url": "{{ asset('js/Russian.json') }}"},
            "ajax": "{{asset('select_user_mess')}}",
            "columns": [
                {
                    "class": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": ""
                },
                {"data": "id"},
                {"data": "subject"},
                {"data": "sender"},
                {"data": "created_at"},
                {"data": "status"}
            ],
            "order": [[1, 'asc']]
        });

        //tr.css('font-weight', 'bold');

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#example tbody').on('click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            var idx = $.inArray(tr.attr('id'), detailRows);

            if (row.child.isShown()) { //открыть кнопкой содержание письма
                tr.removeClass('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            }
            else {
                tr.addClass('details');     //скрыть содержание письма и установить статус прочитано
                row.child(format(row.data())).show();

                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }

                if (tr[0].childNodes[5].textContent = 'не прочитано') {
                    tr[0].childNodes[5].textContent = 'прочитано';
                    $(tr).css("font-weight", "normal");
                    console.log(tr[0].childNodes[1].textContent);
                    setStatusMessage(tr[0].childNodes[1].textContent);
                }

            }

        });

        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on('draw', function () {
            $.each(detailRows, function (i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });

    });

    function setStatusMessage(number) {
        $.ajax({
            type: "GET", //GET or POST or PUT or DELETE verb
            url: "http://localhost:7000/dstu/public/set_status_mess/" + number,
            dataType: 'html',
            contentType: "application/html",
            processdata: false,
            success: function (msg) {
                console.log(msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }


</script>


