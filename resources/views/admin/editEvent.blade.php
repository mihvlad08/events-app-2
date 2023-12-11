<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <!-- Add your styles and scripts here -->
</head>
<body>
    <h2>Edit Event</h2>

    <form action="{{ route('updateEvent', ['id' => $event->id]) }}" method="post">
        @csrf
        <!-- Add your form fields with the corresponding event data -->
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" value="{{ $event->name }}" required>

        <label for="description">Event Description:</label>
        <textarea id="description" name="description" required>{{ $event->description }}</textarea>

        <label for="location">Event Location:</label>
        <textarea id="location" name="location" required>{{ $event->location }}</textarea>

        <!-- Add more fields as needed -->

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
