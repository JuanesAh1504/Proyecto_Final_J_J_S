<div class="modal fade" id="ModalEliminar<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">¿Estás seguro de eliminar esta imagen?</h3>
      </div>
      <div class="modal-body">
        <p>Imagen actual:</p>
        <center><img src="data:image/jpg;base64,<?php echo base64_encode($row['file_imgMedia']); ?>" class="img-responsive img-thumbnail" style="width:60%" alt=""></center>
        <form class="form-inline" autocomplete="off" action="" enctype="multipart/form-data" method="POST">
      <div class="modal-footer">
        <a href="DeleteImageGallery.php?id=<?php echo $row['id']?>" name="Eliminar_ImagenGaleria" class="btn btn-danger" id="" value="Eliminar">Eliminar</a>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>   
      </div>
    </div>
    </form>
  </div>
</div>