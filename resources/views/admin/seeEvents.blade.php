<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        strong {
            font-size: 1.2em;
            color: #007bff;
        }

        p {
            margin: 5px 0;
            color: #555;
        }
        p.welcome-paragraph {
            color: white;
        }
        a {
            text-decoration: none;
        }
        .event a {
            display: block;
            margin: 5px 0 5px 0;
        }
        .alert-success {
            color: green;
            width:100vw;
            text-align: center;
            margin-top: 10px;
            font-size:1.2rem;
        }
        .event {
            margin: 30px 0 30px 0;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{route('logout')}}">Logout</a>
        <a href="{{route('adminDashboardGET')}}">Dashboard</a>
        <a href="{{route('deleteAllEvents')}}">Delete all events</a>
        @if(Auth::guard('admin')->check())
            <p class='welcome-paragraph'>Welcome, {{ Auth::guard('admin')->user()->name }}</p>
        @endif
    </nav>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container">
        <h2>All Events</h2>

        @if($events->isEmpty())
            <p>No events available.</p>
        @else
            @foreach($events as $event)
                <div class="event">
                    <strong>{{ $event->name }}</strong>
                    <a href="{{ route('deleteEvent', ['id' => $event->id]) }}">Delete Event</a>
                    <a href="{{ route('editEventGET', ['id' => $event->id]) }}">Edit Event</a>
                    <p>ID: {{$event->id}}
                    <p>Description: {{ $event->description }}</p>
                    <p>Location: {{ $event->location }}</p>
                    <p>Date: {{ $event->event_date }}</p>
                    <p>Time: {{ $event->event_time }}</p>

                    <h3>Sponsors:</h3>
                    @if($event->sponsors->isEmpty())
                        <p>No sponsors for this event.</p>
                    @else
                        <p>{{ implode(', ', $event->sponsors->pluck('name')->toArray()) }}</p>
                    @endif

                    <h3>Speakers:</h3>
                    @if($event->speakers->isEmpty())
                        <p>No speakers for this event.</p>
                    @else
                        <p>{{ implode(', ', $event->speakers->pluck('name')->toArray()) }}</p>
                    @endif

                    <h3>Partners:</h3>
                    @if($event->partners->isEmpty())
                        <p>No partners for this event.</p>
                    @else
                        <p>{{ implode(', ', $event->partners->pluck('name')->toArray()) }}</p>
                    @endif
                </div>
                <hr>
            @endforeach
        @endif
    </div>
</body>
</html>