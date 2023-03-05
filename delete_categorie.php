<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  $categorie = find_by_categoria_id('categoria',(int)$_GET['categoria_id']);
  if(!$categorie){
    
    $session->msg("d","ID de la categoría falta.");
    redirect('categorie.php');
  }
?>
<?php
  $sql = "CALL sp_eliminar_categoria({$categorie['categoria_id']})";
  $result = $db->query($sql);
  if($result && $db->affected_rows() === 1) {
    $session->msg("s", "Categoría eliminada con éxito.");
    redirect('categorie.php',false);
  } else {
    $session->msg("d", "Lo siento, algo falló.");
    redirect('categorie.php',false);
  }
  
?>
