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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />    
    <script type="text/javascript" src="{{ asset('js/app.js') }}" ></script>  
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

</head>
<body>   
    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>  
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="" data-toggle="modal" data-target="#mdlNuevo">Abrir</a>
                    </li>
                    <li class="nav-item">
                        <a id="newPage" class="nav-link" href="" data-toggle="modal" data-target="#mdlInputName">Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link add-guardar">Guardar</a>
                    </li>                                           
                    <li class="nav-item">
                        <a href="javascript:window.close();opener.window.focus();" class="nav-link">Cerrar</a>
                    </li> 
                    
                </ul>
        </div>
    </nav>

    <div class="modal fade" id="mdlNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Abrir Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="custom-file">
                <input name="file" type="file" class="custom-file-input" id="files" value="">
                <label class="custom-file-label" for="files">Escoger Archivo</label>
            </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>               
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlInputName" tabindex="-1" role="dialog" aria-labelledby="mdlInputNameLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mdlInputNameLabel">Archivo Nuevo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">            
                    <div class="form-group">                        
                        <input type="text" class="form-control" id="txtnameFile" placeholder="Titulo" maxlength="20">                          
                    </div>                                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary add-nuevo">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
      
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include('list')                                
            </div>
        
            <div class="col-sm-9">                        
                @yield('content')
            </div>
        </div>
        
    </div>    
</body>
</html>
