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
    <link rel="stylesheet" href="{{ secure_asset('/css/style.css') }}">

    <!-- Js -->
    <script src="{{ secure_asset('/js/vue.js') }}"></script>
    <script src="{{ secure_asset('/js/axios.min.js') }}"></script>

    <!-- import JavaScript -->
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/ru-RU.js"></script>

    <script>
        ELEMENT.locale(ELEMENT.lang.ruRU)
    </script>

    <style>
        @import url("//unpkg.com/element-ui@2.4.9/lib/theme-chalk/index.css");

        body{
            margin: 0;
        }

        /* search div */
        .search-wrapper{
            margin: 15px;
        }

        .el-form-item__label{
            line-height: 30px;
        }

        .el-form--label-top .el-form-item__label {
            padding: 0 0 0px;
        }

        .el-form-item {
            margin-bottom: 5px;
        }

        .el-header, .el-footer {
            background-color: #B3C0D1;
            color: #333;
            text-align: center;
            line-height: 60px;
        }

        .el-aside {
            background-color: #D3DCE6;
            color: #333;
        }

        .el-main {
            background-color: #E9EEF3;
            color: #333;
        }

        body > .el-container {
            margin-bottom: 40px;
        }

        .el-container:nth-child(5) .el-aside,
        .el-container:nth-child(6) .el-aside {
            line-height: 260px;
        }

        .el-container:nth-child(7) .el-aside {
            line-height: 320px;
        }
    </style>

</head>
<body>

@yield('content')

</body>

</html>
