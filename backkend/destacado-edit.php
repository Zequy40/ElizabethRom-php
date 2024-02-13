<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['add_product'])){
  $pid = $_POST['pid'];
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);

  $name2 = $_POST['name2'];
  $name2 = filter_var($name2, FILTER_SANITIZE_STRING);

  $name3 = $_POST['name3'];
  $name3 = filter_var($name3, FILTER_SANITIZE_STRING);

  $name4 = $_POST['name4'];
  $name4 = filter_var($name4, FILTER_SANITIZE_STRING);
   
  $image_01 = $_FILES['image_01']['name'];
  $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
  $image_size_01 = $_FILES['image_01']['size'];
  $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
  $image_folder_01 = 'img/product/'.$image_01;
  
  $image_02 = $_FILES['image_02']['name'];
  $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
  $image_size_02 = $_FILES['image_02']['size'];
  $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
  $image_folder_02 = 'img/product/'.$image_02;
  
  $image_03 = $_FILES['image_03']['name'];
  $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
  $image_size_03 = $_FILES['image_03']['size'];
  $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
  $image_folder_03 = 'img/product/'.$image_03;
  
  $image_04 = $_FILES['image_04']['name'];
  $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
  $image_size_04 = $_FILES['image_04']['size'];
  $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
  $image_folder_04 = 'img/product/'.$image_04;
   
$update_product = $conn->prepare("UPDATE `bestseller` SET img= ?, img2= ?, img3= ? , img4= ?, src= ?, src2= ?, src3= ?, src4= ? WHERE id = ?");
   $update_product->execute([$image_01,$image_02,$image_03,$image_04,$image_05,$image_06,1]);

   $message[] = 'Imagen actualizar!';
  
   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'img/product/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'imagen demasiada grande!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `bestseller` SET img = ? WHERE id = ?");
         $update_image_01->execute([$image_01,1]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('img/product/'.$old_image_01);
         $message[] = 'image mis a jour!';
      }
   }
   
   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = 'img/product/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `bestseller` SET img2 = ? WHERE id = ?");
         $update_image_02->execute([$image_02,1]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('img/product/'.$old_image_02);
         $message[] = 'image 02 mis a jour!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = 'img/product/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `bestseller` SET img3 = ? WHERE id = ?");
         $update_image_03->execute([$image_03,1]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('img/product/'.$old_image_03);
         $message[] = 'image 03 mis a jour!';
      }
   }
   
   $old_image_04 = $_POST['old_image_04'];
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = 'img/product/'.$image_04;

   if(!empty($image_04)){
      if($image_size_04 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_04 = $conn->prepare("UPDATE `bestseller` SET img4 = ? WHERE id = ?");
         $update_image_04->execute([$image_04,1]);
         move_uploaded_file($image_tmp_name_04, $image_folder_04);
         unlink('img/product/'.$old_image_04);
         $message[] = 'image 04 mis a jour!';
      }

    }
      header('Location: product.php');

   

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
            <h1>Actualizar Destacado</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Actualizar Destacado</li>
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
              <form action="" method="post" enctype="multipart/form-data">
             <?php 
             
             if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-success alert-dismissible fade show" role="alert">
   '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }
                $select_prod = $conn->prepare("SELECT * FROM bestseller WHERE id = 1"); 
                $select_prod->execute();
                if($select_prod->rowCount() > 0){
                    $fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC);
                
  ?>  
                    <input type="hidden" name="pid" value="1">
                    <input type="hidden" name="old_image_01" value="<?= $fetch_prod['image_01']; ?>">
                    <input type="hidden" name="old_image_02" value="<?= $fetch_prod['image_02']; ?>">
                    <input type="hidden" name="old_image_03" value="<?= $fetch_prod['image_03']; ?>">
                    <input type="hidden" name="old_image_04" value="<?= $fetch_prod['image_04']; ?>">
                    
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleNom">Enlace</label>
                    <input type="text" class="form-control" name="name" value="<?= $fetch_prod['src'];?>">
                  </div>
                 
                  
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="img/product/<?= $fetch_prod['img']; ?>">
                            <label for="inputGroupFile02">Cargar imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>

                  <div class="form-group">
                    <label for="exampleNom">Enlace 2</label>
                    <input type="text" class="form-control" name="name2" value="<?= $fetch_prod['src2'];?>">
                  </div>
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="img/product/<?= $fetch_prod['img2']; ?>">
                            <label for="inputGroupFile03">Cargar 2 imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile03" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleNom">Enlace 3</label>
                    <input type="text" class="form-control" name="name3" value="<?= $fetch_prod['src3'];?>">
                  </div>
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="img/product/<?= $fetch_prod['img3']; ?>">
                            <label for="inputGroupFile04">Cargar 3 imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile04" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>

                  <div class="form-group">
                    <label for="exampleNom">Enlace 4</label>
                    <input type="text" class="form-control" name="name4" value="<?= $fetch_prod['src4'];?>">
                  </div>
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="img/product/<?= $fetch_prod['img4']; ?>">
                            <label for="inputGroupFile05">Cargar 4 imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile05" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                 <?php 
                 }?> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_product">Modificar</button>
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