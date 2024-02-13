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
            <h1>Clients</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cliente</li>
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
          <h3 class="card-title">Clientes</h3>

          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      
                      <th>
                          Nombre del Cliente
                      </th>
                      <th>
                          Email
                      </th>
                       <th>
                          Nº de contacto
                      </th>
                      <th>
                          Direccion
                      </th>
                       <th>
                       Direccion de facturacion
                      </th>
                     
                      <th class="text-center">
                          Estado
                      </th>
                      <th>
                      </th>
                  </tr>
              </thead>
              <tbody>
    <?php
    $id= $_GET["id"];
    $select_products = $conn->prepare("SELECT * FROM `users` WHERE id = ?"); 
    $select_products->execute([$id]);
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
  ?>
                  <tr>

                      <td>
                          <?=$fetch_product['id'] ;?>
                      </td>
                      
                      <td>
                          <a>
                            <?=$fetch_product['name'] ;?>
                          </a>
                          <br/>
                          <small>
                              Created <?=$fetch_product['regDate'] ;?>
                          </small>
                      </td>
                      <td class="project_progress">
                          <small>
                            <?=$fetch_product['email'] ;?>
                          </small>
                      </td>
                       <td>
                          <?=$fetch_product['contactno'] ;?>
                      </td>
                       <td>
                          
                          <?=$fetch_product['shippingAddress'] ;?> <small>
                          <br/>
                          <?=$fetch_product['shippingState'] ;?> - 
                          <?=$fetch_product['shippingCity'] ;?>
                          <br/>
                          <?=$fetch_product['shippingPincode'] ;?>
                           </small>
                           
                       <td>
                          
                          <?=$fetch_product['billingAddress'] ;?><small>
                          <br/>
                          <?=$fetch_product['billingState'] ;?> - 
                          <?=$fetch_product['billingCity'] ;?>
                          <br/>
                          <?=$fetch_product['billingPincode'] ;?>
                           </small>
                      </td>
                      
                      <td class="project-state">
                        
                          <?php if($fetch_product['status']==1){
                              ?>
                          <span class="badge badge-success">Activo</span>
                          <?php }else if($fetch_product['status']==0){
                              ?>
                          <span class="badge badge-danger">Inactivo</span>
                          <?php
                          }?>
                      
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="users.php">
                              <i class="fa-solid fa-arrow-rotate-left"></i>
                              </i>
                              Volver
                          </a>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-warning btn-sm" href="orderId_user.php?id=<?php echo $id?>">
                              <i class="fa-solid fa-arrow-rotate-left"></i>
                              </i>
                              Pedidos
                          </a>
                      </td>
                  </tr>
                  <?php
                  }
                }
                  else {
                    ?>
                    <h1-6>No hay clientes <span class="badge bg-primary">Actuellemente</span></h1-6>
                    <?php 
                    }
                     ?>
                  
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

  <?php include 'components/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
