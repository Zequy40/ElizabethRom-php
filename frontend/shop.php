
<?php include '../backkend/conexion/conexion.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
  } else {
    $user_id = '';
  };


if (isset($_POST['exit'])) {
    session_start();
    session_unset();
    session_destroy();

header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliRom Brand.</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="footer.css">
    <script defer src="slider.js"></script>
    
    
</head>
<body>
    <main>
    <div class="mobile">
            <?php include 'header.php' ?>
        </div>
        <div class="tablet">
           
            <?php include 'header_tablet.php' ?>
            
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
         
        </div>
    <?php include 'cart.php' ?>
        <section class="shop_section">
    <div class="shop_containPricipal">
    <?php 
        $fetch_category = $conn -> prepare("SELECT categoryName, src, imgBack,id FROM `category` WHERE menu=1 AND status=1");
        $fetch_category -> execute();
        if ($fetch_category->rowCount() > 0) {
            while($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)){
        ?>
    <a href="./shopClothe.php?id=<?= $fetch['id']?>&cat=cat" class="shop_a">
        <div class="shop_layoutContain">
        <div class="shop_backgroundContain"></div>
        <img src="src/assets/<?php echo $fetch['imgBack']?>" alt="" class="shop_imgContain">
        <h2 class="shop_h2Contain"><?php echo $fetch['categoryName']?></h2>
    </div></a>
    <?php   }}
    
        $fetch_subcategory = $conn -> prepare("SELECT subcategoryName, src, id, tag FROM `subcategory` WHERE status=1");
        $fetch_subcategory -> execute();
        if ($fetch_subcategory->rowCount() > 0) {
            while($fetch = $fetch_subcategory->fetch(PDO::FETCH_ASSOC)){
        ?>
    <a href="./shopClothe.php?id=<?= $fetch['id']?>&cat=subcat" class="shop_a">
        <div class="shop_layoutContain">
        <div class="shop_backgroundContain"></div>
        <img src="src/assets/<?php echo $fetch['src']?>" alt="" class="shop_imgContain">
        <h2 class="shop_h2Contain"><?php echo $fetch['subcategoryName']?><?php if($fetch['tag'] == 1){
            ?><span class="shop_span">limited edition</span><?php
        }?></h2>
    </div></a>
    <?php   }}
    ?>
</div>

	</section>
    <div class="mobile">
            <?php include 'footerAccount.php' ?>
            
    </div>
 <?php include 'menu.php' ?>
 <div class="desktop">
            <?php include 'footer_desktop.php' ?>
         
        </div>

    </main>
</body>
<script>
    const navTablet = document.querySelector('.menuTablet');
    const menuButton = document.querySelector('#menuNav');
    const closeTablet = document.querySelector('#close');
    const nav = document.querySelector('#menu');

    navTablet.addEventListener('pointerdown', function() {
        menuButton.classList.add('activation');
    })
    closeTablet.addEventListener('pointerdown', () => {
        menuButton.classList.remove('activation');
    })

  
    
    navTablet.addEventListener('pointerdown', function() {
        menuButton.classList.add('activation');
    })
    closeTablet.addEventListener('pointerdown', () => {
        menuButton.classList.remove('activation');
    })

</script>

    </html>
