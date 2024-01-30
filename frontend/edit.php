<?php 
include '../backkend/conexion/conexion.php';
if(isset($_POST['add_product'])){
  $id_product=$_GET['id'];
  $orderStatus = 0;
  $weight = $_POST['weight'];
  
  $color = $_POST['color'];
  
  $qty = $_POST['count'];
  
  
  
    $update_product = $conn->prepare("UPDATE `orders` SET quantity= ?, colors=?, weight=? WHERE id = ?");
    $update_product->execute([$qty,$color,$weight,$id_product]);
   
     
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
    
</head>
<body>
<nav class="shopClothe_contain">
                <div class="shopClothe_title" id="titleHeaderReturn">
                   <button class="details_flex-btn" onclick="goBack()"> <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="shopClothe_svg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                    <p>MI CESTA</p></button>

                </div>
               
            </nav>
            <form action="" method="post" id="productForm" onsubmit="return validateForm()">
<?php 
        $fetch_category = $conn -> prepare("SELECT orders.*, products.productName AS product_name, products.productPrice AS product_price, products.productImage1 AS product_image, products.weight1 AS weight1, products.weight2 AS weight2, products.weight3 AS weight3, products.weight4 AS weight4, products.color AS color1, products.color2 AS color2, products.color3 AS color3 FROM orders INNER JOIN products ON orders.productId = products.id WHERE orders.id =".$_GET["id"]);
        $fetch_category -> execute();
        $product = [];
        if ($fetch_category->rowCount() > 0) {
            while($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)){
              
              
        ?>
<div class="details_container">
  
  <img src="../../../backkend/img/product/<?= $fetch["product_image"]?>" alt="" class="details_img">
  <div class="details_contain">
    <div class="details_whislist">
  <h2 class="details_h2"><?= $fetch["product_name"]?></h2>
  <button class="details_span"><svg class="details_svg" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" ><path d="m11.442 22.83 0.5576-0.8302 0.5574 0.8303c-0.3372 0.2264-0.7778 0.2263-1.115-1e-4zm-8.4909-18.565c-1.926 1.658-2.3462 4.2841-1.6118 6.7691 1.4723 4.7949 10.66 10.965 10.66 10.965-0.5576 0.8302-0.5576 0.8302-0.5576 0.8302l-0.0085-0.0058-0.0217-0.0146-0.0811-0.0553c-0.0704-0.0483-0.1727-0.1189-0.3027-0.2101-0.2601-0.1822-0.6316-0.4469-1.0813-0.7791-0.89834-0.6638-2.1138-1.601-3.3786-2.693-1.2622-1.0897-2.5896-2.3473-3.7028-3.6526-1.1004-1.2903-2.0542-2.6989-2.4818-4.0916l-0.003098-0.01c-0.81054-2.7426-0.38937-5.8203 1.9139-7.8066 1.7637-1.5518 4.5433-1.9758 6.7159-0.95786 0.37337 0.15877 0.78652 0.42089 1.1605 0.6826 0.3962 0.27718 0.8062 0.5953 1.1719 0.89135 0.2399 0.19413 0.4641 0.38158 0.6572 0.54591 0.1931-0.16413 0.4172-0.35135 0.6568-0.54523 0.3657-0.29582 0.7757-0.61369 1.1718-0.89068 0.3741-0.26155 0.7871-0.52346 1.1603-0.68216 2.1726-1.0179 4.9522-0.59388 6.7159 0.95786 2.3034 1.9863 2.7247 5.064 1.9142 7.8065l-3e-3 0.0101c-0.4275 1.3927-1.3814 2.8013-2.4818 4.0914-1.1133 1.3051-2.4407 2.5625-3.7029 3.652-1.2649 1.0918-2.4804 2.0288-3.3788 2.6923-0.4497 0.3322-0.8212 0.5968-1.0812 0.779-0.1301 0.0911-0.2324 0.1617-0.3028 0.21l-0.0811 0.0553-0.0217 0.0146-0.0059 4e-3 -0.0018 0.0012s-8e-4 6e-4 -0.5582-0.8297c0 0 9.1882-6.1687 10.66-10.964 0.7344-2.485 0.3141-5.1111-1.612-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3966-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" clip-rule="evenodd" fill-rule="evenodd"></path><path d="m2.9516 4.2654c-1.926 1.658-2.3462 4.2841-1.6118 6.7692 1.4723 4.7948 10.66 10.965 10.66 10.965s9.1882-6.1687 10.66-10.964c0.7343-2.4851 0.314-5.1112-1.6121-6.7691-1.473-1.2988-3.84-1.6565-5.6519-0.7983-1.0991 0.4565-3.3963 2.531-3.3963 2.531s-2.2974-2.0763-3.3965-2.5328c-1.812-0.85819-4.1789-0.50055-5.6519 0.79828z" fill="transparent" class="details_"></path></svg></button>
</div>
  <p class="details_price"><?php echo number_format($fetch['product_price'], 2, ',', ' ');?> EUR</p>
  
  <div class="details_label">Colores:<label id="selectedColorLabel"></label></div>
  <div class="details_input">
    
  <input type="radio" name="color" id="negro" class="details_negro" value="<?= $fetch["color1"]?>" <?= ($fetch['colors'] === "Negro") ? "checked" : "" ?> />
  <label for="negro"></label>

  <input type="radio" name="color" id="rojo" class="details_rojo" value="<?= $fetch["color2"]?>"  <?= ($fetch['colors'] === "Rojo") ? "checked" : "" ?> />
  <label for="rojo"></label>

  <input type="radio" name="color" id="purpura"  class="details_purpura" value="<?= $fetch["color3"]?>"  <?= ($fetch['colors'] === "purpura") ? "checked" : "" ?> />
  <label for="purpura" class="Purpura"></label>
  

</div>
<div class="details_containCheck">

  <input type="radio" class="details_check" name="weight" id="size" value=<?= $fetch["weight1"]?> <?= ($fetch['weight'] === "S") ? "checked" : "" ?>/>
  <label class="details_checkLabel" for="size">S 
  </label>

  <input type="radio" class="details_check" name="weight" id="size2" value=<?= $fetch["weight2"]?> <?= ($fetch['weight'] === "M") ? "checked" : "" ?>/>
  <label class="details_checkLabel" for="size2">M
  </label>

  <input type="radio" class="details_check" name="weight" id="size3" value=<?= $fetch["weight3"]?> <?= ($fetch['weight'] === "L") ? "checked" : "" ?>/>
  <label class="details_checkLabel" for="size3">L
  </label>

  <input type="radio" class="details_check" name="weight" id="size4" value=<?= $fetch["weight4"]?> <?= ($fetch['weight'] === "XL") ? "checked" : "" ?>/>
 <label class="details_checkLabel" for="size4"> XL
  </label>
</div>

<div class="details_flex">
                  <button class="details_btn" onclick="handleClick('-')">-</button>
                  <input type="text" placeholder='' class="details_flex_input" id="count" value="<?= $fetch['quantity']?>" name="count"/>
                  <button class="details_btn" onclick="handleClick('+')">+</button>
                </div>
                
  <button id="agregar" name="add_product" type="submit" onclick="return validateForm()"><span><svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="currentColor"  viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
</svg></span>editar</button>

  
  </div>
  </div>
  <?php }
        }
        ?>

 
</body>
</html>

<script>
  
  // Obtener el elemento input al cargar la página
  let countInput = document.getElementById('count');
  let count = countInput.value || 1;

  function updateCount() {
    countInput.value = count;
  }

  function handleClick(action) {
    event.preventDefault();

    let currentCount = count;

    if (action === '+' && currentCount < 99) {
      currentCount++;
    } else if (action === '-' && currentCount > 1) {
      currentCount--;
    }

    count = currentCount;

    // Actualizar el valor del input
    updateCount();
  }

  // Llamar a updateCount para establecer el valor inicial al cargar la página
  updateCount();



  function validateForm() {
    // Puedes agregar validaciones adicionales aquí antes de enviar el formulario
    return true;  // Devuelve true para permitir que el formulario se envíe
  }
  
  function goBack() {
  window.history.back();
}
</script>