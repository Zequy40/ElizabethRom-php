
<?php include '_backAdmin/conexion/conexion.php';
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

header('location:index.php');
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
       <p class="whish_p">Para poder ver su lista de favoritos, necesita iniciar sesión o crear una cuenta.</p>
        
           
        <div class="whish_form-group">
            <a class="whish_btn" href="account.php">Loguearse</a>
        </div>
        <div class="whish_form-group">
            <a class="whish_btn1" href="accountCreate.php">Crear cuenta</a>
        </div>
        
    </form>';
    }else{
       ?> <div class="display-tag-wish"><?php
        $fetch_category = $conn -> prepare("SELECT p.*, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM wishlist p INNER JOIN products s ON p.productId = s.id WHERE status = 1 AND userId=".$user_id );
        $fetch_category -> execute();
        if ($fetch_category->rowCount() > 0) {
            while($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)){
                
    ?>
    
    <a href="details2.php?id=<?= $fetch["productId"]?>"><div class="group">
        <img src="_backAdmin/img/product/<?= $fetch['product_image'] ?>" alt="" style="width: 3.625rem;">
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
    

    const icons = document.querySelectorAll(".footer_icon");
    const active = document.querySelector(".footer_iconMenu")

    // Agrega un evento de clic al botón del menú
    nav.addEventListener('pointerdown', function() {
        nav.classList.add('actived')
        menuButton.classList.toggle('activation');


        icons.forEach(icon => {
            if (icon.classList.contains('linked')) {
                const correspondingDiv = icon.parentElement;
                if (nav.classList.contains('actived')) {
                    if (correspondingDiv.classList.contains('actived')) {
                        correspondingDiv.classList.remove('actived');
                        nav.classList.add('actived')
                        active.classList.add('initial')
                    } else {
                        correspondingDiv.classList.add('actived')
                        nav.classList.remove('actived')
                        active.classList.remove('initial')
                    }
                }
            };
        })


    })


</script>
    </html>
