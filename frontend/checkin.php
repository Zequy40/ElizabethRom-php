<?php 
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};


include '_backAdmin/conexion/conexion.php';
if(isset($_POST['confirm'])){
    $pid = $user_id;
    $numeroAleatorio = mt_rand(0, 99999999);

  // Asegurarse de que tenga 8 dígitos
  $numeroAleatorioFormateado = str_pad($numeroAleatorio, 8, '0', STR_PAD_LEFT);

            $update_product = $conn->prepare("UPDATE orders SET orderStatus = ?, invoiced= ? WHERE userId = ? AND orderStatus = 0");
            $update_product->execute([1,$numeroAleatorioFormateado, $pid]);

			header("location:index.php");
			exit;
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
    <link rel="stylesheet" href="check.css">
    <link rel="stylesheet" href="shop.css">
</head>

<body>
    <main>
<div class="user-account-check">

	<section>
		<header class="display-header">
			<h2 class="display-h2">confirmar pedido</h2>
			

		</header>
		<div class="display-orders">
			<?php 
			$totalsum = 0;
			$id = 1;
			$fetch_cart = $conn->prepare("SELECT p.*,  s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus = 0 AND userId =".$id);
			$fetch_cart->execute();
			if ($fetch_cart->rowCount() > 0) {
				while ($fetch = $fetch_cart->fetch(PDO::FETCH_ASSOC)) {
					$numero = $fetch['product_price'];
                    $numero_format = number_format($numero, 2, ',', '.');
					$total = $numero * $fetch['quantity'];
					$totalsum += $total;
					$totalsumFormat = number_format($totalsum, 2, ',','.');
			?>
					<div class="display-tag-check">
						<div class="group">
							<img src="../../backkend/img/product/<?= $fetch['product_image'] ?>" alt="">
							<div class="description">
								<p class="p_ind"><?= $fetch['product_name'] ?></p>
								<p class="c_ind"><?= $numero_format ?> €</p>
								<p>talla: <?= $fetch['weight'] ?></p>
								<p>color: <?= $fetch['colors'] ?></p>
								<div class="blq">
									<label for="qty">Cantidad: </label>
									<input type="number" class="qty" name="qty" min="1" value="<?= $fetch['quantity'] ?>" max="100" disabled>
								</div>
							</div>
						</div>
					</div>
			<?php 
			
			}
			} ?>

		</div>

		<footer class="display-footer-check">
			<div class="display-contain">
				<div class="display-st">
					<p class="display-title">Sub Total</p>
					<p class="display-price"><?php echo (isset($totalsumFormat) && $totalsumFormat != "undefined") ? $totalsumFormat . " €" : "";?></p>
				</div>
				<div class="display-st">
					<p class="display-title">gastos de envío</p>
					<p class="display-price">5,00 €</p>
				</div>
				<div class="display-st">
					<p class="display-title">Total a pagar:</p>
					<?php $totalSent = $totalsum + 5;?>
					<p class="display-price"><?php echo (isset($totalSent) && $totalSent != "undefined") ? number_format($totalSent, 2, ",", ".") . " €" : "";?></p>
		</div>
            <form action="" method="post">
				<input type="hidden" name="pid" value="<?= $id?>">
				
   <h2 class="account_h2" >Rellene la informacion de envio:</h2>
   <div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='Nombre' required>
   <label for='name' class='account_form__label'>Nombre</label>
   
</div>
<div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='Apellidos' required>
   <label for='password' class='account_form__label'>Apellidos</label>
</div>
   <div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='dirección' required>
   <label for='name' class='account_form__label'>Dirección</label>
   
</div>
<div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='Codigo Postal' required>
   <label for='password' class='account_form__label'>Codigo postal</label>
</div>
   <div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='Ciudad' required>
   <label for='name' class='account_form__label'>Ciudad</label>
   
</div>
<div class='account_form__group field'>
   <input type='mail' class='account_form__field' placeholder='email' required>
   <label for='mail' class='account_form__label'>Email</label>
</div>
<div class='account_form__group field'>
   <input type='text' class='account_form__field' placeholder='telefono' required>
   <label for='text' class='account_form__label'>Telefono</label>
</div>
<div class='account_form__group'>
				<button type="submit" class="display-check" name="confirm">pagar </button>
		</div>
			</form>
			</div>
			
		</footer>

	</section>

</div>

</main>
</body>

</html>