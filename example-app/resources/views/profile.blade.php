<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> USER PROFILE </title>
</head>
<body>
    <h1> USER PROFILE </h1>
    <p> Welcome to profile page of {{ $user->id }}</p>
    <ul>
        <li><strong>User ID:</strong> {{ $user->id }}</li>
    </ul>
</body>
</html>
