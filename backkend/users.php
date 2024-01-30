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
              <li class="breadcrumb-item active">Clientes</li>
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

         
        <div class="card-body p-0">
             <?php
            if (isset($_GET['delete'])) {
            $delete_category = $_GET['delete'];
            $delete = $conn -> prepare("DELETE FROM `users` WHERE id = ?");
            $delete -> execute([$delete_category]);
            }
            
$showOnlyActive = isset($_POST['showOnlyActive']) && $_POST['showOnlyActive'] === 'true';
$searchTerm = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = isset($_POST["search"]) ? $_POST["search"] : '';
    
}


$query = "SELECT * FROM `users`";


if (!empty($searchTerm)) {
    $query .= " WHERE userName LIKE :searchTerm";
}



$select_products = $conn->prepare($query);

if (!empty($searchTerm)) {
    $select_products->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
}
$select_products->execute();
?>


<form method="post" action="">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Rechercher un client" name="search">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

<form method="post" action="">
    
   
    <a href="usersActive.php" class="btn btn-primary btn-sm">Solo activos</a>
</form>
          <table class="table table-striped projects">
              
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      
                      <th>
                          Nombre Cliente
                      </th>
                      <th>
                          Email
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
                          <a class="btn btn-primary btn-sm" href="users-only.php?id=<?=$fetch_product['id'] ;?>">
                              <i class="fas fa-folder">
                              </i>
                              Ver
                          </a>
                          <a class="btn btn-info btn-sm" href="users-edit.php?user=<?=$fetch_product['id'] ;?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editar
                          </a>
                          <a class="btn btn-danger btn-sm" href="users.php?delete=<?=$fetch_product['id'] ;?>" onclick="return confirm('Vous allez effacer ce client, êtes-vous sûre?');">
                              <i class="fas fa-trash">
                              </i>
                              Borrar
                          </a>
                      </td>
                  </tr>
                  <?php
                  }
                }
                  else {
                    ?>
                    <h1-6>No hay Clientes <span class="badge bg-primary">en estos momentos</span></h1-6>
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
