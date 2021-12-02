<div class="modal fade" id="ModalGaleria<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Actualizar imagen</h3>
      </div>
      <div class="modal-body">
        <p>Imagen actual:</p>
        <center><img src="data:image/jpg;base64,<?php echo base64_encode($row['file_imgMedia']); ?>" class="img-responsive img-thumbnail" style="width:40%" alt=""></center>
        <form class="form-inline" autocomplete="off" action="" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <div class="form-group"> 
                <div class="row">
                    <div class="col-md-6">
                        <h5>Seleccione una imagen</h5>
                        <input type="file" class="form-control" name="file_imgMedia">
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <div class="row">
                    <div class="col-md-6">
                        <h5>Descripción de la imagen</h5>
                        <input type="text" class="form-control" name="file_name" value="<?php echo $row['file_name']?>">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="GuardarImagenGaleria" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
    </form>
  </div>
</div>
<?php 
   if(isset($_POST['GuardarImagenGaleria'])){
    include("includes/NewConexion.php");
      $id = $_REQUEST['id'];
      $file_name = $_POST['file_name'];
      $file_imgMedia = addslashes(file_get_contents($_FILES['file_imgMedia']['tmp_name']));

      $query="UPDATE media SET file_name='".$file_name."', file_imgMedia='".$file_imgMedia."' WHERE id='".$id."'  ";
	    $resultado = $conexion->query($query);

	    if($resultado){
		  echo "<script>alert('Los datos han sido actualizados correctamente');window.location='media.php'</script>";
	    }else{
		  echo "<script type=\"text/javascript\">alert(\"No se podrán guardar los datos\");</script>";  
	    }

   }

?>