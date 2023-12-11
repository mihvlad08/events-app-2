<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Event</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        nav {
            background: linear-gradient(90deg, #2980b9, #3498db);
            color: white;
            padding: 15px;
            text-align: right;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #2c3e50;
        }

        nav p {
            display: inline-block;
            margin-right: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{route('logout')}}">Logout</a>
        <a href="{{route('adminDashboardGET')}}">Dashboard</a>
        @if(Auth::guard('admin')->check())
            <p>Welcome, {{ Auth::guard('admin')->user()->name }}</p>
        @endif
    </nav>

    <form action="{{route('createNewEventPOST')}}" method="post">
        <h2>Create New Event</h2>
        @csrf <!-- {{ csrf_field() }} -->
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Event Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="sponsors">Sponsors (comma-separated):</label>
        <textarea id="sponsors" name="sponsors" rows="2"></textarea>

        <label for="speakers">Speakers (comma-separated):</label>
        <textarea id="speakers" name="speakers" rows="2"></textarea>

        <label for="partners">Partners (comma-separated):</label>
        <textarea id="partners" name="partners" rows="2"></textarea>

        <button type="submit">Create Event</button>
    </form>
</body>
</html>