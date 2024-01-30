<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}


if (isset($_GET['delete'])) {
            $delete = $_GET["delete"];
            $delete = $conn -> prepare("DELETE FROM `messages` WHERE id = ?");
            $delete -> execute([$delete_category]);
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
            <h1>Messages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Messages Clients</li>
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
          <h3 class="card-title">Nouveau Message</h3>

         
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
                          Message
                      </th>
                      <th>
                          Telephone
                      </th>
                      <th class="text-center">
                        email
                      </th>
                      
                      <th>
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $select_products = $conn->prepare("SELECT p.*, c.name AS user_name, c.contactno AS telephone_user, c.email AS email_user FROM messages p INNER JOIN users c ON p.userId = c.id WHERE p.status=0" ); 
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
            echo '<td></td>';
            echo '<td><small>Message du: ' . $order['date'] . '</small></td>';
            echo '<td>' . $order['message'] . '</td>';
            echo '<td class="project_progress">' . $order['telephone_user'] . '</td>';
            echo '<td>' . $order['email_user'] . '</td>';
            
            echo '<td class="project-actions text-right">';
            echo '<a class="btn btn-success btn-sm" href="messages-readOK.php?read='.$order['id'].'"><i class="fas fa-check"></i> Marquer comme lu</a>&nbsp;';
            echo '<a class="btn btn-info btn-sm" href="#"><i class="fas fa-pencil-alt"></i> Repondre</a>&nbsp;';
            echo '<a class="btn btn-danger btn-sm" href="messages-read.php?delete='.$order['id'].'"><i class="fas fa-trash"></i> Effacer</a>';
            echo '</td>';
            echo '</tr>';
        }
    }
} else {
    echo '<div class="alert alert-info" role="alert">
  Pas de nouveau messages!
</div> ';
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
