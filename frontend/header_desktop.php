<div class="desktop_contain">
    <div class="desktop_global">
    <div class="global">
        <div class="desktop_container">
            <div class="desktop_logo"><a href="/"><img src="src/assets/logoFinal.svg" alt="LOGO"></a></div>
            <div class="desktop_title">
                <p class="desktop_p1">Elizabeth Rom</p>
                <p class="desktop_p">Brand</p>
            </div>
        </div>
        <ul class="desktop_ul">
            <li class="desktop_li">
                <a class="a_a" href="shop.php">Comprar</a>
                <ul class="ul_hover">
                    <h2 class="title_hover">
                            Los más vendidos
                        </h2>
                    <li class="li_hover">
                        
                        <?php 
                    $fetch_nav = $conn -> prepare("SELECT * FROM `bestseller` LIMIT 3");
                    $fetch_nav -> execute();
                    if ($fetch_nav->rowCount() > 0) {
                        while($fetch = $fetch_nav->fetch(PDO::FETCH_ASSOC)){
                    ?>
                        <a href="details.php?id=<?php echo $fetch["src"]?>"><div class="contain_hover">
                            <img src="../backkend/img/product/<?= $fetch["img"]?>" alt="">
                            
                        </div></a>
                        <a href="details.php?id=<?php echo $fetch["src2"]?>"><div class="contain_hover">
                            <img src="../backkend/img/product/<?= $fetch["img2"]?>" alt="">
                            
                        </div></a>
                        <a href="details.php?id=<?php echo $fetch["src3"]?>"><div class="contain_hover">
                            <img src="../backkend/img/product/<?= $fetch["img3"]?>" alt="">
                            
                        </div></a>
                        <a href="shop.php"><div class="contain_hover">
                            <p>Ver más</p>
                            
                        </div></a>
                        <?php }
                    }
                    ?>
                    </li>
                </ul>
            </li>
            <li class="desktop_li"><a class="a_a" href="whislist.php">Favoritos</a></li>
            <li class="desktop_li"><a class="a_a" href="account.php">Cuenta</a></li>
            <li class="desktop_li"><a class="a_a" href="contact.php">Contacto</a></li>
            <li class="desktop_li"><a class="a_a" href="cart2.php">Cesta</a></li>
        </ul>
    </div>
    </div>
</div>