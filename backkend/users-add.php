<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}
if(isset($_POST['add_user'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $lastname = $_POST['lastname'];
   $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
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
   $user = $_POST['user'];
   $user = filter_var($user, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   
   
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'dist/img/'.$image_01;
   
   $select_products = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'Client existe déja!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `users`(avatar, name, lastName , email, contactno, shippingAddress, shippingState, shippingCity, shippingPincode, billingAddress, billingState, billingCity, billingPincode, status, user) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$image_01, $name,$lastname,$email,$contactn,$adress,$state,$city,$cp,$billingadress,$billingstate,$billingcity,$billingcp,$status,$user]);
      if($insert_products){
         if($image_size_01 > 2000000){
            $message[] = 'image trop grande!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            $message[] = 'Client creer!';
         }

      }
      header('Location: users.php');

   }  

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
            <h1>Créer client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Créer client</li>
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
              <h3 class="card-title">Créer un client</h3>

            </div>
             <div class="card-body register-card-body">
              <!-- form start -->
               <form action="" method="post" enctype="multipart/form-data">
                   
                   
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
                        <input type="text" class="form-control" placeholder="Nom" required maxlength="100" name="name">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Prenom" required maxlength="100" name="lastname">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" required maxlength="100" name="email">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Nº contact" required maxlength="100" name="contactn">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Adresse" required maxlength="100" name="adress">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Region" required maxlength="100" name="state">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ville" required maxlength="100" name="city">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="CP" required maxlength="100" name="cp">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <!-- Checkbox para indicar si los datos de facturación son diferentes -->
                       
  <input type="checkbox" class="btn-check" id="facturationCheckbox" autocomplete="off" style="display: none;">
  <label class="btn btn-outline-primary" for="facturationCheckbox">Adresse de facturation differentes?</label>

                     

                    <div id="facturationFields" style="display: none;">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Adresse de facturation" maxlength="100" name="billingadress">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Region de facturation" maxlength="100" name="billingstate">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ville de facturation" maxlength="100" name="billingcity">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                       <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="CP de facturation" maxlength="100" name="billingcp">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                     </div>
                      <div class="form-group">
                    <label for="exampleUser">User:</label>
                    
                    <select class="form-control" name="user">
                      
                      <option value="Client">Client</option>
                      <option value="Admin">Admin</option>
                      
                    </select>
                  </div>
                      <div class="form-group">
                    <label for="exampleCategorie">Etat:</label>
                    
                    <select class="form-control" name="status">
                      
                      <option value="actif">Actif</option>
                      <option value="inactif">Inactif</option>
                      
                    </select>
                  </div>
                      
                      <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-4">
                          <button type="submit" name="add_user" class="btn btn-primary btn-block">Créer</button>
                        </div>
                        <!-- /.col -->
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
  <?php include 'components/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!--script form billing -->
<script>
    // Obtener el checkbox y el contenedor de campos de facturación
    var facturationCheckbox = document.getElementById('facturationCheckbox');
    var facturationFields = document.getElementById('facturationFields');

    // Agregar un listener al cambio del checkbox
    facturationCheckbox.addEventListener('change', function () {
        // Mostrar u ocultar los campos de facturación según la selección del checkbox
        facturationFields.style.display = facturationCheckbox.checked ? 'block' : 'none';
    });
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
