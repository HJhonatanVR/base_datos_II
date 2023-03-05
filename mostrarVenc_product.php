<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $sql = "CALL actualizar_estado()";
  $result = $db->query($sql);
  if($result && $db->affected_rows() === 1) {
    $session->msg("s", "Medicinas caducadas que se recomienda ser remplazadas por unas vigentes!!");
    redirect('product.php',false);
  } else {
    $session->msg("d", "Aún no hay MEDICINAS que esten vencidas.");
    redirect('product.php',false);
  }
  
?>
