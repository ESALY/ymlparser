<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="images/favicon.png">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">


    <!-- Js -->
    <script src="{{ asset('/js/vue.js') }}"></script>
    <script src="{{ asset('/js/axios.min.js') }}"></script>

    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/ru-RU.js"></script>

    <script>
        ELEMENT.locale(ELEMENT.lang.ruRU)
    </script>

</head>
<body>

@yield('content')

</body>

</html>
