<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['add_product'])){
   $pid = $_POST['pid'];
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
   $exampleStatus = $_POST['exampleStatus'];
   $exampleStatus = filter_var($exampleStatus, FILTER_SANITIZE_STRING);
   
   
   
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
   
$update_product = $conn->prepare("UPDATE `products` SET idCategory= ?, idSubCategory= ?, productName= ? , productCompany= ?, productPrice= ?, productPriceDiscount= ?, productDescription= ?, decriptionSmall= ?,title1= ?,title2= ?, weight1= ?, weight2= ?, weight3= ?, productImage1= ?,productImage2= ?,productImage3= ?,imagePromo= ?, icon1= ?, icon2= ?, icon3= ?,icon4= ?,productStatus= ?, stock= ?, updationDate= NOW() WHERE id = ?");
   $update_product->execute([$categorie, $subCategorie,$name,$brand,$price,$priceDiscount,$description,$descriptionMini,$title,$title2,$weight,$weight2,$weight3,$image_01,$image_02,$image_03,$image_04,$icon,$icon2,$icon3,$icon4,$exampleStatus,$stock,$pid]);

   $message[] = 'Client modifier avec succes!';
  
    $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'images/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET productImage1 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('images/'.$old_image_01);
         $message[] = 'image mis a jour!';
      }
   }
   
   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = 'images/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `products` SET productImage2 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('images/'.$old_image_02);
         $message[] = 'image 02 mis a jour!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = 'images/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `products` SET productImage3 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('images/'.$old_image_03);
         $message[] = 'image 03 mis a jour!';
      }
   }
   
   $old_image_04 = $_POST['old_image_04'];
   $image_04 = $_FILES['image_04']['name'];
   $image_04 = filter_var($image_04, FILTER_SANITIZE_STRING);
   $image_size_04 = $_FILES['image_04']['size'];
   $image_tmp_name_04 = $_FILES['image_04']['tmp_name'];
   $image_folder_04 = 'images/'.$image_04;

   if(!empty($image_04)){
      if($image_size_04 > 2000000){
         $message[] = 'image trop grande!';
      }else{
         $update_image_04 = $conn->prepare("UPDATE `products` SET imagePromo = ? WHERE id = ?");
         $update_image_04->execute([$image_04, $pid]);
         move_uploaded_file($image_tmp_name_04, $image_folder_04);
         unlink('images/'.$old_image_04);
         $message[] = 'image 04 mis a jour!';
      }
   }
      
      header('Location: product.php');

   

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
            <h1>Éditer un produit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Éditer Produit</li>
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
             <?php 
             
             if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-success alert-dismissible fade show" role="alert">
   '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }
   $categories = $conn->query("SELECT id, categoryName FROM category")->fetchAll(PDO::FETCH_ASSOC);

