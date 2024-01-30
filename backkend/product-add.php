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
   $subCategorie = $_POST['exampleSubCategorie'];
   $subCategorie = filter_var($subCategorie, FILTER_SANITIZE_STRING);
   $brand = $_POST['exampleBrand'];
   $brand = filter_var($brand, FILTER_SANITIZE_STRING);
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
   $stock = $_POST['exampleStock'];
   $stock = filter_var($stock, FILTER_SANITIZE_STRING);
   $icon = $_POST['icon'];
   $icon = filter_var($icon, FILTER_SANITIZE_STRING);
   $icon2 = $_POST['icon2'];
   $icon2 = filter_var($icon2, FILTER_SANITIZE_STRING);
   $icon3 = $_POST['icon3'];
   $icon3 = filter_var($icon3, FILTER_SANITIZE_STRING);
   $icon4 = $_POST['icon4'];
   $icon4 = filter_var($icon4, FILTER_SANITIZE_STRING);
   
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'images/'.$image_01;
   
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = 'images/'.$image_02;
   
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = 'images/'.$image_03;
   
    $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = 'images/'.$image_04;
   
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE productName = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'Ce produit existe déja!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `products`(idCategory, idSubCategory, productName , productCompany, productPrice, productPriceDiscount, productDescription, decriptionSmall,title1, title2, weight1, weight2, weight3, productImage1,productImage2,productImage3,imagePromo, icon1, icon2, icon3,icon4,stock) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$categorie, $subCategorie,$name,$brand,$price,$priceDiscount,$description,$descriptionMini,$title,$title2,$weight,$weight2,$weight3,$image_01,$image_02,$image_03,$image_04,$icon,$icon2,$icon3,$icon4,$stock]);
      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000 OR $image_size_04 > 2000000){
            $message[] = 'image trop grande!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            move_uploaded_file($image_tmp_name_04, $image_folder_04);
            $message[] = 'Produit déja creer!';
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
            <h1>Ajouter un produit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Créer Produit</li>
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
                    <label for="exampleBrand">Fournisseurs:</label>
                    <select class="form-control" name="exampleBrand" id="exampleBrand">
                        <?php
     
    $select_cat = $conn->prepare("SELECT * FROM `supplier`"); 
    $select_cat->execute();
    if($select_cat->rowCount() > 0){
     while($fetch_product = $select_cat -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      
                      <option value="<?= $fetch_product['id'];?>"><?= $fetch_product['name'];?></option>
                      <?php }}?>
                      
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleNom">Nom du produit:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nom du produit a ajouter" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleCategorie">Categorie:</label>
                    
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
                    <label for="exampleSubCategorie">SubCategorie:</label>
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
                    <label for="examplePrice">Prix:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePrix" placeholder="Prix" required>
                  </div>
                  <div class="form-group">
                    <label for="examplePriceDiscount">Prix Soldé:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePriceDiscount" placeholder="Prix Soldé">
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Description:</label>
                    <textarea class="form-control" rows="3" placeholder="Description du produit..." name="exampleDescription" id="exampleDescription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleDescriptionMini">Mini Description:</label>
                    <textarea class="form-control" rows="3" placeholder="Bref description du produit..." name="exampleDescriptionMini" id="exampleDescriptionMini"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="titleDecription">Titre Description:</label>
                    <textarea class="form-control" rows="3" placeholder="Titre de la description du produit..." name="titleDecription" id="titleDecription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="title2Decription">Titre 2 Description:</label>
                    <textarea class="form-control" rows="3" placeholder="Titre 2 de la description du produit..." name="title2Decription" id="title2Decription"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleWeight">poid:</label>
                    <input type="number" class="form-control" name="exampleWeight" placeholder="Poids du produit">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight2">poid 2:</label>
                    <input type="number" class="form-control" id="exampleWeight2" name="exampleWeight2" placeholder="Poids 2 du produit ">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight3">poid 3:</label>
                    <input type="number" class="form-control" id="exampleWeight3" name="exampleWeight3" placeholder="Poids 3 du produit ">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile02">Charger 1º image</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                 <div class="form-group">
                            <label for="inputGroupFile03">Charger 2º image</label>
                            <input type="file" class="form-control" id="inputGroupFile03" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile04">Charger 3º image</label>
                            <input type="file" class="form-control" id="inputGroupFile04" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                            <label for="inputGroupFile05">Charger 4º image promotionelle</label>
                            <input type="file" class="form-control" id="inputGroupFile05" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 1:</label>
                    
                    <select class="form-control" name="icon" id="icon">
                        
                      <option value="1" selected>Liquide</option>
                      <option value="2">Sport</option>
                      <option value="3">Aerobique</option>
                      <option value="4">Recup</option>
                      
                    </select>
                  
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 2:</label>
                    
                    <select class="form-control" name="icon2" id="icon2">
                        
                      <option value="1" >Liquide</option>
                      <option value="2"selected>Sport</option>
                      <option value="3">Aerobique</option>
                      <option value="4">Recup</option>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 3:</label>
                    
                    <select class="form-control" name="icon3" id="icon3">
                        
                      <option value="1" >Liquide</option>
                      <option value="2">Sport</option>
                      <option value="3"selected>Aerobique</option>
                      <option value="4">Recup</option>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 4:</label>
                    
                    <select class="form-control" name="icon4" id="icon4">
                        
                      <option value="1" >Liquide</option>
                      <option value="2">Sport</option>
                      <option value="3">Aerobique</option>
                      <option value="4"selected>Recup</option>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleStock">Stock:</label>
                    <input type="number" class="form-control" name="exampleStock" placeholder="Stock">
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_product">Créer</button>
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
