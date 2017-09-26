<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript" language="javascript" src="{{ asset('js/jquery-3.2.1.js')}} "></script>
    <script type="text/javascript" language="javascript">

        $.ajax({
            type: 'GET',
            url: '{{config('app.checkuser')}}',
            dataType: 'jsonp',
            jsonpCallback: 'parseResponse',
            success: function (userdata) {
                console.log(userdata);
                sendUserData(userdata);
            },
            error: function () {
                console.log('Error while get {{config('app.checkuser')}}');
            }
        });

        function sendUserData(userdata) {
            $.ajax({
                type: "GET", //GET or POST or PUT or DELETE verb
                url: "http://localhost:7000/dstu/public/setuser", // Location of the service
                data: {'userdata': JSON.stringify(userdata)}, //Data sent to server
                dataType: 'html',
                contentType: "application/html",
                processdata: false,
                success: function (msg) {//On Successfull service call
                    console.log(msg);
                    //window.history.back()
                },
                error: function (xhr) {
                    console.log(xhr);
                } // When Service call fails
            });
        }


    </script>
</head>
<body>
check user
</body>
</html>
