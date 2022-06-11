<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="csrf-token" value="{{ csrf_token() }}" />
    <title>Vue App</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>

<body>
    <div id="app">
    </div>
    <script src="{{ asset('assets/js/app.js') }}" type="text/javascript"></script>
</body>

</html>
