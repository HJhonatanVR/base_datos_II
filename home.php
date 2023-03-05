<title>
HOME
</title>

<link rel="shortcut icon" href="images/upeu.jpg">
 

 <?php
  $page_title = '';
  require_once('includes/load.php');
  if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
   
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>BIENVENIDO A SISTEMA UPEU-FARMA</h1>
     
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
