<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>

@if(Auth::guard('admin2')->check())
    <p>Welcome, {{ Auth::guard('admin2')->user()->name }}</p>
@endif
<a href="{{route('logout-user')}}">Logout</a>

</body>
</html>
