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
            <h1>Facturation</h1>
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

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Facture Clients</h3>

         
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      
                      <th>
                          Nom 
                      </th>
                      <th></th>
                      <th>
                          Produit
                      </th>
                      <th>
                          Quantité
                      </th>
                      <th>
                        Prix unitaire
                      </th>
                      <th>
                          Moyen de payments
                      </th>
                      <th>
                          Total
                      </th>
                      <th>
                          
                      </th>
                      
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     $userid = $_GET["id"];
    $select_products = $conn->prepare("SELECT p.*, c.name AS user_name, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN users c ON p.userId = c.id INNER JOIN products s ON p.productId = s.id WHERE p.orderStatus!='Valider' AND p.userId=?" ); 
    $select_products->execute([$userid]);
    $currentUserID = null;
    $ordersByUser = [];
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
         $userName = $fetch_product['user_name'];
   if (!isset($ordersByUser[$userName])) {
            $ordersByUser[$userName] = [];
        }

        // Agrega el pedido al usuario actual
        $ordersByUser[$userName][] = $fetch_product;
    }

    // Recorre los usuarios y sus pedidos
    foreach ($ordersByUser as $userName => $userOrders) {
        echo '<tr>';
        echo '<td colspan="12"><strong>' . $userName . '</strong><br>';
         $userId = $userOrders[0]['userId'];
        
    $totalUsuario = 0;

   
     echo '</tr>';

        foreach ($userOrders as $order) {
            echo '<tr>';
            echo '<td><div class="product-img">
                      <img src="images/'.$order['product_image'].'" alt="Product Image" class="img-size-50">
                    </div></td>';
            echo '<td><small>Commandé le: ' . $order['orderDate'] . '</small></td>';
            echo '<td>' . $order['product_name'] . '</td>';
            echo '<td class="project_progress">' . $order['quantity'] . '</td>';
            echo '<td class="project_progress">' . $order['product_price'] . ' €</td>';
            echo '<td>' . $order['paymentMethod'] . '</td>';
            echo '<td class="text-info"><strong>'.$order['product_price'] * $order['quantity'].'€</strong><td/>';
            
            $totalUsuario += $order['product_price'] * $order['quantity'];
            
            
            echo '</tr>';
           
        }
        echo '<tr>';
            
        echo '<td colspan="12">';
        echo '<div class="float-end text-warning"><strong>Total: '.$totalUsuario . '€</strong></div><br>';
        echo '<div class="float-end"><a class="btn btn-info btn-sm" href="invoice.php"><i class="fas fa-solid fa-rotate-left"></i></i> Retour</a></div><br>';
        echo '</td>';
        echo '</tr>';
    }
    
} else {
    echo '<p>Pas de facture <span class="badge bg-primary">en attente</span></p>';
}?>
                
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

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
