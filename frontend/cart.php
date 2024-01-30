<?php 

if(isset($_POST['confirm'])){
    $pid = $_POST['pid'];
     // Actualiza el estado del pedido
            $update_product = $conn->prepare("UPDATE orders SET orderStatus = ? WHERE userId = ? AND orderStatus = 0");
            $update_product->execute([1, $pid]);
			
}

if(isset($_POST['delete'])){
    $productId = $_POST['productId'];
     // Actualiza el estado del pedido
	 $delete = $conn -> prepare("DELETE FROM `orders` WHERE id = ?");
	 $delete -> execute([$productId]);
}
            
?>
<div class="user-account">

	<section>
		<header class="display-header">
			<h2 class="display-h2">cesta <?= $user_id?></h2>
			<div id="close-account"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none" />
						<path d="M18 6l-12 12" />
						<path d="M6 6l12 12" />
					</svg></span></div>

		</header>
		<div class="display-orders">
			<?php 
			$totalsum = 0;
		 
			$fetch_cart = $conn->prepare("SELECT p.*,  s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus = 0 AND userId = ?");
			$fetch_cart->execute([$user_id]);
			if ($fetch_cart->rowCount() > 0) {
				while ($fetch = $fetch_cart->fetch(PDO::FETCH_ASSOC)) {
					$numero = $fetch['product_price'];
                    $numero_format = number_format($numero, 2, ',', '.');
					$total = $numero * $fetch['quantity'];
					$totalsum += $total;
					$totalsumFormat = number_format($totalsum, 2, ',','.');
					
			?>
					<div class="display-tag">
						<div class="group">
							<img src="../backkend/img/product/<?= $fetch['product_image'] ?>" alt="">
							<div class="description">
								<p class="p_ind"><?= $fetch['product_name'] ?></p>
								<p class="c_ind"><?= $numero_format ?> €</p>
								<p>talla: <?= $fetch['weight'] ?></p>
								<p>color: <?= $fetch['colors'] ?></p>
								<div class="blq">
									<label for="qty">Cantidad: </label>
									<input type="number" class="qty" name="qty" min="1" value="<?= $fetch['quantity'] ?>" max="100" disabled>
								</div>


								<form action="" method="post">
									<input type="hidden" name="productId" value="<?= $fetch['id'] ?>">
									<div class="blq">
										<div class="blq"><a href="../shop/edit.php?id=<?= $fetch['id'] ?>"><span><svg xmlns="http://www.w3.org/2000/svg" class="blq_svg" fill="currentColor"  viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></span>editar</a>
										</div>
										<div class="blq">
											<button type="submit" name="delete"><span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
														<path stroke="none" d="M0 0h24v24H0z" fill="none" />
														<path d="M18 6l-12 12" />
														<path d="M6 6l12 12" />
													</svg></span>suprimir</button>
										</div>
									</div>
								</form>


							</div>
						</div>
					</div>
					

			<?php 
			
			}
			} ?>

		</div>

		<footer class="display-footer">
			<div class="display-contain">
				<div class="display-st">
					<div class="display-title">Sub Total</div>
					<div class="display-price"><?php echo (isset($totalsumFormat) && $totalsumFormat != "undefined") ? $totalsumFormat . " €" : "";?></div>
				</div>
            <form action="" method="post">
				<input type="hidden" name="pid" value="<?= $user_id?>">
				
				<button type="submit" class="display-check" name="confirm">confirmar pedido </button>
			</form>
			</div>
			<a href="shop/shop.php" class="display_a">Seguir comprando →</a>
		</footer>

	</section>

</div>