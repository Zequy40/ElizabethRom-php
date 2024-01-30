<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['update_supplier'])){
    $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $contact = $_POST['contact'];
   $contact = filter_var($contact, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   

      $insert_products = $conn->prepare("UPDATE `supplier` SET name= ?, contact= ?, email= ?, status= ?, phone= ? WHERE id = ?");
      $insert_products->execute([$name,$contact,$email,$status,$phone,$pid]);
      header('Location: supplier.php');

};

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
            <h1>Ajouter un Fournisseur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Créer Fournisseur</li>
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
              <h3 class="card-title">General</h3>

            </div>
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Attention</strong><br> '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }

$update_id = $_GET['id'];
      $select_category = $conn->prepare("SELECT * FROM `supplier` WHERE id = ?");
      $select_category->execute([$update_id]);
      if($select_category->rowCount() > 0){
         while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){ 
   
?>
                    
              
                    
                        <input type="hidden" name="pid" value="<?= $fetch_category['id']; ?>">
                  
                  <div class="form-group">
                    <label for="exampleCat">Nom:</label>
                    <input type="text" class="form-control" id="exampleCat" placeholder="<?= $fetch_category['name']; ?>" required maxlength="100" name="name" value="<?= $fetch_category['name']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleContact">Contact:</label>
                    <input type="text" class="form-control" id="exampleContact" placeholder="<?= $fetch_category['contact']; ?>" required maxlength="100" name="contact" value="<?= $fetch_category['contact']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleMail">email:</label>
                     <input type="text" name="email" id="examplePhone" placeholder="<?= $fetch_category['email']; ?>" class="form-control" required maxlength="500" value="<?= $fetch_category['email']; ?>"/>
                  </div>
                  <div class="form-group">
                    <label for="examplePhone">Telephone:</label>
                    <input type="number" name="phone" id="examplePhone" placeholder="<?= $fetch_category['phone']; ?>" class="form-control" required maxlength="500" value="<?= $fetch_category['phone']; ?>"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleCategorie">Etat:</label>
                    
                    <select class="form-control" name="status">
                      <option selected disabled><?php if($fetch_category['status']==0){
                      echo"inactif";
                      }else{
                      echo "actif"; } ?></option>
                      <option value="1">Actif</option>
                      <option value="0">Inactif</option>
                      
                    </select>
                  </div>
                  
                  <?php }
      } ?>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update_supplier">Modifier</button>
                </div>
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
