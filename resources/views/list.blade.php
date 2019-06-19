
<br>
<div id="tree"></div>

<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
    <input type="hidden" name="idFile" id="idFile" value="" />
    <input type="hidden" name="nameFile" id="nameFile" value="" />    
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mdlEliminar">
     Eliminar
    </a>
    
</div>

<!-- Modal -->
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="mdlEliminarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdlEliminarLabel">Eliminar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Desea eliminar el archivo?        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id=btnEliminar>Eliminar</button>
      </div>
    </div>
  </div>
</div>