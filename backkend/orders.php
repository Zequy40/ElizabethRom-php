<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['update_status'])){
    $pid = $_POST['pid'];
    $name = $_POST['status'];
    $productId = $_POST['stock'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    
    
     
        // Si el estado no requiere actualización del stock, solo actualiza el estado del pedido
        $update_product = $conn->prepare("UPDATE orders SET orderStatus = ? WHERE id = ?");
        $update_product->execute([$name, $pid]);
        $message[] = 'Pedido Actualizado con exito!';
        header("location:mail.php");
 
}

        if(isset($_POST["delete"])){
            $pid = $_POST['id'];
            $delete = $conn -> prepare("DELETE FROM `orders` WHERE id = ?");
            $delete -> execute([$pid]);
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Projects</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'components/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Producto</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pedidos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Producto Pedido</h3>

         
        </div>
        <div class="card-body p-0">
            <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Bravo</strong><br> '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }?>
          <table class="table table-striped projects">
              <thead>
              
                  <tr>
                      
                      <th>
                          nombre 
                      </th>
                      <th></th>
                      <th>
                          Producto
                      </th>
                      <th>
                          Cantidad
                      </th>
                      <th class="text-center">
                        Precio
                      </th>
                      <th>
                          Color
                      </th>
					  <th>
                          Talla
                      </th>
                      <th>
                          Total
                      </th>
                      <th>
                        
                      </th>
                      <th class="text-center">
                          Estado
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
             <?php
     
    $select_products = $conn->prepare("SELECT p.*, c.name AS user_name, s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN users c ON p.userId = c.id INNER JOIN products s ON p.productId = s.id WHERE p.orderStatus != 0" ); 
    $select_products->execute();
    $currentUserID = null;
    $ordersByUser = [];
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
         $userName = $fetch_product['user_name'];
   if (!isset($ordersByUser[$userName])) {
            $ordersByUser[$userName] = [];
        }

        // Agrega el pedido al usuario actual
        $ordersByUser[$userName][] = $fetch_product;
    }

    // Recorre los usuarios y sus pedidos
    foreach ($ordersByUser as $userName => $userOrders) {
        echo '<tr>';
        echo '<td colspan="12"><strong>' . $userName . '</strong><br>';
         $userId = $userOrders[0]['userId'];
        echo '<a class="btn btn-info btn-sm" href="orderId.php?id=' . $userId . '"><i class="fas fa-eye"></i> Ver Pedidos</a>';
        echo '<div class="float-end"></div><br>';
    $totalUsuario = 0;

   
     echo '</tr>';

        foreach ($userOrders as $order) {
            echo '<tr>';
            echo '<td><div class="product-img">
                      <img src="img/product/'.$order['product_image'].'" alt="Product Image" class="img-size-50">
                    </div></td>';
            echo '<td><small>Pedido el: ' . $order['orderDate'] . '</small></td>';
            echo '<td>' . $order['product_name'] . '</td>';
            echo '<td class="project_progress">' . $order['quantity'] . '</td>';
            echo '<input type="hidden" name="qty" value="'.$order['quantity'].'">';
            echo '<td>' . $order['product_price'] . ' €</td>';
            echo '<td>' . $order['colors'] . '</td>';
			echo '<td>' . $order['weight'] . '</td>';
            echo '<td class="text-info"><strong>'.$order['product_price'] * $order['quantity'].'€</strong><td/>';
            echo '<td class="project-state">';
            $totalUsuario += $order['product_price'] * $order['quantity'];
            
            
    
    // Agregar un campo de selección para el estado del pedido
    echo '<form action="" method="POST">';
    echo '<input type="hidden" name="pid" value="'.$order['id'].'">';
    echo '<input type="hidden" name="stock" value="'.$order['productId'].'">';
    if ($order['orderStatus'] != 3) { 
		echo '<select class="form-control" name="status">';


if ($order['orderStatus'] == 0) {
    // Si el estado actual es 'En Attente', muestra las opciones 'En progres' y 'Annuler'
	echo '<option disabled selected>Pedido</option>';
    echo '<option value="0">Anular</option>';
} elseif ($order['orderStatus'] == 1) {
    // Si el estado actual es 'En progres', muestra las opciones 'Livrer' y 'Annuler'
	echo '<option disabled selected>Pagado</option>';
    echo '<option value="2">Enviado</option>';
    echo '<option value="0">Anular</option>';
} elseif ($order['orderStatus'] == 2) {
    // Si el estado actual es 'En progres', muestra las opciones 'Livrer' y 'Annuler'
	echo '<option disabled selected>Enviado</option>';
    echo '<option value="3">Entregado</option>';
    echo '<option value="0">Anular</option>';
}
echo '</select><br>';
	}
			else
			{
			echo '<span class="text-success fs-1">Entregado</span>';
      echo '<td></td>';
      echo '<td></td>';
			}

    
    // Agregar un botón para enviar el formulario
			if ($order['orderStatus'] != 3) {
    echo '<button type="submit" class="btn btn-warning" name="update_status">Actualizar</button>';
    echo '</form>';
			

            echo '</td>';
            echo '<td class="project-actions text-right">';
            
            echo '<a class="btn btn-info btn-sm" href="order-edit.php?id=' . $order['id'] . '"><i class="fas fa-pencil-alt"></i> Editar</a>';
            echo '</td>';
            echo '<td>';
            //echo '<form action="" method="POST" onsubmit="return confirmarEliminacion()">';
            //echo '<input type="hidden" name="pid" value="'.$order['id'].'">';
            $modalId = 'confirmDeleteModal_' . $order['id'];
            echo '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#' . $modalId . '">Eliminar</button>';
            //echo '</form>';
             echo '<div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
echo '    <div class="modal-dialog" role="document">';
echo '        <div class="modal-content">';
echo '            <div class="modal-header">';
echo '                <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>';
echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
echo '                    <span aria-hidden="true">&times;</span>';
echo '                </button>';
echo '            </div>';
echo '            <div class="modal-body">';
echo '                <form action="" method="POST">';
echo '                    <input type="hidden" name="id" value="'.$order['id'].'">';
echo '                    Desea supprimir este producto?';
echo '                </div>';
echo '                <div class="modal-footer">';
echo '                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anular</button>';
echo '                    <button type="submit" class="btn btn-danger" name="delete">Confirmar</button>';
echo '                </div>';
echo '            </form>';
echo '        </div>';
echo '    </div>';
echo '</div>';
            echo '</td>';
				}
            
            echo '</tr>';
           
        }
        echo '<tr>';
            
        echo '<td colspan="12">';
        echo '<div class="float-end text-warning"><strong>Total: '.$totalUsuario . '€</strong></div>';
        echo '</td>';
        echo '</tr>';
    }
    
} else {
    echo '<h1>Sin Pedidos</h1> <span class="badge bg-primary">ahora</span></h1>';
}?>
                
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  
</div>
<!-- ./wrapper -->
<?php  include 'components/footer.php';?>
<script>
function confirmarEliminacion() {
    return confirm("Vous vous vraiment effacer cette Pedidos?");
}
</script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
