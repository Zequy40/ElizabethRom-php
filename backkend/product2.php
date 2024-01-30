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
            <h1>Produits</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produits</li>
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
          <h3 class="card-title">Produits</h3>

         
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th></th>
                      <th>
                          Nom Produit
                      </th>
                      <th>
                          Categorie
                      </th>
                      <th>
                        SubCategorie
                      </th>
                      <th class="text-center">
                        Prix
                      </th>
                      <th class="text-center">
                          État
                      </th>
                      <th>
                      </th>
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $select_products = $conn->prepare("SELECT p.*, c.categoryName AS productCategory, s.subcategoryName AS productSubCategory FROM products p INNER JOIN category c ON p.idCategory = c.id INNER JOIN subcategory s ON p.idSubCategory = s.id "); 
    $select_products->execute();
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
  ?>
                  <tr>

                      <td>
                          <?= $fetch_product['id']; ?>
                      </td>
                      <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="table-avatar" src="<?= $fetch_product['productImage1']; ?>">
                            </li>
                          
                        </ul>
                    </td>
                      <td>
                          <a>
                              <?= $fetch_product['productName']; ?>
                              </a>
                              <br>
                              <small>
                              Created <?= $fetch_product['postingDate']; ?>
                          </small>
                          
                      </td>
                      <td>
                          <?= $fetch_product['productCategory']; ?>
                      </td>
                      <td class="project_progress">
                          
                          <?= $fetch_product['productSubCategory']; ?>
                          
                      </td>
                      <td>
                      <?= $fetch_product['productPrice']; ?> €
                    </td>
                      <td class="project-state">
    <?php if ($fetch_product['productStatus'] == 1) { ?>
        <span class="badge badge-success">
            Actif
        </span>
    <?php 
        
    }else if ($fetch_product['productStatus'] == 2){
        ?>
        <span class="badge badge-warning">
            Sans Sctock
        </span>
    <?php
    } else if ($fetch_product['productStatus'] == 3){
        ?><span class="badge badge-danger">
            Inactif
        </span>
        <?php
    }
    ?>
</td>
                      <td class="project-actions text-right">
                          <a class="btn btn-primary btn-sm" href="productId.php?id=<?=$fetch_product['id']; ?>">
                              <i class="fas fa-folder">
                              </i>
                              Voir
                          </a>
                          <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editer
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Efacer
                          </a>
                      </td>
                  </tr>
                  <?php
                  }
                }
                  else {
                    ?>
                    <h1-6>Pas de produit <span class="badge bg-primary">Actuellement</span></h1-6>
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
