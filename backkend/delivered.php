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
            <h1>Entregados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Entregados</li>
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
          <h3 class="card-title">Pedidos Entregados</h3>

         
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
                          Cantidad
                      </th>
                      <th class="text-center">
                        Precio 
                      </th>
                      <th>
                          Metodo de pago
                      </th>
                      <th>
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $select_products = $conn->prepare("SELECT p.*, c.name AS user_name, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN users c ON p.userId = c.id INNER JOIN products s ON p.productId = s.id WHERE p.orderStatus=3" ); 
    $select_products->execute();
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
        echo '<td colspan="9"><strong>' . $userName . '</strong></td>';
        echo '</tr>';

        foreach ($userOrders as $order) {
            echo '<tr>';
            echo '<td><div class="product-img">
                      <img src="img/product/'.$order['product_image'].'" alt="Product Image" class="img-size-50">
                    </div></td>';
            echo '<td><small>Efectuado el: ' . $order['orderDate'] . '</small></td>';
            echo '<td>' . $order['product_name'] . '</td>';
            echo '<td class="project_progress">' . $order['quantity'] . '</td>';
            echo '<td>' . $order['product_price'] . ' €</td>';
            echo '<td>' . $order['paymentMethod'] . '</td>';
            echo '<td class="project-state">';
            
            echo '<span class="text-success fs-1">Entregado</span>';


            echo '</td>';
            echo '<td class="project-actions text-right">';
            echo '<a class="btn btn-primary btn-sm" href="productId.php?id=' . $order['productId'] . '"><i class="fas fa-folder"></i> Ver</a>&nbsp;';
            echo '</td>';
            echo '</tr>';
        }
    }
} else {
    echo '<h1-6>Sin producto <span class="badge bg-primary">Actuellemente</span></h1-6>';
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
