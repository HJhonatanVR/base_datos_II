<?php
ini_set('display_errors', 1);
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $product = find_by_medicamentos_id('medicamentos',(int)$_GET['medicamentos_id']);
  if(!$product){
    $session->msg("d","ID vacío");
    redirect('product.php');
  }
?>
<?php
  $delete_id = delete_by_medicamentos_id('medicamentos',(int)$product['medicamentos_id']);
  if($delete_id){
      $session->msg("s","Producto eliminado");
      redirect('product.php');
  } else {
      $session->msg("d","Eliminación falló");
      redirect('product.php');
  }
?>
