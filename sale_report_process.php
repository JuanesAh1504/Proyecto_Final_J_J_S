<?php
$page_title = 'Reporte de ventas';
$results = '';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php
  if(isset($_POST['submit'])){
    $req_dates = array('start-date','end-date');
    validate_fields($req_dates);

    if(empty($errors)):
      $start_date   = remove_junk($db->escape($_POST['start-date']));
      $end_date     = remove_junk($db->escape($_POST['end-date']));
      $results      = find_sale_by_dates($start_date,$end_date);
    else:
      $session->msg("d", $errors);
      redirect('sales_report.php', false);
    endif;

  } else {
    $session->msg("d", "¬°Selecciona una fecha para filtrar los datos!");
    redirect('sales_report.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de ventas</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body><br>
  <center><div class="container">
    <div class="row align-items-center">
      <div class="col">
        <form action="PdfReport.php" method="POST">
          <input type="hidden" name="start-date" value="<?php if(isset($start_date)){ echo $start_date;}?>">
          <input type="hidden" name="end-date" value="<?php if(isset($end_date)){echo $end_date;}?>">
          <button type="button" class="btn btn-danger" onclick="location.href='admin.php'">P√°gina principal</button>
          <button type="button" class="btn btn-success" onclick="javascript:Print();">Imprimir</button>
          <button type="submit" name="submit" class="btn btn-warning">Generar PDF</button>
          <button type="button" class="btn btn-primary" onclick="location.href='sales_report.php'">Filtrar otra fecha</button>
        </form>
      </div>
    </div>
  </div></center>
  <?php if($results): ?>
    <div class="page-break" id="PrintFromHere">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/Logotipo_de_la_Corporaci%C3%B3n_Universitaria_Minuto_de_Dios.svg/1200px-Logotipo_de_la_Corporaci%C3%B3n_Universitaria_Minuto_de_Dios.svg.png" alt="Logo Uniminuto" style="margin-button:5px;width:25%" class="">
       <div class="sale-head pull-right">
           <h1 style="background-color:#138fcb;font-weight:bold;color:white;">Reporte de Pedidos</h1>
           <strong><?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
      <table class="table table-border table-hover">
        <thead>
          <tr>
              <th>Fecha</th>
              <th>Descripci√≥n</th>
              <th>Nombre del estudiante</th>
              <th>Correo Del Estudiante</th>
              <th>Cantidad total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class=""><?php echo remove_junk($result['date']);?></td>
              <td class="desc">
                <?php echo remove_junk(ucfirst($result['name']));?>
              </td>
              <td class="text-right"><?php echo remove_junk($result['name_estudiante']);?></td>
              <td class="text-right"><?php echo remove_junk($result['correo_estudiante']);?></td>
              <td class="text-right"><?php echo remove_junk($result['qty']);?></td>
                
          </tr>
          
        <?php endforeach; ?>
        </tbody>
        <tfoot>
         </tr>
        </tfoot>
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "No se encontraron ventas. ");
        redirect('sales_report.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>
<script>
  function Print(){
      var mywindow = window.open('', 'PRINT', 'height=400,width=600');
      mywindow.document.write('<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>');
    mywindow.document.write('<style>@media print {html,body{font-size: 9.5pt;margin: 0;padding: 0;}.page-break {page-break-before:always;width: auto;margin: auto;}}.page-break{width: 980px;margin: 0 auto;}.sale-head{margin: 40px 0;text-align: center;}.sale-head h1,.sale-head strong{padding: 10px 20px;display: block;}.sale-head h1{margin: 0;border-bottom: 1px solid #212121;}.table>thead:first-child>tr:first-child>th{border-top: 1px solid #000;}table thead tr th {text-align: center;border: 1px solid #ededed;}table tbody tr td{vertical-align: middle;}.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{border: 1px solid #212121;white-space: nowrap;}.sale-head h1,table thead tr th,table tfoot tr td{background-color: #f8f8f8;}tfoot{color:#000;text-transform: uppercase;font-weight: 500;} h1{background-color:#138fcb;color:white;}</style>');
      mywindow.document.write('</head><body >');
      mywindow.document.write(document.getElementById('PrintFromHere').innerHTML);
      mywindow.document.write('</body></html>');
      mywindow.document.close(); // necesario para IE >= 10
      mywindow.focus(); // necesario para IE >= 10
      mywindow.print();
      mywindow.close();
      return true;}

      if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>  
