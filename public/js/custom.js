

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
                    addNewTab(nameFile, str,0);
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
        var newli = '<li class="nav-item"><a editor-id=' +id +' data-id=' + idNote + ' id=' + tabId + ' class="nav-link" href="#' + codId + '" data-toggle="tab" role="tab" aria-controls="' + codId +'" aria-selected="false">' + nameFile + '</a><span> x </span></li>';
        var newckeditor = '<textarea class="ckeditor"  name="editor' + id +'" id="editor' + id +'" rows="10" cols="80"></textarea>'
        var newdiv = '<div class="tab-pane fade" id="' + codId + '" role="tabpanel" aria-labelledby="' + tabId +'" > ' + newckeditor + '</div>'
        $(".nav-tabs li").last().closest('li').after(newli);
        $('.tab-content').append(newdiv);
        $('.nav-tabs li:nth-child(' + idCurrent + ') a').click();
        CKEDITOR.replace("editor" + id).setData(str);;                                        
    }           

    $('.add-nuevo').click(function (e) {                    
        e.preventDefault();
        addNewTab("","",0);    
    });

    $(".nav-tabs").on("click", "span", function () {                    
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $(".nav-tabs li").children('a').first().click();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });                

    var tree = $('#tree').tree({
        primaryKey: 'id',
        uiLibrary: 'bootstrap4',
        border: true,
        dataSource: './list'       
    }).expandAll();

    tree.on('select', function (e, node, id) {
            if (id != 0){
                var name = node.find('[data-role="display"]').text();
                var data = getValue(name, id);                
            }                    
    });

    function getValue(name, id){
        $.ajax({
            type:'GET', 
            url:'./edit/'+id,             
            success:function(data){ 
                addNewTab(name, data, id);
            } 
         });
    }

    function guardarArchivo(title, content){
        $.ajax({
            type:'POST', 
            url:'./store',
            data: {title:title, content:content },
            success:function(data){ 
                alert("Se guardo satisfactoriamente!");                
                tree.reload();
            } 
         });
    }

    function actualizarArchivo(id, title, content){
        $.ajax({
            type:'PUT', 
            url:'./update/'+ id,
            data: {title:title, content:content },
            success:function(data){ 
                alert("Se actualizo satisfactoriamente!");
            } 
         });
    }

    $('.add-guardar').click(function (e) {                    
        e.preventDefault();
        var activeTab = $("ul#myTab a.active");
        var title = activeTab.text();
        var id = activeTab.attr("data-id");  
        var editorId = 'editor'+activeTab.attr("editor-id");  
        var content = CKEDITOR.instances[editorId].getData(); 
        if (id > 0){            
            actualizarArchivo(id, title, content);
        }else{
            guardarArchivo(title, content);            
        }        
    });

});  