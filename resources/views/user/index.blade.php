<!DOCTYPE html>
<html>
    <head>
        <title>USERS</title>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <ul>
            @foreach ($users as $user )
            <li>{{$user->name }}-{{$user->email}}</li>
            @endforeach

        </ul>

    </body>
</html>
