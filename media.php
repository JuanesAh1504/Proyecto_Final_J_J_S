<?php
  $page_title = 'Lista de imagenes';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php $media_files = find_all('media');?>
<?php
  if(isset($_POST['GuardarMedia'])) {
    include("includes/NewConexion.php");
    $file_name = $_POST['file_name'];
    $file_imgMedia = addslashes(file_get_contents($_FILES['file_imgMedia']['tmp_name']));

    $queryInsertMedia = "INSERT INTO media(file_name,file_imgMedia) VALUES('$file_name','$file_imgMedia')";
    $ResultadoMedia = $conexion->query($queryInsertMedia);

    if($ResultadoMedia){
      echo "<script>alert('Se guardaron los datos correctamente')</script>";
    }else{
      echo "<script>alert('Los datos no se pudieron guardar correctamente, por favor intente de nuevo.')</script>";
    }
  }

?>
<?php include_once('layouts/header.php'); ?>
     <div class="row">
        <div class="col-md-6">
          <?php echo display_msg($msg); ?>
        </div>

      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading clearfix">
            <span class="glyphicon glyphicon-camera"></span>
            <span>Lista de imagenes</span>
            <div class="pull-right">
              <form class="form-inline" autocomplete="off" action="media.php" enctype="multipart/form-data" method="POST">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-btn">
                 <button type="button"  data-toggle="modal" data-target="#ModalAddMedia" class="btn btn-primary">Agregar nueva imagen</button>
                  <div class="modal fade" id="ModalAddMedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Añadir nueva imagen</h3>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                <h5>Seleccione una imagen</h5>
                                <input type="file" class="form-control" style="border:1px solid #cccccc;" name="file_imgMedia" placeholder="Selecciona un imagen">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-9">
                                <h5>Descripción de la imagen</h5>
                                <input type="text" name="file_name" class="form-control" style="border:1px solid #cccccc;">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                          <button type="submit" name="GuardarMedia" class="btn btn-primary">Guardar</button>
                        </div>
                      </div>
                    </div>
                  </div>
               </div>
              </div>
             </form>
            </div>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center" style="width: 50px;">#</th>
                  <th class="text-center" style="width:40%">Imagen</th>
                  <th class="text-center">Descripción</th>
                  <th class="text-center" style="width: 50px;">Acciones</th>
                </tr>
              </thead>
                <tbody>
                <?php ?>
                <tr class="list-inline">
                  <?php 
                  include("includes/NewConexion.php");
                    $queryMostrar = "SELECT * FROM media";
                    $ResultadoMostrar = $conexion->query($queryMostrar);

                    while($row = $ResultadoMostrar->fetch_assoc()){
                  ?>
                 <td class="text-center"><?php echo count_id();?></td>
                  <td class="text-center">
                     <img src="data:image/jpg;base64,<?php echo base64_encode($row['file_imgMedia']); ?>" class="img-responsive img-thumbnail" alt="">
                  </td>
                  <td class="text-center">
                    <?php echo $row['file_name']?>
                  </td>
                  <td>
                    <button class="btn btn-warning" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#ModalGaleria<?php echo $row['id']?>" title="Modificar"><span class="glyphicon glyphicon-pencil"></span></button><br><br>
                    <button class="btn btn-danger" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#ModalEliminar<?php echo $row['id']?>" title="Modificar"><span class="glyphicon glyphicon-trash"></span></button>
                  </td>
                  <?php include("ModalActualizarMedia.php"); include("ModalBorrarMedia.php");?>
               </tr>
              <?php } ?>
            </tbody>
          </div>
        </div>
      </div>
</div>


<?php include_once('layouts/footer.php'); ?>
