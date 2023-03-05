<link rel="shortcut icon" href="images/upeu.jpg">
 <?php
 ini_set('display_errors', 1);
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categoria');
?>

<?php
if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price', 'date-final' );
   validate_fields($req_fields);
   
   //Agregado para la fecha de vencimiento
   $date_format = "Y-m-d";
   $p_ven = remove_junk($db->escape($_POST['date-final']));
   $vencimiento = DateTime::createFromFormat($date_format, $p_ven);
   $hoy = new DateTime();
   
   if(empty($errors) && $vencimiento && $vencimiento >= $hoy){
     $p_name  = remove_junk($db->escape($_POST['product-title']));
     $p_cat   = remove_junk($db->escape($_POST['product-categorie']));
     $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
     $p_buy   = remove_junk($db->escape($_POST['buying-price']));
     $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
     
     // Agregar el valor "vigente" a la variable $p_est
     $p_est = "vigente"; 

     $date    = make_date();
     $query  = "INSERT INTO medicamentos (";
     $query .=" medicamentos_nombre,medicamentos_stock,medicamentos_precioc,medicamentos_preciov,medicamentos_fvencimiento,categoria_id, medicamentos_estado";
     $query .=") VALUES (";
     $query .=" '{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_ven}', '{$p_cat}', '{$p_est}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE medicamentos_nombre='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Producto agregado exitosamente. ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('product.php', false);
     }

   } else{
     if (!$vencimiento) {
        $session->msg('d',"El campo de la fecha esta vacia.");
     } elseif ($vencimiento < $hoy) {
        $session->msg('d',"La fecha de vencimiento ha pasado o es hoy.");
     } else {
        $session->msg('d', $errors);
     }
     redirect('add_product.php',false);
   }
 }
?>


<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar producto</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="add_product.php" class="clearfix">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" placeholder="Descripción">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                      <option value="">Selecciona una categoría</option>
                    <?php  foreach ($all_categories as $cat): ?>
                      <option value="<?php echo (int)$cat['categoria_id'] ?>">
                        <?php echo $cat['categoria_nombre'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                      <i class="glyphicon glyphicon-th-large"></i>
                      </span>
                      <input type="text" class="datepicker form-control" name="date-final" placeholder="Fecha de Vencimiento">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="product-quantity" placeholder="Cantidad">
                  </div>
                 </div>
                 <div class="col-md-4">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buying-price" placeholder="Precio de Compra">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="saleing-price" placeholder="Precio de Venta">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
               </div>
              </div>
              <button type="submit" name="add_product" class="btn btn-danger">Agregar producto</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
