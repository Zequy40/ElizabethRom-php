<?php
include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}


   $pid = $_GET['read'];
   $status = 1;
   
   $update_product = $conn->prepare("UPDATE `messages` SET status = ? WHERE id = ?");
   $update_product->execute([$status, $pid]);
   header('Location: messages-read.php');
   

?>