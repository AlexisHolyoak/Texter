
$(document).ready(function() {
    var lengthMaxfile = 5000000;

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
                    if (str.length > lengthMaxfile){
                        alert("La nota a cargar no puedo pesar mas de 5 megaBytes!");
                    }else{
                        addNewTab(nameFile, str,0);
                    }   
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
    function addNewTab(nameFile, str, idNote){
        var idCurrent = $(".nav-tabs").children().length + 1;                    
        id = id + 1;
        if (nameFile == ""){
            nameFile = 'New ' + id;
        }
        var codId = 'new_' + id;
        var tabId = codId + '-tab';        
        var newli = '<li class="nav-item"><a editor-modified="false" editor-id=' +id +' data-id=' + idNote + ' id=' + tabId + ' class="nav-link" href="#' + codId + '" data-toggle="tab" role="tab" aria-controls="' + codId +'" aria-selected="false">' + nameFile + '</a><span> x </span></li>';
        var newckeditor = '<textarea class="ckeditor"  name="editor' + id +'" id="editor' + id +'" rows="10" cols="80"></textarea>'
        var newdiv = '<div class="tab-pane fade" id="' + codId + '" role="tabpanel" aria-labelledby="' + tabId +'" > ' + newckeditor + '</div>'        
        $(".nav-tabs").append(newli);
        $('.tab-content').append(newdiv);
        $('.nav-tabs li:nth-child(' + idCurrent + ') a').click();
        CKEDITOR.replace("editor" + id).setData(str);
        CKEDITOR.instances["editor" + id].on( 'change', function() {
            var activeTab = $("ul#myTab a.active");
            if (activeTab.length > 0){                
                activeTab.attr("editor-modified","true");  
            }
        });                                    
    }           

    $('.add-nuevo').click(function (e) {                    
        e.preventDefault();
        const pattern = new RegExp('^[a-zA-Z0-9]+$', 'i');
        var nameFile = $("#txtnameFile").val();
        if (nameFile == ""){
            alert("Es necesario ingresar el nombre.");            
        }else if(!pattern.test(nameFile)){
            alert("El nombre de la nota no es válido, este solo debe contener letras y números");
        }else{
            $("#mdlInputName").modal('hide');        
            addNewTab(nameFile,"",0);
        }                
    }); 

    $('#mdlInputName').on('hidden.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
      })

    var detectedNote = null;
    $(".nav-tabs").on("click", "span", function () {
        detectedNote = $(this);
        var tab = $(this).siblings('a');
        if (tab.attr("editor-modified") == "true" ){            
            $("#mdlConfirmarCambios").modal('show');  
        }else{
            closeTab($(this));
        }        
    });

    $("#btnCloseTab").click(function (e) {
        if (detectedNote != null){
            closeTab(detectedNote);
            $("#mdlConfirmarCambios").modal('hide'); 
        }
    });

    function closeTab(navTab){
        var anchor = navTab.siblings('a');
        $(anchor.attr('href')).remove();
        navTab.parent().remove();
        $(".nav-tabs li").children('a').first().click();
    }

    function closeTabFromId(id){
        var tab = $(".nav-tabs").children().find("a[data-id='"+id+"']").next();                
        if ( tab.length > 0){
            closeTab(tab);
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });                
    
    $.ajax({
        type:'GET', 
        url:'./list',             
        success:function(data){             
            loadFolder(data);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            showAlert("alertContainer", "Obtener", "Ocurrio un error al obtener las notas"), "ERROR";
        }  
     }); 
    
    var tree;
    function loadFolder(data){
        tree = $('#tree').tree({
            primaryKey: 'id',
            uiLibrary: 'bootstrap4',
            border: true,
            dataSource: JSON.parse(data),                        
            icons: {
                expand: '<i class="material-icons">folder</i>',
                collapse: '<i class="material-icons">folder</i>'
            }            
        }).expandAll();

        tree.on('select', function (e, node, id) {
            if (id != 0){
                var name = node.find('[data-role="display"]').text();
                var data = getValue(name, id);                
            }                    
        });                     
        
        loadMenu();
    }

    function loadMenu(){
        $("li[data-role='node']").on('contextmenu', function(e) {
            var dataid = $(this).attr("data-id");  

            if (dataid > 0){
                var top = e.pageY - 50;
                var left = e.pageX - 90;
                var nombre = $(this).find('[data-role="display"]').text();
                var id = $(this).attr( "data-id" );

                $("#context-menu #nameFile").val(nombre);
                $("#context-menu #idFile").val(id);

                $("#context-menu").css({
                display: "block",
                top: top,
                left: left
                }).addClass("show");            
                return false; //blocks default Webbrowser right click menu
            }                                  
            
          }).on("click", function() {
            $("#context-menu").removeClass("show").hide();
          });
          
          $("#context-menu a").on("click", function() {
            $(this).parent().removeClass("show").hide();
          });

          $('body').on('click', function (e) {
            if (!$('#context-menu').is(e.target) 
                && $('#context-menu').has(e.target).length === 0 
                && $('.show').has(e.target).length === 0
            ) {
                $("#context-menu").removeClass("show").hide();
            }
          });
    }

    function getValue(name, id){
        //Verificamos que no este abierto el archivo
        var tab = $(".nav-tabs").children().find("a[data-id='"+id+"']");        
        if ( tab.length > 0){
            tab.trigger('click');
        }else{
            $.ajax({
                type:'GET', 
                url:'./edit/'+id,             
                success:function(data){ 
                    addNewTab(name, data, id);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    showAlert("alertContainer", "Editar", "Ocurrio un error al obtener la nota"), "ERROR";
                }  
            }); 
        }
    }

    function treeReload(){
        $.ajax({
            type:'GET', 
            url:'./list',             
            success:function(data){             
                tree.render(data);
                tree.expandAll();
                loadMenu();                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                showAlert("alertContainer", "Obtener", "Ocurrio un error al obtener las notas"), "ERROR";
            }  
         });    
    }

    function guardarArchivo(title, content, activeTab){
        if (content.length > lengthMaxfile){
            alert("La nota no puedo pesar mas de 5 megaBytes!");
        }else{
            $.ajax({
                type:'POST', 
                url:'./store',
                data: {title:title, content:content },
                success:function(data){  
                    activeTab.attr("data-id", data);
                    activeTab.attr("editor-modified","false");
                    treeReload();                
                    showAlert("alertContainer", "Guardar", "La nota " + title + " se guardo satisfactoriamente", "EXITO");                               
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    showAlert("alertContainer", "Guardar", "Ocurrio un error al guardar la nota"), "ERROR";
                } 
            });
        }
    }

    function actualizarArchivo(id, title, content, activeTab){
        $.ajax({
            type:'PUT', 
            url:'./update/'+ id,
            data: {title:title, content:content },
            success:function(data){  
                activeTab.attr("editor-modified","false");                              
                treeReload();                
                showAlert("alertContainer", "Actualizar", "La Nota " + title + " se guardo satisfactoriamente", "EXITO");                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                showAlert("alertContainer", "Actualizar", "Ocurrio un error al guardar la nota"), "ERROR";
            }  
         });
    }

    $('.add-guardar').click(function (e) {                    
        e.preventDefault();
        var activeTab = $("ul#myTab a.active");
        if (activeTab.length > 0){
            var title = activeTab.text();
            var id = activeTab.attr("data-id");  
            var editorId = 'editor'+activeTab.attr("editor-id");  
            var content = CKEDITOR.instances[editorId].getData();             
            if (id > 0){            
                actualizarArchivo(id, title, content, activeTab);
            }else{
                guardarArchivo(title, content, activeTab);            
            }
        }                
    });

    function showAlert(idDiv, titulo, mensaje, resultado){   
        var tipo;
        if (resultado == 'EXITO'){
            tipo = 'alert-success';
        }else{
            tipo = 'alert-danger';
        }
        var mensaje = '<div class="alert ' + tipo + ' alert-dismissible fade show" role="alert">' +
                            '<strong>' + titulo + ' </strong> ' + mensaje + '.' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                            '</button>' +
                       '</div>';
        $('#'+idDiv).append(mensaje);        
        setTimeout(function(){ $('#'+idDiv).empty();}, 3000);        
    }  
    
    $('#btnEliminar').click(function (e) {  
        var id = $("#context-menu #idFile").val();    
        var title = $("#context-menu #nameFile").val();          
        $.ajax({
            type:'PUT',
            url:'./delete/'+ id,            
            success:function(data){                 
                treeReload();                
                showAlert("alertContainer", "Eliminar", "La nota " + title + " se elimino correctamente", "EXITO");                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                showAlert("alertContainer", "Eliminarar", "Ocurrio un error al eliminar la nota"), "ERROR";
            }  
         });
         $("#mdlEliminar").modal('hide');
         closeTabFromId(id); 
    });

    $('#donwloadWord').click(function (e) {          
        var id = $("#context-menu #idFile").val();        
        location.href = './export/'+ id;
    });
    
});  

$(document).ajaxStart(function(){    
    $("#loading-overlay").show();
});
  
$(document).ajaxComplete(function(){    
    $("#loading-overlay").hide();
});