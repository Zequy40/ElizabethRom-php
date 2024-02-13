<?php include '_backAdmin/conexion/conexion.php';
session_start();

session_start();


if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE userName = ? AND password = ?");
    $select_user->execute([$username, $pass]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_level'] = $row['level'];
        $_SESSION['user_name'] = $row['name'];

        header('location:/index.php');
    } else {
        $message[] = 'Username ou Password incorrect!';
    }
}
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
            
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
        </div>
            <div class="account_container">
                <div class="contain_grid">
                    <div class="account_grid-group"><a href="mailto:admin@elizabethrom.es"> Contactar con nosotros</a></div>
                    <a href="accountEdit.php"><div class="account_grid-group">Modificar datos</div></a>
                    <a href="account.php"><div class="account_grid-group">Menu Principal Cuenta</div></a>

                </div>
                </div>
       

                <div class="mobile">
            <?php include 'cart.php' ?>
            <?php include 'footer.php' ?>
        </div>
        
    <?php include 'menu.php' ?>
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