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
  <title>AdminLTE 3 | E-commerce</title>

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
            <h1>Produit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">E-commerce</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
          <?php 
          $id = $_GET['id'];
          $select_products = $conn->prepare("SELECT p.*, i1.icon AS icon_svg1, i2.icon AS icon_svg2, i3.icon AS icon_svg3, i4.icon AS icon_svg4 FROM products p LEFT JOIN icons i1 ON p.icon1 = i1.id LEFT JOIN icons i2 ON p.icon2 = i2.id LEFT JOIN icons i3 ON p.icon3 = i3.id LEFT JOIN icons i4 ON p.icon4 = i4.id WHERE p.id=?"); 
$select_products->execute([$id]); 
     $select_products->execute([$id]);
     if($select_products->rowCount() > 0){
                while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
 
   ?>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?=$fetch_product['productName'];?></h3>
              <div class="col-12">
                <img src="images/<?=$fetch_product['productImage1'];?>" width="350" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="images/<?=$fetch_product['productImage1'];?>" alt="Product Image"></div>
                
                <div class="product-image-thumb" >
                <img src="images/<?php if ($fetch_product['productImage2']== null){
                echo "nodisponible.jpg"; 
                    
                }else{
                echo $fetch_product['productImage2'];
                }?>" alt="Product Image"></div>
                
                <div class="product-image-thumb" >
                <img src="images/<?php if ($fetch_product['productImage3']== null){
                echo "nodisponible.jpg"; 
                    
                }else{
                echo $fetch_product['productImage3'];
                }?>" alt="Product Image"></div>
                
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?=$fetch_product['productName'];?></h3>
              <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>

              <hr>
              <h4><?=$fetch_product['category'];?></h4>
              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['weight1'];?>
                  <br>
                  
                </label>
                 <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['weight2'];?>
                  <br>
                  
                </label>
                 <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['weight3'];?>
                  <br>
                  
                </label>
                 
              
              </div>
                    <hr>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  
                <label class="btn btn-default text-center active">
                 <?=$fetch_product['icon_svg1'];?>
                  
                  <br>
                  </div>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['icon_svg2'];?>
                  <br>
                  </div>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['icon_svg3'];?>
                  <br>
                  </div>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                  
                <label class="btn btn-default text-center active">
                  <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                  <?=$fetch_product['icon_svg4'];?>
                  <br>
                    
                    </div>

              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  <?=$fetch_product['productPrice'];?> €
                </h2>
                <h4 class="mt-0">
                  <small>Prix soldé: <?=$fetch_product['productPriceDiscount'];?> €</small>
                </h4>
              </div>
              <br>
              <?php }
                 }?> 
              <a class="btn btn-info btn-sm" href="product.php">
                              <i class="fas fa-arrow">
                              </i>
                              Retour
                          </a>
                          <a class="btn btn-warning btn-sm" href="product-edit.php?id=<?=$id ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Editer
                          </a>
            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?=$fetch_product['productDescription'];?> </div>
             
            </div>
          </div>
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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
</body>
</html>
