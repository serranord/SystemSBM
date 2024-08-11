<!-- Button trigger modal 
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>
-->

<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title mx-auto" id="exampleModalLabel">Eliminando....</h5>        
      </div>
      <div class="modal-body text-center">
        <i class="fa-solid fa-skull-crossbones btn btn-danger" style="margin: auto; clear:both"></i></br> 
        <p style="text-align:center; color:red">¿Estas seguro que deseas eliminar este cliente?</p></br> 
        <input type="text" id="nombre" name="nombre" style="text-transform: uppercase;  font-size: 1.5rem; font-weight:600; border: none;  text-align:center;" >
      </div>
      <div class="modal-footer">
       <form action="eliminar_cliente.php" method="POST">       
          <input type="hidden" name="id" id="id">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
       </form> 
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


<!-- Modal -->
<div class="modal fade" id="agregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title mx-auto" id="exampleModalLabel">Estas agregando...</h5>        
      </div>
      <div class="modal-body text-center">
        <i class="fa-solid fa-skull-crossbones btn btn-danger" style="margin: auto; clear:both"></i></br> 
        <p style="text-align:center; color:red">!Se recomienda consultar esta accion!</p></br> 
        <input type="text" name="nombre" style="text-transform: uppercase;  font-size: 1.5rem; font-weight:600; border: none;  text-align:center;" >
      </div>
      <div class="modal-footer">
       <form action="eliminar_usuario.php" method="POST">       
          <input type="hidden" name="id" id="id">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
       </form> 
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title mx-auto" id="exampleModalLabel">Estas editando....</h5>        
      </div>
      <div class="modal-body text-center">
        <i class="fa-solid fa-skull-crossbones btn btn-danger" style="margin: auto; clear:both"></i></br> 
        <p style="text-align:center; color:red">!Se recomienda consultar esta accion!</p></br> 
        <input type="text" name="nombre" style="text-transform: uppercase;  font-size: 1.5rem; font-weight:600; border: none;  text-align:center;" >
      </div>
      <div class="modal-footer">
       <form action="eliminar_usuario.php" method="POST">       
          <input type="hidden" name="id" id="id">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
       </form> 
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->






