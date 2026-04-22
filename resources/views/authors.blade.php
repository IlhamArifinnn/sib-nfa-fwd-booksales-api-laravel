<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>

    <h1>Hello World</h1>
    <p>Welcome to PinBooks</p>

    @foreach ($authors as $author)
        <ul>
            <li>Name: {{ $author->name }}</li>
            <li>{{ $author->photo }}</li>
            <li>Bio: {{ $author->bio }}</li>
        </ul>
    @endforeach

</body>

</html>