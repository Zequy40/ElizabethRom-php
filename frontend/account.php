<?php include '_backAdmin/conexion/conexion.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};


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

        header('location:account.php');
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
    <script defer src="slider.js"></script>


</head>

<body>
    <main>
    <div class="mobile">
            <?php include 'header.php' ?>
             <?php include 'footer.php' ?>
        </div>
        <div class="tablet">
           
            <?php include 'header_tablet.php' ?>
            
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
         
        </div>
        <?php

        if (!isset($user_id) || empty($user_id)) {
            echo '<div class="account_container">';
            echo '<h2 class="account_h2">Acceda a su cuenta</h2>';
            echo '<form id="login-form-sample" method="post" action="">';
            echo '<p class="p">Para poder acceder a su cuenta y poder gestionar sus pedidos, lista de deseos y otros, tiene que iniciar sessión o crear una cuenta.</p>';

            echo '<div class="account_form__group field">';
            echo '<input type="text" class="account_form__field" placeholder="Usuario" name="username" required>';
            echo '<label for="name" class="account_form__label">Usuario</label>';
            echo '</div>';

            echo '<div class="account_form__group field">';
            echo '<input type="password" class="account_form__field" placeholder="Contraseña" name="pass" required>';
            echo '<label for="password" class="account_form__label">Contraseña</label> ';
            echo '</div>';

            echo '<div class="account_form-group">';
            echo '<button type="submit" name="submit">Login</button>';
            echo '</div>';

            echo '<p class="account_p2">O</p>';
            echo '<a href="./accountCreate.php" class="account_a">crear cuenta</a>';
            echo '</form>';
            echo '</div>';
        } else {
        ?>
            <div class="account_container">
                <div class="contain_grid">
                    <a href="personalAccount.php">
                        <div class="account_grid-group">Mi Cuenta</div>
                    </a>
                    <a href="shop-list.php">
                        <div class="account_grid-group">Mis Pedidos</div>
                    </a>
                    <form id="login-form" method="post" action="">
                       <button class="account_grid-group" type="submit" name="exit">Cerrar sesión</button>
                    </form>
                       
                    

                </div>
            <?php
        }
            ?>
 <div class="mobile">
            <?php include 'src/components/footer/footerAccount.php' ?>
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