<script type="text/javascript" language="javascript">

    $.ajax({
        type: 'GET',
        url: '{{config('app.check_auth')}}',
        dataType: 'jsonp',
        jsonpCallback: 'parseResponse',
        success: function (userdata) {
            console.log(userdata);
            if (userdata['is_user_logged']) {
                console.log(userdata['name'] + ' is logged in');

                //var pass = "userdata=" + JSON.stringify(data);
//                sendUserData(userdata);

                //document.cookie = pass;

                var roles = new Set();
                roles.add('Super Administrator');
                roles.add('Administrator');
                roles.add('Manager');
                roles.add('Editor');

                $('#user').html(userdata['name'] + '<span class="caret">');

                if (!roles.has(userdata['usertype'])) {
                    $('.access').remove();
                }
            } else {
                console.log(userdata['name'] + ' is not logged in');
                window.location.replace('{{config('app.metrolog')}}');
            }
        },
        error: function () {
            console.log('Error while get {{config('app.check_auth')}}');
        }
    });

//    function sendUserData(userdata) {
//        $.ajax({
//            type: "GET", //GET or POST or PUT or DELETE verb
//            url: "http://localhost:7000/dstu/public/test", // Location of the service
//            data: {'userdata': JSON.stringify(userdata)}, //Data sent to server
//            dataType: 'html',
//            contentType: "application/html",
//            processdata: false,
//            success: function (msg) {//On Successfull service call
//                console.log(msg);
//            },
//            error: function (xhr) {
//                console.log(xhr);
//            } // When Service call fails
//        });
//    }


</script>

{{--ROOT--}}
{{--USERS--}}
{{--Public Frontend--}}
{{--Registered--}}
{{--Author--}}
{{--Editor--}}
{{--Publisher--}}
{{--Public Backend--}}
{{--Manager--}}
{{--Administrator--}}
{{--Super Administrator--}}