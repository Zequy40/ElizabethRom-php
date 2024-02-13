<?php include '_backAdmin/conexion/conexion.php';
session_start();

$user_id = $_SESSION['user_id'];

if(isset($_POST['edit_account'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastName = $_POST['lastName'];
    $lastName = filter_var($lastName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contactno = $_POST['contactno'];
    $contactno = filter_var($contactno, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $adress = $_POST['adress'];
    $adress = filter_var($adress, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = $_POST['city'];
    $city = filter_var($city, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pincode = $_POST['pincode'];
    $pincode = filter_var($pincode, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
 
    $select_user = $conn->prepare("UPDATE `users` SET name=?, lastName=? , email=?, contactno=?, shippingAddress=?, shippingCity=?, shippingPincode=? WHERE id = ?");
    $select_user->execute([$name,$lastName,$email,$contactno,$adress, $city, $pincode,$user_id]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
    header('location:personalAccount.php');
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
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="footer.css">


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

       
            <div class="account_container">
            <h2 class="account_h2">Editar Datos</h2>
            <form id="login-form" method="post" action="">
           <?php $select_users = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
      $select_users->execute([$user_id]);
      if($select_users->rowCount() > 0){
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){ 
   
?>
<div class="login-form-contain">
            <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Nombre" name="name" value="<?= $fetch_users ["name"]?>" required>
            <label for="name" class="account_form__label">Nombre</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Apellidos" name="lastName" value="<?= $fetch_users ["lastName"]?>" required>
            <label for="lastname" class="account_form__label">Apellidos</label>
            
        </div>

        <div class="account_form__group field">
            <input type="email" class="account_form__field" placeholder="Email" name="email" value="<?= $fetch_users ["email"]?>" required>
            <label for="name" class="account_form__label">Email</label>
            
        </div>

        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Telefono" name="contactno" value="<?= $fetch_users ["contactno"]?>" required>
            <label for="phone" class="account_form__label">Telefono</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Dirección" name="adress" value="<?= $fetch_users ["shippingAddress"]?>" required>
            <label for="adress" class="account_form__label">Dirección</label>
        </div>
        </div>
        <div class="login-form-contain">
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Ciudad" name="city" value="<?= $fetch_users ["shippingCity"]?>" required>
            <label for="city" class="account_form__label">Ciudad</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="CP" name="pincode" value="<?= $fetch_users ["shippingPincode"]?>" required>
            <label for="cp" class="account_form__label">Codigo Postal</label>
            
        </div>
        <?php } }?>
        <div class="account_form-group">
            <button type="submit" name="edit_account" >editar datos</button>
        </div>
        <div class="account_form-group">
            <a href="./account.php"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg></span>volver</a>
        </div>
        </div>
        
</form>
            </div>
        
            <div class="mobile">
            <?php include 'cart.php' ?>
            <?php include 'footer.php' ?>
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

    const cart = document.querySelector('#addToCart')
    const user = document.querySelector('.user-account')
    const close = document.querySelector('#close-account')
    cart.addEventListener('click', () => {
        cart.style.pointerEvents = "none";
        user.classList.add("active")

    })
    close.addEventListener('pointerdown', () => {
        user.classList.remove('active')
        cart.style.pointerEvents = "auto";
    })
    
    
    navTablet.addEventListener('pointerdown', function() {
        menuButton.classList.add('activation');
    })
    closeTablet.addEventListener('pointerdown', () => {
        menuButton.classList.remove('activation');
    })

    const headerNav = document.querySelector('.desktop_contain')
    const headerLi = document.querySelectorAll('.a_a')
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100){
            headerNav.classList.add('scrolled')
            headerLi.forEach(item => {
            item.style.color = "#FFF";
        });
        }
        else{
            headerNav.classList.remove('scrolled')
            headerLi.forEach(item => {
            item.style.color = "#000";
        });
            
        }
    })
</script>
</html>