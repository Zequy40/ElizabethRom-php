<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Projects</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'components/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Facture</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Si vous appuyer sur le button print vous pourrez imprimez directement, si vous appuyez sur generer PDF cela vous préparera pour imprimer mais avec la posibilitez de le garder en PDF.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="./images/logo.svg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 80px"> Strong Gym
                    <small class="float-right">Date: <?php $fecha_actual = date('d-m-Y');
                                                        echo $fecha_actual;?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  De
                  <address>
                    <strong>Strong Gym</strong><br>
                    795, rue Folsom Ave, <br>
                    Paris, CP 94107<br>
                    Telephone: (+33) 6123-5432<br>
                    Email: info@strongym.com
                  </address>
                </div>
                <?php
     $userid = $_GET["id"];
$select_user_data = $conn->prepare("SELECT c.name AS user_name, c.billingAddress AS adress, c.billingCity AS city, c.billingPincode AS cp,c.shippingAddress AS adress2, c.shippingCity AS city2, c.billingPincode AS cp2, c.contactno AS phone, c.email AS mail,  p.orderDate, p.paymentMethod FROM orders p INNER JOIN users c ON p.userId = c.id WHERE p.orderStatus = 'Payer' AND p.userId=?");
$select_user_data->execute([$userid]);

if ($select_user_data->rowCount() > 0) {
    // Extraer datos del usuario y la orden
    $user_data = $select_user_data->fetch(PDO::FETCH_ASSOC);
        ?>
     
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Facturé a
                  <address>
                    <strong><?=$user_data['user_name'];?></strong><br>
                    <?php if($user_data['adress']==""){
                    echo $user_data['adress2'];
                        
                    }else{
                    $user_data['adress'];
                    }?><br>
                    <?php if($user_data['city']=="" && $user_data['cp']==""){
                    echo $user_data['city2'], $user_data['cp2'];
                        
                    }else{
                    echo $user_data['city'], $user_data['cp'];
                    }?><br>
                    Telephone: <?=$user_data['phone'];?><br>
                    Email: <?=$user_data['mail'];?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Facture #007612</b><br>
                  <br>
                  <b>Commandes ID:</b> 4F3S8J<br>
                  <b>Payé le:</b> <?=$user_data['orderDate'];?><br>
                  <b>Moyen de paiements:</b> <?=$user_data['paymentMethod'];?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Qté</th>
                      <th></th>
                      <th>Produit</th>
                      <th>Description</th>
                      <th>Prix unitaire</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                       <?php
                    // Ahora, realiza el bucle para mostrar los detalles de cada producto
                    $select_products = $conn->prepare("SELECT p.*, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE p.orderStatus = 'Livrer' AND p.userId=?");
                    $select_products->execute([$userid]);
                    if ($select_products->rowCount() > 0) {

                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                        $subtotal = $fetch_product['quantity'] * $fetch_product['product_price'];
                        $totalUsuario += $fetch_product['product_price'] * $fetch_product['quantity'];
                    ?>
                    
                      <td><?=$fetch_product['quantity'];?></td>
                      <td><img src="./images/<?=$fetch_product['product_image'];?>" alt="AdminLTE Logo" class="brand-image" style="opacity: .8; width: 40px"></td>
                      <td><?=$fetch_product['product_name'];?></td>
                      <td>El snort testosterone trophy driving gloves handsome</td>
                      <td><?= $fetch_product['product_price']?>€</td>
                      <td><?=$subtotal;?>€</td>
                    </tr>
                    <?php
                    }
                    }
                    else
                    {
                        echo '<div class="callout callout-danger">
              <h5><i class="fas fa-exclamation"></i> Note:</h5>
              Il n\'y a pas de fatures en attente pour cette commandes et clients .
            </div>';
                    }
                    
                    ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
<?php
                    }else{
                        echo "No hay datos de pago disponibles.";

                    }
                    
                    ?>
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Une fois la facture émise, toutes modifications devras être presentées par mail. Si vous avez besoin de changer de methode de paiements que ce soit autre que celui choisi, veuillez vous mettre en contact avec l'adminitration par mail au: <a href="mailto:admin@stronggym.com">ENVOYER MAIL</a>.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Facture du <?php $fecha_actual = date('d-m-Y');
                                                        echo $fecha_actual;?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?=$totalUsuario;?>€</td>
                      </tr>
                      <?php 
                      $tva = $totalUsuario * 1.20;
                      $port = $tva + 5.80;
                      $numberTva = number_format($tva, 2);
                      $numberPort = number_format($port, 2);
                      ?>
                      
                      <tr>
                        <th>Tva (20%)</th>
                        <td><?= $numberTva ?>€</td>
                      </tr>
                      <tr>
                        <th>Port:</th>
                        <td>5.80€</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?= $numberPort ?>€</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" onclick="window.print()">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->
<?php  include 'components/footer.php';?>
<script>
function function confirmarEliminacion() {
    return confirm("Vous vous vraiment effacer cette commande?");
}
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
