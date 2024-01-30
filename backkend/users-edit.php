<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}
if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $contactn = $_POST['contactn'];
   $contactn = filter_var($contactn, FILTER_SANITIZE_STRING);
   $adress = $_POST['adress'];
   $adress = filter_var($adress, FILTER_SANITIZE_STRING);
   $state = $_POST['state'];
   $state = filter_var($state, FILTER_SANITIZE_STRING);
   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);
   $cp = $_POST['cp'];
   $cp = filter_var($cp, FILTER_SANITIZE_STRING);
   $billingadress = $_POST['billingadress'];
   $billingadress = filter_var($billingadress, FILTER_SANITIZE_STRING);
   $billingstate = $_POST['billingstate'];
   $billingstate = filter_var($billingstate, FILTER_SANITIZE_STRING);
   $billingcity = $_POST['billingcity'];
   $billingcity = filter_var($billingcity, FILTER_SANITIZE_STRING);
   $billingcp = $_POST['billingcp'];
   $billingcp = filter_var($billingcp, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   
   
   

   $update_product = $conn->prepare("UPDATE `users` SET name = ?, email= ?, contactno= ?, shippingAddress= ?, shippingState= ?, shippingCity= ?, shippingPincode= ?, billingAddress= ?, billingState= ?, billingCity= ?, billingPincode= ?, status= ?, updationDate= NOW() WHERE id = ?");
   $update_product->execute([$name,$email,$contactn,$adress,$state,$city,$cp,$billingadress,$billingstate,$billingcity,$billingcp,$status,$pid]);

   $message[] = 'Client modifier avec succes!';
   
    $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'dist/img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `users` SET avatar = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'image 01 updated successfully!';
      }
   }
   
   header('location:users.php');
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
            <h1>Editer client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Editer client</li>
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
              <h3 class="card-title">Editer un client existant</h3>

            </div>
              <!-- form start -->
                
                  <div class="card-body register-card-body">
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
   
      $update_id = $_GET['user'];
      $select_category = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_category->execute([$update_id]);
      if($select_category->rowCount() > 0){
         while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){ 
   
?>
                    
              
                    <form action="" method="post">
                        <input type="hidden" name="pid" value="<?= $fetch_category['id']; ?>">
                        
                        <ul class="list-inline">
                            <li class="list-inline-item" >
                                <?php if($fetch_category['avatar']==""){
                                    echo'<img alt="Avatar" class="table-avatar" width="80" src="dist/img/default-150x150.png">';
                                }else{
                                    echo'<img alt="Avatar" class="table-avatar" width="80" src="dist/img/'.$fetch_category['avatar'].'">';
                                }?>
                                
                            </li>
                          
                        </ul>
                        
                        <div class="input-group mb-3">
                            
                            <label class="input-group-text" for="inputGroupFile02">Charger</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                            <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-image"></span>
                          </div>
                         </div>
                        </div>
                        
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nom" required maxlength="100" name="name" value="<?= $fetch_category['name']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" required maxlength="100" name="email" value="<?= $fetch_category['email']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nº contact" required maxlength="100" name="contactn" value="<?= $fetch_category['contactno']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Adresse" required maxlength="100" name="adress" value="<?= $fetch_category['shippingAddress']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Region" required maxlength="100" name="state" value="<?= $fetch_category['shippingState']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ville" required maxlength="100" name="city" value="<?= $fetch_category['shippingCity']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="CP" required maxlength="100" name="cp" value="<?= $fetch_category['shippingPincode']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Adresse de facturation" maxlength="100" name="billingadress" value="<?= $fetch_category['billingAddress']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Region de facturation" maxlength="100" name="billingstate" value="<?= $fetch_category['billingState']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ville de facturation" maxlength="100" name="billingcity" value="<?= $fetch_category['billingCity']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="CP de facturation" maxlength="100" name="billingcp" value="<?= $fetch_category['billingPincode']; ?>">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                    <label for="exampleCategorie">Niveau:</label>
                    
                    <select class="form-control" name="status">
                      <option selected disabled><?= $fetch_category['status']; ?></option>
                      <option value="actif">Actif</option>
                      <option value="inactif">Inactif</option>
                      
                    </select>
                  </div>
                      
                      <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-4">
                          <button type="submit" name="update" class="btn btn-primary btn-block">Editer</button>
                        </div>
                        <!-- /.col -->
                      </div>
                      <?php
         }
      }else{
         echo '<div class="alert alert-warning" role="alert">
  Aucun client enregistré!
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
