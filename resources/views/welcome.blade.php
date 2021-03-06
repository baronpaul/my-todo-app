<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >

        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" >

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}" >
        <title>Todo App</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            
        </style>
    </head>
    <body>
        <div class="container" id="app">
            <todo></todo>
        </div>
        

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
