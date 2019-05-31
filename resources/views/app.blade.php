<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Text editor</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="{{ asset('js/app.js') }}" ></script>
</head>
<body>
    <a href="{{ route('index') }}" class="btn" target="_blank" rel="noopener noreferrer">Nuevo</a>
    <a href="" class="btn">Files</a>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
