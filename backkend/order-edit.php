<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}
if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $quantity = $_POST['quantity'];
   $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   

   $update_product = $conn->prepare("UPDATE `orders` SET quantity = ?, orderStatus = ? WHERE id = ?");
   $update_product->execute([$quantity, $status, $pid]);

   $message[] = 'Categorie modifier avec succes!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Project Add</title>

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
            <h1>Ajouter une Categorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Modifier Commandes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Commande</h3>

            </div>
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Bravo</strong><br> '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }
   
      $update_cmd = $_GET['id'];
      $select_cmd = $conn->prepare("SELECT p.*, c.name AS user_name, s.productName AS product_name, s.productPrice AS product_price FROM orders p INNER JOIN users c ON p.userId = c.id INNER JOIN products s ON p.productId = s.id WHERE p.id=?" ); 
    $select_cmd->execute([$update_cmd]);
      if($select_cmd->rowCount() > 0){
         while($fetch_cmd = $select_cmd->fetch(PDO::FETCH_ASSOC)){ 
   
?>
                    <div class="form-group">
                      <input type="hidden" name="pid" value="<?= $fetch_cmd['id']; ?>">
                    <label for="exampleCat">Nom du produit:</label>
                    <input type="text" class="form-control" disabled value="<?= $fetch_cmd['product_name']; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleDescription">Quantité:</label>
                    <input type="text" class="form-control" name="quantity" value="<?= $fetch_cmd['quantity']; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCat">Prix Unitaire:</label>
                    <input type="text" class="form-control" disabled value="<?= $fetch_cmd['product_price']; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleDescription">Methode de paiement:</label>
                   <input type="text" class="form-control" disabled value="<?= $fetch_cmd['paymentMethod']; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCat">Commandé le:</label>
                    <input type="text" class="form-control" disabled value="<?= $fetch_cmd['orderDate']; ?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCat">Status:</label>
                    <select class="form-control" name="status">
                        <option disabled selected><?= $fetch_cmd['orderStatus']?></option>
                        <option value="Livrer">Livrer</option>
                        <option value="En Attente">En Attente</option>
                        <option value="Complet">Complet</option>
                        <option value="En progres">En progres</option>
                    </select>
     </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" name="update" class="btn btn-primary" value="Modifier">
                   <a href="orders.php" class="btn btn-success">Retour</a>
                </div>
                <?php
         }
      }else{
         echo '<div class="alert alert-warning" role="alert">
  Aucune categorie enregistrée!
</div>';
      }
   ?>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
     
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
