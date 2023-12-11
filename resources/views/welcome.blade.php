<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./app.css">
    <title>Welcome</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            padding: 0;
            margin: 0;
        }
        body {
            background: #f8f9fa;
        }
        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #4ab3a4;
            background: linear-gradient(90deg, #4ab3a4 31%, #00d4ff 100%);
            color: white;
        }
        .container-top {
            display: flex;
            gap: 20px;
        }
        .container-bottom {
            margin-top: 30px;
        }
        a {
            text-decoration: none;
            color: white;
            transition: transform 0.3s;
        }
        h2 {
            margin: 0;
            padding: 15px 25px;
            border: 2px solid white; 
            border-radius: 25px;
            transition: background-color 0.3s, color 0.3s;
        }
        h2:hover, a:hover {
            background-color: white;
            color: #333;
            transform: scale(1.05);
        }
    </style>

</head>
<body>
    <!-- @if(session('messages'))
    <div class="alert alert-success">
        {{ session('messages') }}
    </div>
    @endif -->

    <div class="container">
        <div class="container-top">
            <div class="user-registration">
                <a href="{{route('loginAdminGET')}}"><h2>Register User</h2></a>
            </div>
            <div class="user-login">
                <a href="{{route('loginAdminGET')}}"><h2>Login as User</h2></a>
            </div>
        </div>
        <div class="container-bottom">
            <div class="admin-login">
                <a href="{{route('loginAdminGET')}}"><h2>Login as Admin</h2></a>
            </div>
        </div>
    </div>
</body>
</html>
