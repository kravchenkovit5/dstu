<script type="text/javascript" language="javascript">

    $.ajax({
        type: 'GET',
        url: '{{config('app.check_auth')}}',
        dataType: 'jsonp',
        jsonpCallback: 'parseResponse',
        success: function (userdata) {
            console.log(userdata);
            if (userdata['is_user_logged']) {

                document.cookie = 'user=' + userdata['name'] + ';';

                var adminsRoles = new Set();
                adminsRoles.add('Super Administrator');
                adminsRoles.add('Administrator');
                adminsRoles.add('Manager');
                adminsRoles.add('Editor');

                $('#user').html(userdata['name'] + '<span class="caret">');

                console.log(userdata['name'] + ' has rol ' +  userdata['usertype']);

                if (adminsRoles.has(userdata['usertype'])) {
                    $('.is_user').remove();
                    document.cookie = 'get_requests=all;';
                    document.cookie = 'usertype=admin;';
                } else {
                    $('.is_admin').remove();
                    document.cookie = 'get_requests=by_user;';
                    document.cookie = 'usertype=simple_user;';
                    setNotReadMess(userdata['name']);
                }
            } else {
                window.location.replace('{{config('app.metrolog')}}');
            }
        },
        error: function () {
            console.log('Error while get {{config('app.check_auth')}}');
        }
    });


    function setNotReadMess(username) {

        var urlMess = '{{ url('select_not_read_mess') }}' + '/' + username;
        console.log('urlMess = ' + urlMess);
        $.ajax({
            type: "GET", //GET or POST or PUT or DELETE verb
            url: urlMess, // Location of the service
            dataType: 'json',
            success: function (result) {//On Successfull service call

                if (result > 0) {
                    $('#mess').html('Сообщения(' + result + ')');
                } else {
                    $('#mess').html('Сообщения');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            } // When Service call fails
        });

    }

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