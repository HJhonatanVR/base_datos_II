<title>PRODUCTOS
</title>
<link rel="shortcut icon" href="images/upeu.jpg">
 <?php
 ini_set('display_errors', 1);
  $page_title = 'Lista de productos';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
        <div class="pull-left">
           <a href="mostrarVenc_product.php" class="btn btn-danger">Mostrar Medicamentos Vencidos</a>
         </div>
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">Agregar producto</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">Codigo</th>
                <th class="text-center" style="width: 10%;"> Categoría </th>
                <th> Descripción </th>
                <th class="text-center" style="width: 20%;"> Precio de compra</th>
                <th class="text-center" style="width: 10%;"> Stock </th>
                <th>Fecha de vencimiento</th>
                <th>Estado</th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $medicamento):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                
                <td class="text-center"> <?php echo remove_junk($medicamento['codigo']); ?></td>
                <td> <?php echo remove_junk($medicamento['medicamentos_nombre']); ?></td>
                <td class="text-center"> <?php echo remove_junk($medicamento['medicamentos_precioc']); ?></td>
                <td class="text-center"> <?php echo remove_junk($medicamento['medicamentos_stock']); ?></td>
                <td class="text-center"> <?php echo read_date($medicamento['medicamentos_fvencimiento']); ?></td>
                <td class="text-center" style="vertical-align: middle;">
                    <?php
                        $estado = remove_junk($medicamento['medicamentos_estado']);
                        if($estado === "vigente") {
                            echo '<span class="label label-success">' . $estado . '</span>';
                        } else if ($estado === "vencido") {
                            echo '<span class="label label-danger">' . $estado . '</span>';
                        } else {
                            echo '<span class="label label-default">' . $estado . '</span>';
                        }
                    ?>
                </td>

                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?medicamentos_id=<?php echo (int)$medicamento['medicamentos_id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="delete_product.php?medicamentos_id=<?php echo (int)$medicamento['medicamentos_id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php'); ?>
