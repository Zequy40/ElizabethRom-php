<?php

include 'conexion/conexion.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $level = $_POST['level'];

  $select_user = $conn->prepare("SELECT * FROM `admin` WHERE username = ?");
  $select_user->execute([$username,]);
  $row = $select_user->fetch(PDO::FETCH_ASSOC);

  if($select_user->rowCount() > 0){
      $message[] = 'Cet username existe déja!';
  }else{
      if($pass != $cpass){
         $message[] = 'Le password doit être identique';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `admin`(name, username, password, level, status) VALUES(?,?,?,?,?)");
         $insert_user->execute([$name, $username, $cpass, $level , $status]);
         $message[] = 'Enregistrer vous pouvez faire login!';
      }
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Admin</b>LTE</a>
    </div>
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
?>
    <div class="card-body">
      <p class="login-box-msg">Enregistrer un nouveau admin</p>
      

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" required placeholder="entrez votre nom" maxlength="20">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" required placeholder="entrez votre username" maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
                    <label for="exampleCategorie">Niveau:</label>
                    
                    <select class="form-control" name="level">
                      <option value="2">Admin</option>
                      <option value="3">Vendeur</option>
                      <option value="4">Service Client</option>
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleStatus">État:</label>
                    
                    <select class="form-control" name="status">
                      <option value="1">Actif</option>
                      <option value="2">Inactif</option>
                      
                    </select>
                  </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass" required placeholder="entrez votre password" maxlength="20" oninput="this.value = this.value.replace(/\s/g, '')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="cpass" required placeholder="confirmer votre password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-8">
            <input type="submit" class="btn btn-primary btn-block" value="enregistrer" name="submit">
          </div>
          <div class="col-4">
          <a href="index.php" class="btn btn-success btn-block text-center">Login</a>
           </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
