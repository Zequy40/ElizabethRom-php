<?php 
include '../backkend/conexion/conexion.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};

    $idProduct = $_GET['id'];
    $idProduct = filter_var($idProduct, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $select_products = $conn->prepare("SELECT * FROM `wishlist` WHERE productId = ? AND userId = $user_id");
    $select_products->execute([$idProduct]);
    $result = $select_products->fetch(PDO::FETCH_ASSOC);
    if ($result) {
      $status = $result['status'];
      if ($status == 0) {
          $update_product = $conn->prepare("UPDATE `wishlist` SET status = 1 WHERE userId = ? AND productId = ?");
          $update_product->execute([$user_id, $idProduct]);
      } else {
          $update_product = $conn->prepare("UPDATE `wishlist` SET status = 0 WHERE userId = ? AND productId = ?");
          $update_product->execute([$user_id, $idProduct]);
      }
      header("location:details.php?id=".$idProduct);
  } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist` (userId, productId, status) VALUES (?, ?, ?)");
      $insert_wishlist->execute([$user_id, $idProduct, 1]);
      header("location:details.php?id=".$idProduct);
  };

  ?>