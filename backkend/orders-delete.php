<?php
include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}
            $delete_category = $_GET['delete'];
            $delete = $conn -> prepare("DELETE FROM `subcategory` WHERE id = ?");
            $delete -> execute([$delete_category]);
            header('Location: orders.php');

   

?>