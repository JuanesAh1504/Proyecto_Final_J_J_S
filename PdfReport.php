
<?php

ob_start();

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
      
    endif;

  } else {
    
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
  <?php if($results): ?>
    <div class="page-break" style="width:100%"><br><br><br>
      <img src="http://<?php echo $_SERVER['HTTP_HOST']?>/Proyecto_Final_J_J_S/uploads/Logotipo_de_la_Corporación_Universitaria_Minuto_de_Dios.png" alt="Logo Uniminuto" style="margin-top:-46px;width:25%" class="">
       <div class="sale-head pull-right" style="position: relative;margin-top:-50px">
           <h1 style="background-color:#138fcb;font-weight:bold;color:white;">Reporte de Pedidos</h1>
           <strong><?php if(isset($start_date)){ echo $start_date;}?> a <?php if(isset($end_date)){echo $end_date;}?> </strong>
       </div>
       <br><br><table class="table table-border table-hover">
        <thead>
          <tr>
              <th>Fecha</th>
              <th>Descripción</th>
              <th>Nombre del estudiante</th>
              <th>Correo electrónico</th>
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
              <td class="text-right"><?php echo remove_junk($result['total_sales']);?></td>
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
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } 
  $html = ob_get_clean();
  //echo $html;

  require_once 'dompdf/autoload.inc.php';
  use Dompdf\Dompdf;
  $dompdf = new Dompdf;

  $options = $dompdf->getOptions();
  $options->set(array('isRemoteEnabled' => true));
  $dompdf->setOptions($options);

  $dompdf->loadHtml($html);

  $dompdf->setPaper('letter','landscape');

  $dompdf->render();
  $dompdf->stream("ReporteFechaFiltrada.pdf", array("Attachment" => false));
?>
