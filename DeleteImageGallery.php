<?php 
	
include("includes/NewConexion.php"); 

	$id= $_REQUEST['id'];

	$DeleteRegistro = ("DELETE FROM media WHERE id = '".$id."'");
	mysqli_query($conexion, $DeleteRegistro);

	if($DeleteRegistro){
		echo "<script>alert('La imagen se ha eliminado correctamente');window.location='media.php?exit!'</script>";
	}else{
		echo "<script>alert('La imagen no se pudo eliminar');window.location='media.php?fail!'</script>";
	}

?>