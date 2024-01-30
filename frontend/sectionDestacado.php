<?php
include '../backkend/conexion/conexion.php';
?>

<section class="sectionDestacado_containerSection">
<h1 class="sectionDestacado_contain">Elizabeth Rom en Instagram</h1>
<div class="sectionDestacado_containDiv">
<?php 
$selectSlider = $conn->prepare("SELECT img, src FROM `instagram`");
$selectSlider->execute();
if ($selectSlider->rowCount() > 0) {
  while($fetch = $selectSlider->fetch(PDO::FETCH_ASSOC)){
        ?>
  <div class="sectionDestacado_containImage">
      <a href="<?php echo $fetch["src"]?>" class="sectionDestacado_backgroundImage"><div></div></a>
      <img class="sectionDestacado_img" src="../backkend/img/product/<?php echo $fetch["img"]?>" alt="Imagen 2">
      
  </div>
  <?php
  }
}
?>
</div>

</section>