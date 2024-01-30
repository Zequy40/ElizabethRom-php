
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
    <link rel="stylesheet" href="whislist.css">
    <link rel="stylesheet" href="check.css">
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
    
    <div class="whish_container">
    <h2 class="whish_h2">Lista de favoritos</h2>
    <?php if (!isset($user_id) || empty($user_id)) {
    echo '<form id="whish_login-form">
       <p class="whish_p">Para poder ver su lista de favoritos, necesita loguearse o crear una cuenta.</p>
        
           
        <div class="whish_form-group">
            <a class="whish_btn" href="../account/account.php">Loguearse</a>
        </div>
        <div class="whish_form-group">
            <a class="whish_btn1" href="../account/accountCreate.php">Crear cuenta</a>
        </div>
        
    </form>';
    }else{
       ?> <div class="display-tag-wish"><?php
        $fetch_category = $conn -> prepare("SELECT p.*, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM wishlist p INNER JOIN products s ON p.productId = s.id WHERE status = 1 AND userId=".$user_id );
        $fetch_category -> execute();
        if ($fetch_category->rowCount() > 0) {
            while($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)){
                
    ?>
    
    <a href="../shop/details2.php?id=<?= $fetch["productId"]?>"><div class="group">
        <img src="../../../backkend/img/product/<?= $fetch['product_image'] ?>" alt="" style="width: 3.625rem;">
        <div class="description">
            <p class="p_ind"><?= $fetch['product_name'] ?></p>
            <p class="c_ind"><?= number_format($fetch['product_price'], 2, ',', ' ') ?> €</p>
            
        </div>
    </div></a>
    <?php } }}?>
</div>

</div>
<div class="mobile">
            <?php include 'footer.php' ?>
    </div>
    <div class="desktop">
            <?php include 'footer_desktop.php' ?>
         
        </div>
    <?php include 'menu.php' ?>

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
</script>
    </html>
