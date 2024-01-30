
<?php include '../backkend/conexion/conexion.php';
session_start();

session_start();


if(isset($_POST['create_account'])){

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
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $user = "cliente";
   $status = 1;

   $select_products = $conn->prepare("SELECT * FROM `users` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'Este Usuario ya existe!';
   }else{
   $select_user = $conn->prepare("INSERT INTO `users` ( userName,name, lastName , email, contactno, password, shippingAddress, shippingCity, shippingPincode, status, user) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
   $select_user->execute([$username, $name,$lastName,$email,$contactno,$pass,$adress, $city, $pincode,$status,$user]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   }
header("location:account.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliRom Brand.</title>
    <link rel="stylesheet" href="src/components/header/header.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="account.css">
    <link rel="stylesheet" href="src/components/footer/footer.css">
    <script defer src="slider.js"></script>
    
    
</head>
<body>
    <main>
    <?php include 'src/components/header/headerAccount.php' ?>
    <?php include 'cart2.php' ?> 
    <div class="account_container-create">
    <h2 class="account_h2">Crear cuenta</h2>
    <form id="login-form" method="post" action="">
        <p class="p">Inserte los datos para poder crear la cuenta.</p>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Nombre" name="name" required>
            <label for="name" class="account_form__label">Nombre</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Apellidos" name="lastName" required>
            <label for="lastname" class="account_form__label">Apellidos</label>
            
        </div>

        <div class="account_form__group field">
            <input type="email" class="account_form__field" placeholder="Email" name="email" required>
            <label for="name" class="account_form__label">Email</label>
            
        </div>

        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Telefono" name="contactno" required>
            <label for="phone" class="account_form__label">Telefono</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Dirección" name="adress" required>
            <label for="adress" class="account_form__label">Dirección</label>
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Ciudad" name="city" required>
            <label for="city" class="account_form__label">Ciudad</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="CP" name="pincode" required>
            <label for="cp" class="account_form__label">Codigo Postal</label>
            
        </div>
        <div class="account_form__group field">
            <input type="text" class="account_form__field" placeholder="Usuario" name="username" required>
            <label for="name" class="account_form__label">Usuario</label>
            
        </div>
        <div class="account_form__group field">
            <input type="password" class="account_form__field" placeholder="Contraseña" name="pass" required>
            <label for="password" class="account_form__label">Contraseña</label>
        </div>
        <div class="account_form-group">
            <button type="submit" name="create_account" >crear cuenta</button>
        </div>
        
    </form>
</div>
<?php include 'src/components/footer/footerAccount.php' ?>
<?php include 'menu.php' ?>

    </main>
</body>
    </html>
