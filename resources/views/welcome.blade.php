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
            font-family: 'Roboto', sans-serif;
            padding: 0;
            margin: 0;
        }
        .container {
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            background: rgb(64,170,165);
            background: linear-gradient(90deg, rgba(64,170,165,1) 31%, rgba(0,212,255,1) 100%);
            color: white;
        }
        .container-top {
            display: flex;
        }
        .container-bottom h2 {
            margin-top: 50px;
        }
        h2 {
            margin: 0 20px 0 20px;
            border: 2px solid white; 
            padding:12.5px;
            border-radius:25px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="container-top">
            <div class="user-registration">
                <h2>Register user</h2>
            </div>
            <div class="user-login">
                <h2>Login as user</h2>
            </div>
        </div>
        <div class="container-bottom">
            <div class="admin-login">
                <h2>Login as admin</h2>
            </div>
        </div>
    </div>
</body>
</html>