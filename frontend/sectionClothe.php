<?php 
include '_backAdmin/conexion/conexion.php';
?>

<section class="sectionclothe_containerSection">
    <h1 class="sectionclothe_title">Las más vendidas</h1>  
    <?php 
$selectSlider = $conn->prepare("SELECT * FROM `bestseller`");
$selectSlider->execute();
$fetch = $selectSlider->fetch(PDO::FETCH_ASSOC) 
    ?>
<div class="sectionclothe_part">
    <div class="sectionclothe_image">
        <div class="sectionclothe_contain">
        <img class="sectionclothe_img" src="_backAdmin/img/product/<?php echo $fetch["img"]?>" alt="Imagen 2">
       
        <a href="details.php?id=<?php echo $fetch["src"]?>"><h3 class="sectionclothe_h3">shop here <span>&rarr;</span></h3></a>
        
    </div>
    </div>
    <div class="sectionclothe_image">
        <div class="sectionclothe_contain">
        <img class="sectionclothe_img" src="_backAdmin/img/product/<?php echo $fetch["img2"]?>" alt="Imagen 2">
        <a href="details.php?id=<?php echo $fetch["src2"]?>"><h3 class="sectionclothe_h3">shop here &rarr;</h3></a>
    </div>
    </div>
</div>
<div class="sectionclothe_part">
    <div class="sectionclothe_image">
        <div class="sectionclothe_contain">
        <img class="sectionclothe_img" src="_backAdmin/img/product/<?php echo $fetch["img3"]?>" alt="Imagen 2">
        
        <a href="details.php?id=<?php echo $fetch["src3"]?>"><h3 class="sectionclothe_h3">shop here &rarr;</h3></a>
    
    </div>
    </div>
    <div class="sectionclothe_image">
        <div class="sectionclothe_contain">
        <img class="sectionclothe_img" src="_backAdmin/img/product/<?php echo $fetch["img4"]?>" alt="Imagen 2">
        
    </div>
    </div>
</div>

</section>