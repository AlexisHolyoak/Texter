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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Texter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item active">
                            <a href="{{ route('index') }}" class="btn" target="_blank" rel="noopener noreferrer">Nuevo</a>
                      </li>
                      <li class="nav-item">
                            <a href="{{ route('note.index') }}" class="btn">Files</a>
                      </li>                    
                    </ul>
                  </div>
    </nav>


    <div class="container">
        @yield('content')
    </div>
</body>
</html>
