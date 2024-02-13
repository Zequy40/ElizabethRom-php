<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['update_status'])){

   $pid = $_POST['pid'];
   $name = $_POST['status'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   

   $update_product = $conn->prepare("UPDATE `orders` SET orderStatus = ? WHERE id = ?");
   $update_product->execute([$name, $pid]);

   $message[] = 'Categorie modifier avec succes!';
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
            <h1>Pedidos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pedidos</li>
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
          <h3 class="card-title">Pedido cliente</h3>

         
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      
                      <th>
                          Nombre 
                      </th>
                      <th></th>
                      <th>
                          Producto
                      </th>
                      <th>
                          Quantidad
                      </th>
                      <th >
                        Precio
                      </th>
                      <th>
                          Metodo de pago
                      </th>
                      <th class="text-center">
                          Estado
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $select_products = $conn->prepare("SELECT p.*, c.name AS user_name, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN users c ON p.userId = c.id INNER JOIN products s ON p.productId = s.id WHERE  p.userId=?" ); 
    $cmdUser = $_GET['id'];
    $select_products->execute([$cmdUser]);
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
        echo '<td colspan="9"><strong>' . $userName . '</strong><br>';
        echo '</tr>';

        foreach ($userOrders as $order) {
            echo '<tr>';
            echo '<td><div class="product-img">
                      <img src="img/product/'.$order['product_image'].'" alt="Product Image" class="img-size-50">
                    </div></td>';
            echo '<td><small>Hecho el: ' . $order['orderDate'] . '</small></td>';
            echo '<td>' . $order['product_name'] . '</td>';
            echo '<td class="project_progress">' . $order['quantity'] . '</td>';
            echo '<td>' . $order['product_price'] . ' €</td>';
            echo '<td>' . $order['paymentMethod'] . '</td>';
            echo '<td class="project-state">';
if ($order['orderStatus'] == 1) {
    echo "Pagado";
} elseif ($order['orderStatus'] == 2) {
    echo "Enviado";
} elseif ($order['orderStatus'] == 3) {
    echo "Entregado";
}
echo '</td>';

            echo '</tr>';
        }
    }
} else {
    echo '<h1>No hay productos<span class="badge bg-primary">Actuellemente</span></h1>';
}?>
                
              </tbody>
          </table>
        </div>
        
        <!-- /.card-body -->
      </div><a class="btn btn-primary btn-sm" href="users-only.php?id=<?php echo $cmdUser;?>"><i class="fas fa-reply"></i> volver</a>&nbsp;
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
