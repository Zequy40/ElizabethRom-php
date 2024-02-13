<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $categorie = $_POST['exampleCategorie'];
   $categorie = filter_var($categorie, FILTER_SANITIZE_STRING);
   $categorie2 = $_POST['exampleCategorie2'];
   $categorie2 = filter_var($categorie2, FILTER_SANITIZE_STRING);
   $categorie3 = $_POST['exampleCategorie3'];
   $categorie3 = filter_var($categorie3, FILTER_SANITIZE_STRING);
   $categorie4 = $_POST['exampleCategorie4'];
   $categorie4 = filter_var($categorie4, FILTER_SANITIZE_STRING);
   $subCategorie = $_POST['exampleSubCategorie'];
   $subCategorie = filter_var($subCategorie, FILTER_SANITIZE_STRING);
   $price = $_POST['examplePrix'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $priceDiscount = $_POST['examplePriceDiscount'];
   $priceDiscount = filter_var($priceDiscount, FILTER_SANITIZE_STRING);
   $description = $_POST['exampleDescription'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $descriptionMini = $_POST['exampleDescriptionMini'];
   $descriptionMini = filter_var($descriptionMini, FILTER_SANITIZE_STRING);
   $title = $_POST['titleDecription'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $title2 = $_POST['title2Decription'];
   $title2 = filter_var($title2, FILTER_SANITIZE_STRING);
   $weight = $_POST['exampleWeight'];
   $weight = filter_var($weight, FILTER_SANITIZE_STRING);
   $weight2 = $_POST['exampleWeight2'];
   $weight2 = filter_var($weight2, FILTER_SANITIZE_STRING);
   $weight3 = $_POST['exampleWeight3'];
   $weight3 = filter_var($weight3, FILTER_SANITIZE_STRING);
   $weight4 = $_POST['exampleWeight4'];
   $weight4 = filter_var($weight4, FILTER_SANITIZE_STRING);
   $color = $_POST['exampleColor'];
   $color = filter_var($color, FILTER_SANITIZE_STRING);
   $color2 = $_POST['exampleColor2'];
   $color2 = filter_var($color2, FILTER_SANITIZE_STRING);
   $color3 = $_POST['exampleColor3'];
   $color3 = filter_var($color3, FILTER_SANITIZE_STRING);
   $color4 = $_POST['exampleColor4'];
   $color4 = filter_var($color4, FILTER_SANITIZE_STRING);
   
   
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'img/product'.$image_01;
   
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = 'img/product'.$image_02;
   
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = 'img/product'.$image_03;
   
    $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = 'img/product/'.$image_04;
   
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE productName = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'Este producto ya existe!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(idCategory,idCategory2,idCategory3,idCategory4, idSubCategory, productName , productPrice, productPriceDiscount, productDescription, decriptionSmall,title1, title2, weight1, weight2, weight3, weight4, color, color2,color3,color4, productImage1,productImage2,productImage3,imagePromo) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$categorie,$categorie2,$categorie3,$categorie4, $subCategorie,$name,$price,$priceDiscount,$description,$descriptionMini,$title,$title2,$weight,$weight2,$weight3,$weight4,$color,$color2,$color3,$color4,$image_01,$image_02,$image_03,$image_04]);
      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000 OR $image_size_04 > 2000000){
            $message[] = 'imagen deamasiada grande!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_04, $image_folder_04);
            $message[] = 'Product ya fue creado!';
         }

      }
      header('Location: product.php');

   }  

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
            <h1>Anadir un produto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Anadir Producto</li>
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
                  
                <div class="card-body">
                    
                  <div class="form-group">
                    <label for="exampleNom">Nombre del producto:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre del producto a crear" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleCategorie">Categoria:</label>
                    
                    <select class="form-control" name="exampleCategorie" id="exampleCategorie">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `category`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['categoryName'];?></option>
                      <?php }}?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleCategorie">Categoria:</label>
                    
                    <select class="form-control" name="exampleCategorie2" id="exampleCategorie2">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `category`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['categoryName'];?></option>
                      <?php }}?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleCategorie">Categoria:</label>
                    
                    <select class="form-control" name="exampleCategorie3" id="exampleCategorie3">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `category`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['categoryName'];?></option>
                      <?php }}?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleCategorie">Categoria:</label>
                    
                    <select class="form-control" name="exampleCategorie4" id="exampleCategorie4">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `category`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['categoryName'];?></option>
                      <?php }}?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSubCategorie">SubCategoria:</label>
                    <select class="form-control" name="exampleSubCategorie" id="exampleSubCategorie">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `subcategory`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['subcategoryName'];?></option>
                      <?php }}?>
                      
                      
                    </select>
                  </div>

                  
                  
                  <div class="form-group">
                    <label for="examplePrice">Precio:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePrix" placeholder="Precio" required>
                  </div>
                  <div class="form-group">
                    <label for="examplePriceDiscount">Precio rebajado:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePriceDiscount" placeholder="Rebaja">
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Descripcion:</label>
                    <textarea class="form-control" rows="3" placeholder="Descripcion del producto..." name="exampleDescription" id="exampleDescription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleDescriptionMini">Mini Descripcion:</label>
                    <textarea class="form-control" rows="3" placeholder="Breve Descripcion del producto..." name="exampleDescriptionMini" id="exampleDescriptionMini"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="titleDecription">Titulo Descripcion:</label>
                    <textarea class="form-control" rows="3" placeholder="Titulo de la Descripcion del producto..." name="titleDecription" id="titleDecription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="title2Decription">Titulo 2 Descripcion:</label>
                    <textarea class="form-control" rows="3" placeholder="Titulo 2 de la Descripcion del producto..." name="title2Decription" id="title2Decription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleWeight">talla:</label>
                    <input type="text" class="form-control" name="exampleWeight" placeholder="Talla del producto">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight2">talla 2:</label>
                    <input type="text" class="form-control" id="exampleWeight2" name="exampleWeight2" placeholder="talla 2 del producto ">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight3">talla 3:</label>
                    <input type="text" class="form-control" id="exampleWeight3" name="exampleWeight3" placeholder="talla 3 del producto ">
                  </div>

                  <div class="form-group">
                    <label for="exampleWeight4">talla 4:</label>
                    <input type="text" class="form-control" id="exampleWeight4" name="exampleWeight4" placeholder="talla 4 del producto ">
                  </div>
                  <div class="form-group">
                    <label for="exampleColor">color:</label>
                    <input type="text" class="form-control" name="exampleColor" placeholder="Color del producto">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleColor2">color 2:</label>
                    <input type="text" class="form-control" id="exampleColor2" name="exampleColor2" placeholder="color 2 del producto ">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleColor3">color 3:</label>
                    <input type="text" class="form-control" id="exampleColor3" name="exampleColor3" placeholder="color 3 del producto ">
                  </div>

                  <div class="form-group">
                    <label for="exampleColor4">color 4:</label>
                    <input type="text" class="form-control" id="exampleColor4" name="exampleColor4" placeholder="color 4 del producto ">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile02">Cargar 1º imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                 <div class="form-group">
                            <label for="inputGroupFile03">cargar 2º imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile03" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile04">cargar 3º imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile04" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile05">cargar 4º imagen</label>
                            <input type="file" class="form-control" id="inputGroupFile05" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_product">Créar</button>
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