// Obtener subcategorías
$subcategories = $conn->query("SELECT id, subcategoryName FROM subcategory")->fetchAll(PDO::FETCH_ASSOC);
             
                $cat = $_GET["id"];  
                $select_prod = $conn->prepare("SELECT p.*, c.id AS category_id, c.categoryName AS user_name, s.id AS subcategory_id, s.subcategoryName AS cat_name FROM products p INNER JOIN category c ON p.idCategory = c.id INNER JOIN subcategory s ON p.idSubCategory = s.id WHERE p.id=?"); 
                $select_prod->execute([$cat]);
                if($select_prod->rowCount() > 0){
                    $fetch_prod = $select_prod->fetch(PDO::FETCH_ASSOC);
                
  ?>  
                    <input type="hidden" name="pid" value="<?= $fetch_prod['id']; ?>">
                    <input type="hidden" name="old_image_01" value="<?= $fetch_prod['image_01']; ?>">
                    <input type="hidden" name="old_image_02" value="<?= $fetch_prod['image_02']; ?>">
                    <input type="hidden" name="old_image_03" value="<?= $fetch_prod['image_03']; ?>">
                    <input type="hidden" name="old_image_04" value="<?= $fetch_prod['image_04']; ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleNom">Nom du produit:</label>
                    <input type="text" class="form-control" name="name" value="<?= $fetch_prod['productName'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleCategorie">Categorie:</label>
                    
                    <select class="form-control" name="exampleCategorie" id="exampleCategorie">
                 
                      <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id']; ?>" <?= ($fetch_prod['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                    <?= $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
                   
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSubCategorie">SubCategorie:</label>
                    <select class="form-control" name="exampleSubCategorie" id="exampleSubCategorie"> 
                      <?php foreach ($subcategories as $subcategory): ?>
                <option value="<?= $subcategory['id']; ?>" <?= ($fetch_prod['subcategory_id'] == $subcategory['id']) ? 'selected' : ''; ?>>
                    <?= $subcategory['subcategoryName']; ?>
                </option>
            <?php endforeach; ?>
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="exampleBrand">Marque:</label>
                    <input type="text" class="form-control" name="exampleBrand" value="<?= $fetch_prod['productCompany'];?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="examplePrice">Prix:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePrix" value="<?= $fetch_prod['productPrice'];?>" required>
                  </div>
                  <div class="form-group">
                    <label for="examplePriceDiscount">Prix Soldé:</label>
                    <input type="number" step="0.01" class="form-control" name="examplePriceDiscount" value="<?= $fetch_prod['productPriceDiscount'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Description:</label>
                    <textarea class="form-control" rows="3" value="<?= $fetch_prod['productDescription'];?>" name="exampleDescription" id="exampleDescription"><?= $fetch_prod['productDescription'];?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleDescriptionMini">Mini Description:</label>
                    <textarea class="form-control" rows="3" value="<?= $fetch_prod['decriptionSmall'];?>" name="exampleDescriptionMini" id="exampleDescriptionMini"><?= $fetch_prod['decriptionSmall'];?></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="titleDecription">Titre Description:</label>
                    <textarea class="form-control" rows="3" value="<?= $fetch_prod['title1'];?>" name="titleDecription" id="titleDecription"><?= $fetch_prod['title1'];?></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="title2Decription">Titre 2 Description:</label>
                    <textarea class="form-control" rows="3" value="<?= $fetch_prod['title2'];?>" name="title2Decription" id="title2Decription"><?= $fetch_prod['title2'];?></textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight">poid:</label>
                    <input type="number" class="form-control" name="exampleWeight" value="<?= $fetch_prod['weight1'];?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight2">poid 2:</label>
                    <input type="number" class="form-control" id="exampleWeight2" name="exampleWeight2" value="<?= $fetch_prod['weight2'];?>">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleWeight3">poid 3:</label>
                    <input type="number" class="form-control" id="exampleWeight3" name="exampleWeight3" value="<?= $fetch_prod['weight3'];?>">
                  </div>
                  
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="images/<?= $fetch_prod['productImage1']; ?>">
                            <label for="inputGroupFile02">Charger 1º image</label>
                            <input type="file" class="form-control" id="inputGroupFile02" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                 <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="images/<?= $fetch_prod['productImage2']; ?>">
                            <label for="inputGroupFile03">Charger 2º image</label>
                            <input type="file" class="form-control" id="inputGroupFile03" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="images/<?= $fetch_prod['productImage3']; ?>">
                            <label for="inputGroupFile04">Charger 3º image</label>
                            <input type="file" class="form-control" id="inputGroupFile04" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  <div class="form-group">
                            <img alt="Avatar" class="table-avatar" width="80" src="images/<?= $fetch_prod['imagePromo']; ?>">
                            <label for="inputGroupFile05">Charger 4º image promotionelle</label>
                            <input type="file" class="form-control" id="inputGroupFile05" name="image_04" accept="image/jpg, image/jpeg, image/png, image/webp">
                  </div>
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 1:</label>
                    
                    <select class="form-control" name="icon" id="icon">
                       
                      <?php
        $icons = array(
            array('id' => 1, 'name' => 'Cardio'),
            array('id' => 2, 'name' => 'Strong'),
            array('id' => 3, 'name' => 'Buvable'),
            array('id' => 4, 'name' => 'Recuperation')
        );

        foreach ($icons as $icon) {
            $selected = ($fetch_prod['icon1'] == $icon['id']) ? 'selected' : '';
            echo '<option value="' . $icon['id'] . '" ' . $selected . '>' . $icon['name'] . '</option>';
        }
        ?>
                      
                    </select>
                  
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 2:</label>
                    
                    <select class="form-control" name="icon2" id="icon2">
                      
                      <?php
        $icons = array(
            array('id' => 1, 'name' => 'Cardio'),
            array('id' => 2, 'name' => 'Strong'),
            array('id' => 3, 'name' => 'Buvable'),
            array('id' => 4, 'name' => 'Recuperation')
        );

        foreach ($icons as $icon) {
            $selected = ($fetch_prod['icon2'] == $icon['id']) ? 'selected' : '';
            echo '<option value="' . $icon['id'] . '" ' . $selected . '>' . $icon['name'] . '</option>';
        }
        ?>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 3:</label>
                    
                    <select class="form-control" name="icon3" id="icon3">
                        
                     <?php
        $icons = array(
            array('id' => 1, 'name' => 'Cardio'),
            array('id' => 2, 'name' => 'Strong'),
            array('id' => 3, 'name' => 'Buvable'),
            array('id' => 4, 'name' => 'Recuperation')
        );

        foreach ($icons as $icon) {
            $selected = ($fetch_prod['icon3'] == $icon['id']) ? 'selected' : '';
            echo '<option value="' . $icon['id'] . '" ' . $selected . '>' . $icon['name'] . '</option>';
        }
        ?>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleCategorie">Icon 4:</label>
                    
                    <select class="form-control" name="icon4" id="icon4">
                      
                      <?php
        $icons = array(
            array('id' => 1, 'name' => 'Cardio'),
            array('id' => 2, 'name' => 'Strong'),
            array('id' => 3, 'name' => 'Buvable'),
            array('id' => 4, 'name' => 'Recuperation')
        );

        foreach ($icons as $icon) {
            $selected = ($fetch_prod['icon4'] == $icon['id']) ? 'selected' : '';
            echo '<option value="' . $icon['id'] . '" ' . $selected . '>' . $icon['name'] . '</option>';
        }
        ?>
                      
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleStatus">État:</label>
                    <input type="number" class="form-control" name="exampleStatus" value="<?= $fetch_prod['productStatus'];?>">
                  </div>
                  
                  
                  <div class="form-group">
                    <label for="exampleStock">Stock:</label>
                    <input type="number" class="form-control" name="exampleStock" value="<?= $fetch_prod['stock'];?>">
                  </div>
                  
                 <?php 
                 }?> 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="add_product">Modifier</button>
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