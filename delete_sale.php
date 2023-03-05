<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $d_sale = find_by_ventas_id('ventas',(int)$_GET['ventas_id']);
  if(!$d_sale){
    $session->msg("d","ID vacío.");
    redirect('sales.php');
  }
?>
<?php
  $delete_id = delete_by_ventas_id('ventas',(int)$d_sale['ventas_id']);
  if($delete_id){
      $session->msg("s","Venta eliminada.");
      redirect('sales.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('sales.php');
  }
?>
