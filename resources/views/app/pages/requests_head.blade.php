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


  <script type="text/javascript" language="javascript">

        $(document).ready(function () {
            // DataTable
            var table = $('#example').DataTable({
                stateSave: true,
                "bFilter": false, //срыть поиск поле
                //"serverSide": true,
                "ajax": "{{ asset('/select_requests') }}",
                "language": {"url": "{{ asset('js/Russian.json') }}"},
				"fnRowCallback": function( nRow, Data, iDisplayIndex, iDisplayIndexFull ) {
                    if ( Data[2] == "Выполнена" )
                    {
                        $('td', nRow).css('background-color', '#2ab27b');
                        $('td', nRow).css('color', '#fff');
                       // console.log($('td', nRow).first().css('background-color', '#2ab27b'));
                    }
                    else if ( Data[2] == "В работе" )
                    {
                        $('td', nRow).css('background-color', '#ec971f');
						$('td', nRow).css('color', '#fff');
                    }
					else if ( Data[2] == "Создана" )
                    {
                        $('td', nRow).css('background-color', '#46b8da');
						$('td', nRow).css('color', '#fff');
                    }
					else if ( Data[2] == "Отклонена" )
                    {
                        $('td', nRow).css('background-color', '#d9534f');
						$('td', nRow).css('color', '#fff');
                    }
                }
            });
        });
 </script>       