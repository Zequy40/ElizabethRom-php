<?php 

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
            <h1>Destacado</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Destacado</li>
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
          <h3 class="card-title">Destacado</h3>

         
        </div>
<div class="card-body p-0">
    
   <?php 


$select_products = $conn->prepare("SELECT * FROM `bestseller`");

$select_products->execute();
?>


          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th >
    Imagen
    
</th>
<th >
    Enlace
    
</th>
<th >
    Imagen2
    
</th>
<th >
    Enlace2
    
</th>
<th >
    Imagen3
    
</th>
<th >
    Enlace3
    
</th>
<th >
    Imagen4
    
</th><th >
    Enlace4
    
</th>
<th></th>
                      
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
                                <img alt="Avatar" class="img-size-50" src="img/product/<?= $fetch_product['img']?>">
                                
                                
                            </li>
                          
                        </ul>
                    </td>
                    <td>
                          <?= $fetch_product['src']; ?>
                      </td>
                      <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="img-size-50" src="img/product/<?= $fetch_product['img2']?>">
                                
                                
                            </li>
                          
                        </ul>
                    </td>
                    <td>
                          <?= $fetch_product['src2']; ?>
                      </td>
                      <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="img-size-50" src="img/product/<?= $fetch_product['img3']?>">
                                
                                
                            </li>
                          
                        </ul>
                    </td>
                    <td>
                          <?= $fetch_product['src3']; ?>
                      </td>
                      <td>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <img alt="Avatar" class="img-size-50" src="img/product/<?= $fetch_product['img4']?>">
                                
                                
                            </li>
                          
                        </ul>
                    </td>
                    <td>
                          <?= $fetch_product['src4']; ?>
                      </td>
                      <td><a class="btn btn-primary btn-sm " href="destacado-edit.php?id=<?= $fetch_product['id']?>" role="button">Editar </a></td>
                     
        <?php
    }
    ?>
</td>
                  </tr>
                  <?php
                  }
                
                  else {
                    ?>
                    <h1-6>Sin imagenes <span class="badge bg-primary">de momento</span></h1-6>
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
        $('.sort-icon').html('');

        // Set the new order
        $(this).addClass(currentOrder);
        $(this).find('.sort-icon').html(currentOrder === 'asc' ? '&#x2191;' : '&#x2193;');

        // Send the sorting parameters to the server
        // You need to modify this part to fit your backend logic
        // For simplicity, I'm just redirecting to the same page with sorting parameters
        window.location.href = 'productAsc.php?sortField=' + field + '&sortOrder=' + currentOrder;
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
