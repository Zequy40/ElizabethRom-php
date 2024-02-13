
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
    <link rel="stylesheet" href="account.css">
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
            <?php include 'cart.php' ?>
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
        </div>
    <div class="whish_container">
    <h2 class="whish_h2">Pedidos</h2>
    <div class="display-tag-wish">
        <?php 
        $fetch_category = $conn -> prepare("SELECT p.*, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus IN (1, 2) AND userId=".$user_id);
        $fetch_category -> execute();
        if ($fetch_category->rowCount() > 0) {
            while($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)){
                $numero = $fetch['product_price'];
                $numero_format = number_format($numero, 2, ',', '.');
                $total = $numero * $fetch['quantity'];
                $totalsum += $total;
                $totalsumFormat = number_format($totalsum, 2, ',','.');
    ?>
    
    <a href="details.php?id=<?= $fetch["productId"]?>"><div class="group">
        <img src="_backAdmin/img/product/<?= $fetch['product_image'] ?>" alt="" style="width: 3.625rem;">
        <div class="description">
            <p class="p_ind"><?= $fetch['product_name'] ?></p>
            <p class="c_ind"><?= $numero_format ?> €</p>
            <p class="c_ind"><?php if($fetch['orderStatus']==1){
                echo'En curso'; }elseif($fetch['orderStatus']==2){
                    echo '<p style="color: orange">Enviado';
            } elseif($fetch['orderStatus']==3){
                echo '<p style="color: green">Entregado';
        } ?> </p>
            
        </div>
    </div></a>
    <?php } 
    }
    else
    {
        echo'<p class="badge-p">"No tienes pedidos realizados actualmente"</p>';
    }?>
    
</div>
<div class="account_form-group">
            <a href="account.php"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg></span>volver</a>
        </div>
</div>
<div class="mobile">
           
            <?php include 'cart.php' ?>
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
