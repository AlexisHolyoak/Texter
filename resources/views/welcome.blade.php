<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Texter</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .nav-tabs > li {
                position:relative;
            }
            .nav-tabs > li > a {
                display:inline-block;
            }
            .nav-tabs > li > span {
                display:none;
                cursor:pointer;
                position:absolute;
                right: 6px;
                top: 8px;
                color: red;
            }
            .nav-tabs > li:hover > span {
                display: inline-block;
            }
        </style>
        <script src="{{ asset('/vendors/ckeditor/ckeditor.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />                
        <script type="text/javascript" src="{{ asset('js/app.js') }}" ></script>
        <script>            

            $(document).ready(function() {
                function readTextFile(file, callback, encoding) {
                    var reader = new FileReader();                    
                    reader.addEventListener('load', function (e) {
                        callback(file.name, this.result);
                    });
                    if (encoding) reader.readAsText(file, encoding);
                    else reader.readAsText(file);
                }

                function fileChosen(input) {
                    if ( input.files && input.files[0] ) {
                        readTextFile(
                            input.files[0],
                            function (nameFile, str) {                                
                                //output.updateElement();
                                addNewTab(nameFile, str);
                            }
                        );
                    }
                }

                $('#files').on('change', function () {                    
                    var result = $("#files").text();                                                                   
                    fileChosen(this); 
                    var $el = $('#files');
                    $el.wrap('<form>').closest('form').get(0).reset();
                    $el.unwrap();                                       
                    $('#mdlNuevo').modal('hide');
                }); 
                
                var id = 1;
                function addNewTab(nameFile, str){
                    var idCurrent = $(".nav-tabs").children().length + 1;                    
                    id = id + 1;
                    if (nameFile == ""){
                        nameFile = 'New ' + id;
                    }
                    var codId = 'new_' + id;
                    var tabId = codId + '-tab';        
                    var newli = '<li class="nav-item"><a id=' + tabId + ' class="nav-link" href="#' + codId + '" data-toggle="tab" role="tab" aria-controls="' + codId +'" aria-selected="false">' + nameFile + '</a><span> x </span></li>';
                    var newckeditor = '<textarea class="ckeditor"  name="editor' + id +'" id="editor' + id +'" rows="10" cols="80"></textarea>'
                    var newdiv = '<div class="tab-pane fade" id="' + codId + '" role="tabpanel" aria-labelledby="' + tabId +'" > ' + newckeditor + '</div>'
                    $(".nav-tabs li").last().closest('li').after(newli);
                    $('.tab-content').append(newdiv);
                    $('.nav-tabs li:nth-child(' + idCurrent + ') a').click();
                    CKEDITOR.replace("editor" + id).setData(str);;                                        
                }           

                $('.add-nuevo').click(function (e) {                    
                    e.preventDefault();
                    addNewTab("","");    
                });

                $(".nav-tabs").on("click", "span", function () {                    
                    var anchor = $(this).siblings('a');
                    $(anchor.attr('href')).remove();
                    $(this).parent().remove();
                    $(".nav-tabs li").children('a').first().click();
                });

            });  
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#mdlNuevo">Abrir<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a id="newPage" class="nav-link add-nuevo" href="#" >Nuevo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#mdlGuardar">Guardar</a>
                    </li>            
                </ul>
            </div>
        </nav>

        <form>
            <div class="container">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="new_1-tab" data-toggle="tab" href="#new_1" role="tab" aria-controls="new_1" aria-selected="true">New 1</a>
                    </li>        
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="new_1" role="tabpanel" aria-labelledby="new_1-tab">                            
                        <textarea class="ckeditor"  name="editor1" id="editor1" rows="10" cols="80"></textarea>                                           
                </div>        
            </div>
        </form>
        
    </div>
    
    <!-- Modal Abrir Archivo -->
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


    <!-- Modal Guardar Cambios-->
    <div class="modal fade" id="mdlGuardar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guardar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Desea guardar los cambios realizados?.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    </body>
</html>
