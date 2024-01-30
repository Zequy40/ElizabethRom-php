<?php include '../backkend/conexion/conexion.php';
$idCat = $_GET['id'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliRom Brand.</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="shop.css">
</head>

<body>
    <main>
    <div class="desktop">
            <?php include 'header_desktop.php' ?>
         
        </div>
        <?php
        
        if ($_GET['cat'] == 'subcat') {

            $orders = $conn->prepare("SELECT subcategoryName FROM subcategory WHERE id=" . $idCat);
            $orders->execute();
            $result = $orders->fetch(PDO::FETCH_ASSOC);
        ?><div class="desktop">
            <nav class="shopClothe_contain">
                <a class="shopClothe_title" id="titleHeaderReturn" href='/shop.php'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="shopClothe_svg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                    <p><?= $result['subcategoryName'] ?></p>

                </a>
                <div class="shopClothe_icon">
                    <a id="addToCart" href='./shop.php'>
                        <div class="shopClothe_iconSvg"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shopClothe_svg">
                                <rect x="2.5" y="1.5" width="19" height="21" fill="none" stroke="black"></rect>
                                <path d="M17 4C17 6.76142 14.7614 9 12 9C9.23858 9 7 6.76142 7 4H8C8 6.20914 9.79086 8 12 8C14.2091 8 16 6.20914 16 4H17Z" fill="black" class=""></path>
                            </svg></div>
        </a>
                </div>
            </nav>
        </div>
            <?php

            $orders = $conn->prepare("SELECT COUNT(*) AS total_clothe FROM products WHERE idSubCategory=" . $idCat);
            $orders->execute();
            $result = $orders->fetch(PDO::FETCH_ASSOC);
            ?>
            <header class="shopClothe_header">
                <h1 class="shopClothe_h1">Colección 2024</h1>
                <div class="shopClothe_containResult">
                    <div class="shopClothe_result">Tienes <?= $result['total_clothe'] ?> productos para consultar </div>
                    <div class="shopClothe_btnSquare">
                        <button class="shopClothe_square1 backBtn" id="#square1"></button>
                        <button class="shopClothe_square2" id="#square2"></button>
                    </div>
                </div>
            </header>

        <?php } else {
            $orders = $conn->prepare("SELECT categoryName FROM category WHERE id=" . $idCat);
            $orders->execute();
            $result = $orders->fetch(PDO::FETCH_ASSOC);
        ?>
            <nav class="shopClothe_contain">
                <a class="shopClothe_title" id="titleHeaderReturn" href="shop.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="shopClothe_svg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                    <p><?= $result['categoryName'] ?></p>

        </a>
                <div class="shopClothe_icon">
                    <button id="addToCart">
                        <div class="shopClothe_iconSvg"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shopClothe_svg">
                                <rect x="2.5" y="1.5" width="19" height="21" fill="none" stroke="black"></rect>
                                <path d="M17 4C17 6.76142 14.7614 9 12 9C9.23858 9 7 6.76142 7 4H8C8 6.20914 9.79086 8 12 8C14.2091 8 16 6.20914 16 4H17Z" fill="black" class=""></path>
                            </svg></div>
                    </button>
                </div>
            </nav>
            <?php

            $orders = $conn->prepare("SELECT COUNT(*) AS total_clothe FROM products WHERE idCategory=" . $idCat);
            $orders->execute();
            $result = $orders->fetch(PDO::FETCH_ASSOC);
            ?>
            <header class="shopClothe_header">
                <h1 class="shopClothe_h1">Colección 2024</h1>
                <div class="shopClothe_containResult">
                    <div class="shopClothe_result">Tienes <?= $result['total_clothe'] ?> productos para consultar </div>
                    <div class="shopClothe_btnSquare">
                        <button class="shopClothe_square1 backBtn" id="#square1"></button>
                        <button class="shopClothe_square2" id="#square2"></button>
                    </div>
                </div>

            </header>

        <?php }
        $consultaPersonalizada = '';

        $cat = $_GET['cat'];
        switch ($cat) {
            case "cat":
                $consultaPersonalizada = "SELECT * FROM `products` WHERE idCategory=" . $idCat;
                break;

            case "subcat":
                $consultaPersonalizada = "SELECT * FROM `products` WHERE idSubCategory=" . $idCat;
                break;

            default:
                echo "No hay Prenda en esta categoria";
                break;
        }
        $fetch_category = $conn->prepare($consultaPersonalizada);
        $fetch_category->execute();
        ?>


        <section class="shopClothe_principal">
            <div class="shopClothe_containSection" id="containSection">
                <?php

                if ($fetch_category->rowCount() > 0) {
                    while ($fetch = $fetch_category->fetch(PDO::FETCH_ASSOC)) {
                        $numero = $fetch['productPrice'];
                        $numero_format = number_format($numero, 2, ',', '.');

                ?>
                        <div class="shopClothe_container">
                            <a href="details.php?id=<?php echo $fetch['id'] ?>" class="shopClothe_btn">
                                <div class="shopClothe_shop">
                                    <img src="../backkend/img/product/<?php echo $fetch['productImage1'] ?>" alt="" class="shopClothe_img">
                                    <p class="shopClothe_pShop">Añadir al carrito</p>
                                </div>
                                <div class="shopClothe_containP">
                                    <p class="shopClothe_p1"><?php echo $fetch['productDescription'] ?></p>
                                    <p class="shopClothe_p2">€ <?php echo $numero_format ?></p>
                                </div>
                            </a>
                        </div>
                <?php   }
                }
                ?>
            </div>


        </section>

    </main>
    <div class="desktop">
            <?php include 'footer_desktop.php' ?>
         
        </div>
</body>

</html>

<script>
    const principal = document.querySelector(".shopClothe_containSection");
    const square1 = document.querySelector(".shopClothe_square1");
    const square2 = document.querySelector(".shopClothe_square2");

    square1.addEventListener('pointerdown', function() {
        square2.classList.remove('shopClothe_backBtn');
        square1.classList.add('shopClothe_backBtn');
        principal.classList.remove('shopClothe_squareActive');
    });

    square2.addEventListener('pointerdown', function() {
        square1.classList.remove('shopClothe_backBtn');
        square2.classList.add('shopClothe_backBtn');
        principal.classList.add('shopClothe_squareActive');
    });

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
</script>