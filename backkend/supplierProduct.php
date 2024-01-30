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
              <li class="breadcrumb-item active">Fournisseurs</li>
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
          <h3 class="card-title">Fournisseurs</h3>

         
        </div>
<div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                     
                      
                      <th>
                          Produit 
                      </th>
                      <th>
                          Prix Unitaire
                      </th>
                      <th>
                          Stock
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
             <?php
// ... Tu código existente ...

// Verifica si se ha enviado el formulario con el proveedor seleccionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_supplier'])) {
    $selected_supplier = $_POST['selected_supplier'];

    // Consulta para obtener los productos del proveedor seleccionado
    $select_products = $conn->prepare("SELECT * FROM products WHERE productCompany = :supplier_id");
    $select_products->bindParam(':supplier_id', $selected_supplier, PDO::PARAM_INT);
    $select_products->execute();

    // Muestra la tabla de productos del proveedor seleccionado
    if ($select_products->rowCount() > 0) {
        while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            // ... Código para mostrar la información del producto ...
            ?>
                  <tr>

                      <td><a href="product-edit.php?id=<?= $fetch_product['id'];?>"><?= $fetch_product['productName']; ?></a>
                          
                      </td>
                      
                      <td>
                          
                              <?= $fetch_product['productPrice']; ?> €
                              
                              
                          
                      </td> 
                      <td>
                          
                              <?= $fetch_product['stock']; ?>
                              
                              
                          
                      </td> 
                      </tr>
    <?php
        }
    } else {
         ?>
                    <h1-6>Pas produit de ce fournisseur <span class="badge bg-primary">Actuellement</span></h1-6>
    <?php
    }
} else {
    // Muestra el formulario para seleccionar el proveedor
    ?>
    <form method="post" action="" class="row g-3">
        <div class="col-2">
            <div class="form-group">
        <label for="validationDefault04">Choississez le fournisseur</label>
        <select name="selected_supplier" id="validationDefault04" class="form-control">
            <?php
            $select_suppliers = $conn->prepare("SELECT id, name FROM supplier");
            $select_suppliers->execute();

            if ($select_suppliers->rowCount() > 0) {
                while ($fetch_supplier = $select_suppliers->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $fetch_supplier['id'] . "'>" . $fetch_supplier['name'] . "</option>";
                }
            }
            ?>
        </select>
        </div>
    <button class="btn btn-primary" type="submit">Montrer produits</button>
  </div>
    </form>
    
                      
                  
                    <?php 
                    }
                     ?>
                 <td colspan="9"><a class="btn btn-success btn-sm" href="supplierProduct.php">Reinitialiser</a></td>
                
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
