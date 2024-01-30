<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $pid=$_POST['pid'];
    $stock=$_POST['stock'];
    $update = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
    $update->execute([$stock,$pid ]);
    $message[] = 'Stock mis à jour avec succès!';
    header("location:stock.php");
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
            <h1>Stock</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">stock</li>
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
          <h3 class="card-title">Stock de Produits</h3>

         
        </div>
<div class="card-body p-0">
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
   }?>
   <form method="post" action="">
       <div class="col-2">
           <div class="form-group">
    <label for="selected_supplier">Choisi un fournisseur:</label>
    <select name="selected_supplier" id="selected_supplier" class="form-control">
        <option value="all">Tout les fournisseurs</option>
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
    
    <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      <th >
                          #
                      </th>
                      
                      <th>
                          Nom Produit
                      </th>
                     <th>
                          Fournisseur
                      </th>
                      <th>Stock</th>
                      
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $selected_supplier_id = isset($_POST['selected_supplier']) && $_POST['selected_supplier'] !== 'all' ? $_POST['selected_supplier'] : null;

$select_products = $conn->prepare("SELECT products.*, supplier.name as supplier_name FROM products LEFT JOIN supplier ON products.productCompany = supplier.id" . ($selected_supplier_id ? " WHERE products.productCompany = :supplier_id" : ""));
if ($selected_supplier_id) {
    $select_products->bindParam(':supplier_id', $selected_supplier_id, PDO::PARAM_INT);
}
$select_products->execute();
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
  ?>
                  <tr>

                      <td>
                          <?= $fetch_product['id']; ?>
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
                          <?= $fetch_product['supplier_name']; ?>
                      </td>
                     
                      <td>
                     <form action="" method="POST">
                         <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="#20c997"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M248 0H208c-26.5 0-48 21.5-48 48V160c0 35.3 28.7 64 64 64H352c35.3 0 64-28.7 64-64V48c0-26.5-21.5-48-48-48H328V80c0 8.8-7.2 16-16 16H264c-8.8 0-16-7.2-16-16V0zM64 256c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H224c35.3 0 64-28.7 64-64V320c0-35.3-28.7-64-64-64H184v80c0 8.8-7.2 16-16 16H120c-8.8 0-16-7.2-16-16V256H64zM352 512H512c35.3 0 64-28.7 64-64V320c0-35.3-28.7-64-64-64H472v80c0 8.8-7.2 16-16 16H408c-8.8 0-16-7.2-16-16V256H352c-15 0-28.8 5.1-39.7 13.8c4.9 10.4 7.7 22 7.7 34.2V464c0 12.2-2.8 23.8-7.7 34.2C323.2 506.9 337 512 352 512z"/></svg></span>
    <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
    <input type="number" class="form-control" name="stock" value="<?= $fetch_product['stock']; ?>">
    <button type="submit" class="btn btn-warning" name="update_status">Mettre à jour</button>
    </div>
   </form></td>
                      
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
