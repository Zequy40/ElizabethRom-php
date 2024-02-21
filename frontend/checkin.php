<?php 
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
};


include '_backAdmin/conexion/conexion.php';
$pid = $user_id;
     //Actualiza el estado del pedido
            $update_product = $conn->prepare("UPDATE orders SET orderStatus = ?, send = ? WHERE userId = ? AND orderStatus = 0");
            $update_product->execute([1, 0, $pid]);
            header("location:success.html");
			exit;

            
?>
