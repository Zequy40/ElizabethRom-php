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
            <h1>Categoría de produtos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Categoría</li>
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
          <h3 class="card-title">Categoría</h3>

         
        </div>
        <div class="card-body p-0">
            <?php
           
             if (isset($_GET['delete'])) {
                $delete_category = $_GET['delete'];
                $status = $_GET['status'];
                $delete = $conn -> prepare("UPDATE `category` SET status = ? WHERE id = ?");
                $delete -> execute([$status, $delete_category]);
            
            
             }
       

$showOnlyActive = isset($_POST['showOnlyActive']) && $_POST['showOnlyActive'] === 'true';

if ($showOnlyActive) {
    $select_products = $conn->prepare("SELECT * FROM category WHERE status = 1");
} else {
    $select_products = $conn->prepare("SELECT * FROM category");
}

$select_products->execute();
?>

<form method="post" action="">
    <input type="hidden" name="showOnlyActive" value="<?= ($showOnlyActive ? 'false' : 'true'); ?>">
    <button type="submit"class="btn btn-primary btn-sm"><?= ($showOnlyActive ? 'Mostrar Todo' : 'Solo activos'); ?></button>
</form>


<table class="table table-striped projects">
    <thead>
        <tr>
            <th style="width: 1%">#</th>
            <th>Nombre de la Categoría</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($select_products->rowCount() > 0) {
            while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?= $fetch_product['id']; ?></td>
                    <td>
                        <a>
                            <?= $fetch_product['categoryName']; ?>
                        </a>
                        <br>
                        <small>
                            Created <?= $fetch_product['creationDate']; ?>
                        </small>
                    </td>
                    <td><?= $fetch_product['categoryDescription']; ?></td>
                    <td>
                        <?php
                        if ($fetch_product['status'] == 1) {
                            echo '<div class="text-success">Activo</div>';
                        } else {
                            echo '<div class="text-danger">Inactivo</div>';
                        }
                        ?>
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="category-edit.php?id=<?= $fetch_product['id']; ?>">
                            <i class="fas fa-pencil-alt"></i>
                            Editar
                        </a>
                        <?php
                        if ($fetch_product['status'] == 1) {
                            echo '<a class="btn btn-danger btn-sm" href="category.php?delete=' . $fetch_product['id'] . '&status=0"> <i class="fas fa-trash"></i> Borrar</a>';
                        } else {
                            echo '<a class="btn btn-success btn-sm" href="category.php?delete=' . $fetch_product['id'] . '&status=1"><i class="fas fa-trash"></i> Restaurar</a>';
                        }
                        ?>
                    </td>
                </tr>
        <?php
            }
        } else {
            ?>
            <h1-6>Sin Categoría <span class="badge bg-primary">Actualmente</span></h1-6>
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
