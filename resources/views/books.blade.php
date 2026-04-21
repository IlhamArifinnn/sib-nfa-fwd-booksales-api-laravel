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

    @foreach ($books as $book)
        <ul>
            <li>Title: {{ $book['title'] }}</li>
            <li>{{ $book['description'] }}</li>
            <li>Price: {{ $book['price'] }}</li>
            <li>Stock: {{ $book['stock'] }}</li>
        </ul>
    @endforeach

</body>

</html>