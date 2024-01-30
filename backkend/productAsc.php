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
              <li class="breadcrumb-item active">produits</li>
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
    
   <?php 
   
   
   if (isset($_GET['delete'])) {
                $delete_category = $_GET['delete'];
                $status = $_GET['status'];
                $delete = $conn -> prepare("UPDATE `products` SET productStatus = ? WHERE id = ?");
                $delete -> execute([$status, $delete_category]);
            
            
             }
$showOnlyActive = isset($_POST['showOnlyActive']) && $_POST['showOnlyActive'] === 'true';
$searchTerm = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = isset($_POST["search"]) ? $_POST["search"] : '';
    
}
$sortField = isset($_GET['sortField']) ? $_GET['sortField'] : 'id';
$sortOrder = isset($_GET['sortOrder']) && ($_GET['sortOrder'] === 'asc' || $_GET['sortOrder'] === 'desc') ? $_GET['sortOrder'] : 'asc';

$query = "SELECT p.*, c.categoryName AS productCategory, s.subcategoryName AS productSubCategory, f.name AS supplierProduct FROM products p INNER JOIN category c ON p.idCategory = c.id INNER JOIN subcategory s ON p.idSubCategory = s.id INNER JOIN supplier f ON p.productCompany = f.id";

if (!empty($searchTerm)) {
    $query .= " WHERE productName LIKE :searchTerm";
}

if ($showOnlyActive) {
    $query .= " AND p.productStatus != 3";
}

$query .= " ORDER BY $sortField $sortOrder";
$select_products = $conn->prepare($query);

if (!empty($searchTerm)) {
    $select_products->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
}

$select_products->execute();
?>

<form method="post" action="">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Rechercher un produit" name="search">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

<form method="post" action="">
    <input type="hidden" name="showOnlyActive" value="<?= ($showOnlyActive ? 'false' : 'true'); ?>">
    <button type="submit"class="btn btn-primary btn-sm"><?= ($showOnlyActive ? 'Tout montrer' : 'Seulement les actifs'); ?></button>
</form>
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th></th>
                      <th >
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
                      <th class="sortable" data-field="stock">Stock <i class="fas fa-solid fa-caret-down"></th>
                      <th>Fournisseurs</th>
                      <th class="text-center">
                          État
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
                          <?= $fetch_product['id']; ?>
                      </td>
                      <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <?php if($fetch_product["productImage1"] == ""){
                              echo '<img src="dist/img/default-150x150.png" width="40" alt="User Image">';
                          }else{
                              echo '<img alt="Avatar" class="table-avatar" src="images/'.$fetch_product['productImage1'].'">';
                          }?>
                                
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
                    <td><?= $fetch_product['stock']; ?></td>
                    
                    <td><?= $fetch_product['supplierProduct']; ?></td>
                    
                      <td class="project-state">
    <?php if ($fetch_product['productStatus'] == 1) { ?>
        <span class="badge badge-success">
            Actif
        </span>
    <?php 
        
    }else if ($fetch_product['productStatus'] == 2 && $fetch_product['stock'] == 0){
        ?>
        <span class="badge badge-warning">
            Sans Stock
        </span>
        <span class="badge badge-success">
            Actif
        </span>
    <?php
    }else if ($fetch_product['productStatus'] == 2 ){
        ?>
        <span class="badge badge-success">
            Actif
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
                              Voir Produit
                          </a>
                          
                          <?php
                        if ($fetch_product['productStatus'] != 3) {
                            echo '<a class="btn btn-danger btn-sm" href="product.php?delete=' . $fetch_product['id'] . '&status=3"> <i class="fas fa-trash"></i> Efacer</a>';
                        } else {
                            echo '<a class="btn btn-success btn-sm" href="product.php?delete=' . $fetch_product['id'] . '&status=1"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="#fff"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3C140.6 6.8 151.7 0 163.8 0zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm192 64c-6.4 0-12.5 2.5-17 7l-80 80c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39V408c0 13.3 10.7 24 24 24s24-10.7 24-24V273.9l39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-4.5-4.5-10.6-7-17-7z"/></svg></i> Restaurer</a>';
                        }
                        ?>
                         
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
<script>
function function confirmarEliminacion() {
    return confirm("Vous vous vraiment effacer cette commande?");
}
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('.sortable').on('click', function() {
        var field = $(this).data('field');
        var currentOrder = $(this).hasClass('asc') ? 'desc' : 'asc';

        // Reset all other sort icons
        $('.sortable').removeClass('asc desc');
    

        // Set the new order
        $(this).addClass(currentOrder);
        

        // Send the sorting parameters to the server
        // You need to modify this part to fit your backend logic
        // For simplicity, I'm just redirecting to the same page with sorting parameters
        window.location.href = 'product.php';
    });
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
