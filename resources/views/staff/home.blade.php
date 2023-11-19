<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Hello World {{ Auth::user()->role }}</h1>
        <p>{{ Auth::user()->firstname }}</p>
        <a href="{{ url('logout') }}"></a>
    </div>
</body>
</html>