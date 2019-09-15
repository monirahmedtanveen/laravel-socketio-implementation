<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>User List</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 40px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    User List
                </div>

                <div class="links">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                        <tbody>
                        <tfoot>
                            <tr>
                                <th>Sl#</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Created Date</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- scripts --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.2/socket.io.min.js"></script>
        <script>
        // this is all it takes to capture it in jQuery
        // you put ready-snippet
        $(function() {
            //you define socket - you can use IP
            var socket = io('http://localhost:3000');
            //you capture message data
            socket.on('laravel_database_user-channel:App\\Events\\UserBroadcast', function(data){
                //you append that data to DOM, so user can see it
                $('#data').append('<tr>'
                    + '<td>' + data.user.id + '</td>' 
                    + '<td>' + data.user.name + '</td>'
                    + '<td>' + data.user.email + '</td>'
                    + '<td>' + data.user.created_at + '</td>'
                    + '</tr>')
                // console.log(data.user.name);
            });
        });
        
        </script>
    </body>
</html>
