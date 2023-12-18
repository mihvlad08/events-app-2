<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
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

    .inline {
        display: block;
    }

    a {
        text-decoration: none;
    }

    .link-button:focus {
        outline: none;
    }
    .link-button:active {
        color:red;
    }
    /* Add or modify styles under Your Cart section */
.container {
    margin-top: 30px; /* Adjust margin as needed */
}

h2 {
    margin-top: 50px; /* Adjust margin as needed */
    color: #333;
}

.table-container {
    margin-top: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #3498db;
    color: white;
}

tbody tr:hover {
    background-color: #f5f5f5;
}

/* Optional: Add a subtle shadow to the table */
table {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>

<body>

<nav>
    @if(Auth::guard('admin2')->check())
        <a href="{{route('logout-user')}}">Logout</a>
        <p class="welcome-paragraph">Welcome, {{ Auth::guard('admin2')->user()->name }}</p>
    @endif
</nav>

<div class="container">
    <h2>All Events</h2>

    @if($events->isEmpty())
        <p>No events available.</p>
    @else
        @foreach($events as $event)
            <div class="event">
                <strong>{{ $event->name }}</strong>
                <p>ID: {{$event->id}}
                <p>Description: {{ $event->description }}</p>
                <p>Location: {{ $event->location }}</p>
                <p>Date: {{ $event->event_date }}</p>
                <p>Time: {{ $event->event_time }}</p>
                <p>Price: {{ $event->price }}</p>

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

                <form method="post" action="{{route('addToCartPOST')}}" class="inline">
                    @csrf
                    <input type="hidden" name="id" value="{{$event->id}}">
                    <input type="hidden" name="price" value="{{$event->price}}">
                    <input type="number" name="quantity" placeholder="Quantity">
                    <button type="submit" name="submit_param" value="submit_value" class="link-button">
                        Add to cart
                    </button>
                </form>
            </div>
            <hr>
        @endforeach
    @endif
</div>


<h2>Your Cart</h2>

@php
    // Retrieve cart data from the session
    $user = auth()->guard('admin2')->user();
    $userId = $user->id;
    $cartKey = 'cart_' . $userId;
    $cartData = session($cartKey, []);
@endphp

@if(empty($cartData))
    <p>Your cart is empty.</p>
@else
<div class="table-container">
    <table border="1">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Quantity</th>
                <th>Total cost</th>
                <th>Actions</th>
                <!-- Add more columns for other product details if needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($cartData as $product)
                @if($product['quantity'] > 0)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td> {{$product['quantity'] * $product['price']}} </td>
                    <td>                
                        <form method="post" action="{{route('removeCartPOST')}}" class="inline">
                        @csrf
                        <input type="hidden" name="id" value="{{$product['id']}}">
                        <button type="submit" name="submit_param" value="submit_value" class="link-button">
                            Remove all
                        </button>
                        </form>
                    </td>
                    <!-- Display other product details here -->
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endif

</body>
</html>
