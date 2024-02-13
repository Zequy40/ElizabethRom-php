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
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
  $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
  $image_size_01 = $_FILES['image_01']['size'];
  $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
  $image_folder_01 = '../src/assets/'.$image_01;
   

   $update_product = $conn->prepare("UPDATE `category` SET categoryName = ?, categoryDescription = ?,imgBack = ?, updationDate = NOW() WHERE id = ?");
   $update_product->execute([$name, $details,$image_01, $pid]);

   $message[] = 'Categoría modificada!';

   $message[] = 'Imagen actualizar!';
  
   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../src/assets/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'imagen demasiada grande!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `category` SET imgBack = ? WHERE id = ?");
         $update_image_01->execute([$image_01,1]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../src/assets/'.$old_image_01);
         $message[] = 'imagen actualizada!';
      }
   }
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
            <h1>Editar Categoría</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Editar Categoría</li>
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
         <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Bravo</strong><br> '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }
   
      $update_id = $_GET['id'];
      $select_category = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
      $select_category->execute([$update_id]);
      if($select_category->rowCount() > 0){
         while($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)){ 
   
?>
                  
                  <div class="form-group">
                      <input type="hidden" name="pid" value="<?= $fetch_category['id']; ?>">
                    <label for="exampleCat">Categoría:</label>
                    <input type="text" class="form-control" id="examplePrix" placeholder="Nom de la categorie" required maxlength="100" name="name" value="<?= $fetch_category['categoryName']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Descripción:</label>
                    <textarea name="details" id="exampleDescription" placeholder="Description de la categorie" class="form-control" required maxlength="500" cols="30" rows="10"><?= $fetch_category['categoryDescription']; ?></textarea>
                  </div>

                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="../src/assets/<?= $fetch_category['imgBack']; ?>">
                            <label for="inputGroupFile02">Imagen de fondo</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" name="update" class="btn btn-primary" value="Modifier">
                   <a href="category.php" class="btn btn-success">Volver</a>
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
