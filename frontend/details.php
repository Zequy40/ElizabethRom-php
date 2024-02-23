<?php include '_backAdmin/conexion/conexion.php';
session_start();
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

// Verificar si el formulario fue enviado
if (isset($_POST['add_product'])) {
  $id_product = $_GET['id'];
  $orderStatus = 0;
  $transaction = 0;

  $weight = filter_var($_POST['weight'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $color = filter_var($_POST['color'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $qty = filter_var($_POST['count'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  // Verificar si ya existe un producto en la orden del usuario
  $select_products = $conn->prepare("SELECT * FROM `orders` WHERE productId = ? AND userId = ? AND orderStatus = 0 AND colors = ? AND weight = ?");
  $select_products->execute([$id_product, $user_id, $color, $weight]);

  $result = $select_products->fetch(PDO::FETCH_ASSOC);
  $qtyPartial = $result ? $result['quantity'] : 0;
  $qtyTotal = $qtyPartial + $qty;

  if ($select_products->rowCount() > 0) {
    // Actualizar la cantidad si el producto ya existe en la orden
    $update_product = $conn->prepare("UPDATE `orders` SET quantity= ? WHERE productId = ? AND userId = ? AND colors = ? AND weight = ?");
    $update_product->execute([$qtyTotal, $id_product, $user_id, $color, $weight]);
  } else {
    // Insertar un nuevo producto en la orden si no existe
    $insert_products = $conn->prepare("INSERT INTO `orders`(userId, productId, quantity, orderStatus, colors, weight) VALUES(?,?,?,?,?,?)");
    $insert_products->execute([$user_id, $id_product, $qty, $orderStatus, $color, $weight]);
  }

  header('Location:shop.php');
  exit();
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EliRom Brand.</title>
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="shop.css">
  <link rel="stylesheet" href="footer.css">
  <script src="https://cdn.tailwindcss.com"></script>


</head>

<body>
<!-- Modal -->
<div class="modal" id="miModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">No estás registrado!</h5>
        
      </div>
      <div class="modal-body">
      Inicia sesión o crea una cuenta para poder comprar pulsando el siguiente enlace: <a href="account.php">Cuenta</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <nav class="shopClothe_contain">
    <div class="shopClothe_title" id="titleHeaderReturn">
      <a class="details_flex-btn" href='shop.php'> <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="shopClothe_svg" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
        </svg>
        <p>MI CESTA</p>
      </a>

    </div>

  </nav>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
         
        </div>
  <form action="" method="post" id="productForm" onsubmit="return validateForm()">
    <?php

    $productId = $_GET["id"];
    $fetch_data = $conn->prepare("
    SELECT p.*, w.status
    FROM products p
    LEFT JOIN wishlist w ON p.id = w.productId AND w.userId = :userId
    WHERE p.id = :productId
");
    $fetch_data->bindParam(':productId', $productId, PDO::PARAM_INT);

    $fetch_data->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);

    // Ejecuta la consulta
    $fetch_data->execute();
    $product = [];
    if ($fetch_data->rowCount() > 0) {
      while ($fetch = $fetch_data->fetch(PDO::FETCH_ASSOC)) {
        // Procesa la información del producto y su estado en la lista de deseos
        $productName = $fetch["productName"];
        $status = $fetch["status"];

    ?>
        <div class="details_container">
          <div class="flex-col">
          <img src="_backAdmin/img/product/<?= $fetch["productImage1"] ?>" alt="" class="details_img">
          <div class='flex max-w-40 px-[10px]'>
            <img src="_backAdmin/img/product/<?= $fetch["productImage2"] ?>" alt="">
            <img src="_backAdmin/img/product/<?= $fetch["productImage3"] ?>" alt="">
          </div>
          </div>
          <div class="details_contain">
            <div class="details_whislist">
              <h2 class="details_h2"><?= $fetch["productName"] ?></h2>
              <?php if (isset($user_id) && !empty($user_id)) { ?>
                <a class="details_span <?php if ($status == 1) {
                                          echo "activado";
                                        } ?>" href="wishlist-add.php?id=<?= $fetch['id'] ?>"><svg class="details_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="m11.442 22.83 0.5576-0.8302 0.5574 0.8303c-0.3372 0.2264-0.7778 0.2263-1.115-1e-4zm-8.4909-18.565c-1.926 1.658-2.3462 4.2841-1.6118 6.7691 1.4723 4.7949 10.66 10.965 10.66 10.965-0.5576 0.8302-0.5576 0.8302-0.5576 0.8302l-0.0085-0.0058-0.0217-0.0146-0.0811-0.0553c-0.0704-0.0483-0.1727-0.1189-0.3027-0.2101-0.2601-0.1822-0.6316-0.4469-1.0813-0.7791-0.89834-0.6638-2.1138-1.601-3.3786-2.693-1.2622-1.0897-2.5896-2.3473-3.7028-3.6526-1.1004-1.2903-2.0542-2.6989-2.4818-4.0916l-0.003098-0.01c-0.81054-2.7426-0.38937-5.8203 1.9139-7.8066 1.7637-1.5518 4.5433-1.9758 6.7159-0.95786 0.37337 0.15877 0.78652 0.42089 1.1605 0.6826 0.3962 0.27718 0.8062 0.5953 1.1719 0.89135 0.2399 0.19413 0.4641 0.38158 0.6572 0.54591 0.1931-0.16413 0.4172-0.35135 0.6568-0.54523 0.3657-0.29582 0.7757-0.61369 1.1718-0.89068 0.3741-0.26155 0.7871-0.52346 1.1603-0.68216 2.1726-1.0179 4.9522-0.59388 6.7159 0.95786 2.3034 1.9863 2.7247 5.064 1.9142 7.8065l-3e-3 0.0101c-0.4275 1.3927-1.3814 2.8013-2.4818 4.0914-1.1133 1.3051-2.4407 2.5625-3.7029 3.652-1.2649 1.0918-2.4804 2.0288-3.3788 2.6923-0.4497 0.3322-0.8212 0.5968-1.0812 0.779-0.1301 0.0911-0.2324 0.1617-0.3028 0.21l-0.0811 0.0553-0.0217 0.0146-0.0059 4e-3 -0.0018 0.0012s-8e-4 6e-4 -0.5582-0.8297c0 0 9.1882-6.1687 10.66-10.964 0.7344-2.485 0.3141-5.1111-1.612-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3966-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    <path d="m2.9516 4.2654c-1.926 1.658-2.3462 4.2841-1.6118 6.7692 1.4723 4.7948 10.66 10.965 10.66 10.965s9.1882-6.1687 10.66-10.964c0.7343-2.4851 0.314-5.1112-1.6121-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3965-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" fill="transparent" class="details_"></path>
                  </svg></a>
              <?php } ?>

            </div>
            <p class="details_price"><?php echo number_format($fetch['productPrice'], 2, ',', ' '); ?> EUR</p>

            <div class="details_label">Colores:<label id="selectedColor" for="color"></label></div>
            <select name="color" id="selectedColorLabel">
              <?php if($fetch["color"]=="" && $fetch["color2"]=="" && $fetch["color3"]=="" && $fetch["color4"]==""){?>
              <option>Color Unico</option>
              <?php } ?>
              <option value="<?= $fetch["color"] ?>"><?= $fetch["color"] ?></option>
              <option value="<?= $fetch["color2"] ?>"><?= $fetch["color2"] ?></option>
              <option value="<?= $fetch["color3"] ?>"><?= $fetch["color3"] ?></option>
              <option value="<?= $fetch["color4"] ?>"><?= $fetch["color4"] ?></option>
            </select>
            <div class="details_containCheck">

              <input type="radio" class="details_check" name="weight" id="size" value=<?= $fetch["weight1"] ?> checked />
              <label class="details_checkLabel" for="size">S
              </label>

              <input type="radio" class="details_check" name="weight" id="size2" value=<?= $fetch["weight2"] ?> />
              <label class="details_checkLabel" for="size2">M
              </label>

              <input type="radio" class="details_check" name="weight" id="size3" value=<?= $fetch["weight3"] ?> />
              <label class="details_checkLabel" for="size3">L
              </label>

              <input type="radio" class="details_check" name="weight" id="size4" value=<?= $fetch["weight4"] ?> />
              <label class="details_checkLabel" for="size4"> XL
              </label>
            </div>

            <div class="details_flex">
              <button class="details_btn" onclick="handleClick('-')">-</button>
              <input type="text" placeholder='' class="details_flex_input" id="count" value="1" name="count" />
              <button class="details_btn" onclick="handleClick('+')">+</button>
            </div>
            <?php if (isset($user_id) && !empty($user_id)) { ?>
            <button id="agregar" name="add_product" type="submit" onclick="return validateForm()"><span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="details_bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg></span>Agregar</button>
              <?php }else{
                ?>
                <button id="show" onclick="mostrarModal()"><span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="details_bi bi-plus" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                </svg></span>Agregar</button><?php  
              } ?>
                  

            <details name="features">
              <summary>Descripción:</summary>
              <p><?= $fetch["productDescription"] ?></p>
            </details>
            <details name="features">
              <summary>Detalles del producto:</summary>
              <p><?= $fetch["decriptionSmall"] ?></p>
            </details>
          </div>
        </div>
    <?php }
    }
    ?>

  </form>
</body>
<div class="desktop">
     
            <?php include 'footer_desktop.php' ?>
         
        </div>       

</html>

<script>
  let count = 1;
  const countInput = document.getElementById('count');
  const show = document.getElementById('show');
  const close = document.querySelector('.btn-secondary');

  show.addEventListener('pointerdown', () => {
    const modal = document.getElementById('miModal');
    modal.style.display = 'block';
  })
  close.addEventListener('pointerdown', () => {
    const modal = document.getElementById('miModal');
    modal.style.display = 'none';
  })
  
  function updateCount() {
    countInput.value = count;
  }

  function handleClick(action) {
    event.preventDefault()
    if (action === '+' && count < 99) {
      count++;
    } else if (action === '-' && count > 1) {
      count--;
    }

    updateCount();
  }

 
</script>