<?php
  $page_title = 'Editar categoría';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>
<?php
  //Display all catgories.
  $categorie = find_by_categoria_id('categoria',(int)$_GET['categoria_id']);
  if(!$categorie){
    $session->msg("d","Missing categorie id.");
    redirect('categorie.php');
  }
?>

<?php
if(isset($_POST['edit_cat'])){
  $req_field = array('categorie-name');
  validate_fields($req_field);
  $cat_name = remove_junk($db->escape($_POST['categorie-name']));
  if(empty($errors)){
    $sql = "CALL sp_actualizar_categoria('{$cat_name}', {$categorie['categoria_id']})";
     $result = $db->query($sql);
     if($result && $db->affected_rows() === 1) {
       $session->msg("s", "Categoría actualizada con éxito.");
       redirect('categorie.php',false);
     } else {
       $session->msg("d", "Lo siento, actualización falló.");
       redirect('categorie.php',false);
     }
  } else {
    $session->msg("d", $errors);
    redirect('categorie.php',false);
  }
}

?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
   <div class="col-md-5">
     <div class="panel panel-default">
       <div class="panel-heading">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Editando <?php echo remove_junk(ucfirst($categorie['categoria_nombre']));?></span>
        </strong>
       </div>
       <div class="panel-body">
         <form method="post" action="edit_categorie.php?categoria_id=<?php echo (int)$categorie['categoria_id'];?>">
           <div class="form-group">
               <input type="text" class="form-control" name="categorie-name" value="<?php echo remove_junk(ucfirst($categorie['categoria_nombre']));?>">
           </div>
           <button type="submit" name="edit_cat" class="btn btn-primary">Actualizar categoría</button>
       </form>
       </div>
     </div>
   </div>
</div>



<?php include_once('layouts/footer.php'); ?>
