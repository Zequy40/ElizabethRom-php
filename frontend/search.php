<?php

include '_backAdmin/conexion/conexion.php';
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
        <?php include 'header.php'; ?>

        <div class="whish_container">
            <h2 class="whish_h2">Pedidos</h2>
            <form action="" method="POST">
                <label for="buscar">Buscar:</label>
                <input type="number" name="buscar" id="buscar" placeholder="Número de pedido">
                <div class="account_form-group">
                    <button type="submit">Buscar</button>
                </div>
            </form>


            <div class="display-tag-wish">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Obtener el término de búsqueda desde el formulario
                    $terminoBusqueda = isset($_POST['buscar']) ? $_POST['buscar'] : '';

                    // Tu consulta SQL con la condición de búsqueda
                    $fetch_category = $conn->prepare("SELECT p.*, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus=1 AND invoiced = :terminoBusqueda");

                    $fetch_category->bindParam(':terminoBusqueda', $terminoBusqueda, PDO::PARAM_STR);
                    $fetch_category->execute();
                    $rowCount = $fetch_category->rowCount();

if ($rowCount > 0) {
                    while ($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)) {
                        $numero_format = number_format($fetch['product_price'], 2, ",", '.');
                        echo '<a href="shop/details.php?id=' . $fetch["productId"] . '">
                <div class="group">
                    <img src="_backAdmin/img/product/' . $fetch['product_image'] . '" alt="" style="width: 3.625rem;">
                    <div class="description">
                        <p class="p_ind">' . $fetch['product_name'] . '</p>
                        <p class="c_ind">' . $numero_format . ' €</p>
                        <p class="c_ind">';
                        if ($fetch['orderStatus'] == 1) {
                            echo 'En curso';
                        } elseif ($fetch['orderStatus'] == 2) {
                            echo 'Entregado';
                        }
                        echo '</p>
                    </div>
                </div>
            </a>';
                    }
                } else {
                    echo '<br>';
                    echo '<p class="badge-p">No hay pedidos con ese número de pedido.</p>';
                } }?>
                <div class="account_form-group">
                    <a href="index.php"><span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l14 0" />
                                <path d="M5 12l4 4" />
                                <path d="M5 12l4 -4" />
                            </svg></span>volver</a>
                </div>
            </div>

        </div>
        <?php include 'footer.php' ?>
        <?php include 'menu.php' ?>

    </main>
</body>

</html>