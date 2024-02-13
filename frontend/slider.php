<?php
include '_backAdmin/conexion/conexion.php';
?>
<div class="SliderContainer">
  <div class="skeleton-container">
    <div class="skeleton-item"></div>
  </div>

<?php 
$selectSlider = $conn->prepare("SELECT * FROM `slider`");
$selectSlider->execute();
if ($selectSlider->rowCount() > 0) {
  while($fetch = $selectSlider->fetch(PDO::FETCH_ASSOC)){
        ?><div class="SliderSlide" x-data="{ imageIndex: <?php echo $fetch["id"]?> }">
    <img src="_backAdmin/img/slider/<?php echo $fetch["img"]?>" alt="Imagen <?php $fetch["id"]?>">
  </div>
  <?php
  }
}
?>

  <div class="SliderBtn">
    <button id="anterior"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="SliderArrow" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
      </svg></button>
    <button id="siguiente"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="SliderArrow" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
      </svg></button>
  </div>
</div>