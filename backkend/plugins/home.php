<?php
include 'conexion/conexion.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE | Elizabeth Rom</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
 <?php include 'components/header.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Elizabeth Rom | Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
         
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3" onclick="window.location.href = 'delivered.php';" style="cursor: pointer">
              
            <div class="info-box mb-3">
                
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-regular fa-paper-plane"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pedidos enviados</span>
                <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS orders_send FROM orders WHERE orderStatus='Livrer'");
								$orders -> execute();
								$result = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                
                <span class="info-box-number">
                    <?= $result["orders_send"];?>
                </span>
             
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div> 
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3" onclick="window.location.href = 'inprogress.php';" style="cursor: pointer">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-solid fa-hourglass-half"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pedidos en espera</span>
                <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS orders_pending FROM orders WHERE orderStatus='En Attente'");
								$orders -> execute();
								$result = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                
                <span class="info-box-number"><?php echo $result['orders_pending'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
           <div class="col-12 col-sm-6 col-md-3" onclick="window.location.href = 'orders.php';" style="cursor: pointer">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pedidos</span>
                <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS orders FROM orders");
								$orders -> execute();
								$result = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                <span class="info-box-number"><?php echo $result['orders'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3" onclick="window.location.href = 'users.php';" style="cursor: pointer">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clientes</span>
                 <?php 
                            $clients = $conn ->prepare("SELECT COUNT(*) AS client FROM users");
								$clients -> execute();
								$result = $clients->fetch(PDO::FETCH_ASSOC);
                    ?>
                <span class="info-box-number"><?php echo $result['client'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Recap Transacciones</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Ventes: 1 Ene, 2024 - 01 Dic, 2024</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Objetivo</strong>
                    </p>

                    <div class="progress-group">
                        <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS total_pedidos, SUM(quantity) AS total_quantity FROM orders");
								$orders -> execute();
								$results = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                      Productos pedidos
                      <span class="float-right"><b><?php echo $results['total_pedidos']?></b>/200</span>
                      <div class="progress progress-sm">
                          <?php 
                          $percent = $results['total_pedidos'];
                          $totalpercent = $percent * 100;
                          $total = $totalpercent / 200;
                          ?>
                        <div class="progress-bar bg-primary" style="width: <?php echo $total;?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                        <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS complete_pedidos, SUM(quantity) AS complete_quantity FROM orders WHERE orderStatus='Complet'");
								$orders -> execute();
								$resultado = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                      Compras completadas
                      <span class="float-right"><b><?php echo $resultado['complete_pedidos']?></b>/400</span>
                      <div class="progress progress-sm">
                          <?php 
                          $percent = $resultado['complete_pedidos'];
                          $totalpercent = $percent * 100;
                          $total = $totalpercent / 400;
                          ?>
                        <div class="progress-bar bg-danger" style="width: <?php echo $total;?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS complete_pedidos, SUM(quantity) AS complete_quantity FROM orders WHERE orderStatus='En progres'");
								$orders -> execute();
								$result = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                      <span class="progress-text">Envoie en cours</span>
                      <span class="float-right"><b><?php echo $result['complete_pedidos']?></b>/<?php echo $results['total_pedidos']?></span>
                      <div class="progress progress-sm">
                          <?php 
                          $percent = $result['complete_pedidos'];
                          $totalpercent = $percent * 100;
                          $complete = $results['total_pedidos'];
                          $total = $totalpercent / $complete;
                          ?>
                        <div class="progress-bar bg-success" style="width: <?php echo $total;?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                        <?php 
                            $orders = $conn ->prepare("SELECT COUNT(*) AS complete_pedidos, SUM(quantity) AS complete_quantity FROM orders WHERE orderStatus='Complet'");
								$orders -> execute();
								$resultad = $orders->fetch(PDO::FETCH_ASSOC);
                    ?>
                      Envíos completados
                       <?php 
                          $percent = $resultad['complete_pedidos'];
                          $totalpercent = $percent * 100;
                          $complete = $results['total_pedidos'];
                          $total = $totalpercent / $complete;
                          ?>
                      <span class="float-right"><b><?php echo $resultad['complete_pedidos']?></b>/<?php echo $results['total_pedidos']?></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: <?php echo $total;?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <?php $total_income = $conn -> prepare("SELECT * FROM conta ORDER BY id DESC LIMIT 1");
                    $total_income -> execute();
                    $result_income = $total_income->fetch(PDO::FETCH_ASSOC);
                    $percent_expense = $result_income["expense"];
                    $percent_revenu = $result_income["totalIncome"];
                    $total= $percent_revenu - $percent_expense;
                    $percent = number_format((($total * 100) / $percent_revenu), 0);
                     if($percent > 0){?>
                        
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?= $percent;?> %</span><?php }elseif($percent == 0){?>
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?= $percent;?> %</span><?php }elseif($percent < 0){?>
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?= $percent;?> %</span><?php } ?>
                      <h5 class="description-header"><?php echo $total;?> €</h5>
                      <span class="description-text">TOTAL ENTRADAS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                 
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <?php $total_income = $conn -> prepare("SELECT 
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN sale ELSE 0 END), 0), 2) AS incomeLastYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN sale ELSE 0 END), 0), 2) AS incomeCurrentYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN sale ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN sale ELSE 0 END), 0), 2) AS incomeDifference
FROM 
    conta;
");
                    $total_income -> execute();
                    $result_income = $total_income->fetch(PDO::FETCH_ASSOC);
                    $percent_current = $result_income["incomeCurrentYear"];
                    $percent_lastyears = $result_income["incomeDifference"];
                    $percent_total = ($percent_lastyears * 100) / $percent_current;
                    $percentFormmated = number_format($percent_total, 0);
                        
                      if($percentFormmated > 0){?>
                        
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated == 0){?>
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated < 0){?>
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?= $percentFormmated;?> %</span><?php } ?>
                      
                       <?php $total_gain = $conn -> prepare("SELECT * FROM conta ORDER BY id DESC LIMIT 1");
                    $total_gain -> execute();
                    $result_gain = $total_gain->fetch(PDO::FETCH_ASSOC);?>
                      <h5 class="description-header"><?=$result_gain["totalIncome"];?> €</h5>
                      <span class="description-text">TOTAL VENTAS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <?php
                        $total_income = $conn -> prepare("SELECT 
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN totalIncome ELSE 0 END), 0), 2) AS incomeLastYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN totalIncome ELSE 0 END), 0), 2) AS incomeCurrentYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN totalIncome ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN totalIncome ELSE 0 END), 0), 2) AS incomeDifference
FROM 
    conta;
");
                    $total_income -> execute();
                    $result_income = $total_income->fetch(PDO::FETCH_ASSOC);
                    $percent_current = $result_income["incomeCurrentYear"];
                    $percent_lastyears = $result_income["incomeDifference"];
                    $percent_total = ($percent_lastyears * 100) / $percent_current;
                    $percentFormmated = number_format($percent_total, 0);
                    
                        if($percentFormmated > 0){?>
                        
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated == 0){?>
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated < 0){?>
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?= $percentFormmated;?> %</span><?php } ?>
                      
                      <h5 class="description-header"><?= $result_income["incomeDifference"];?> €</h5>
                      <span class="description-text">TOTAL GANANCIAS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <?php
                        $total_income = $conn -> prepare("SELECT 
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN returnProduct ELSE 0 END), 0), 2) AS incomeLastYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN returnProduct ELSE 0 END), 0), 2) AS incomeCurrentYear,
    ROUND (COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) THEN returnProduct ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN years = (SELECT MAX(years) FROM conta) - 1 THEN returnProduct ELSE 0 END), 0), 2) AS incomeDifference
FROM 
    conta;
");
                    $total_income -> execute();
                    $result_income = $total_income->fetch(PDO::FETCH_ASSOC);
                    $percent_current = $result_income["incomeCurrentYear"];
                    $percent_lastyears = $result_income["incomeDifference"];
                    $percent_total = $percent_lastyears - $percent_current;
                    $percentFormmated = number_format($percent_total, 0);
                    
                        if($percentFormmated > 0){?>
                        
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated == 0){?>
                      <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?= $percentFormmated;?> %</span><?php }elseif($percentFormmated < 0){?>
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?= $percentFormmated;?> %</span><?php } ?>
                      <?php $total_gain = $conn -> prepare("SELECT * FROM conta ORDER BY id DESC LIMIT 1");
                    $total_gain -> execute();
                    $result_gain = $total_gain->fetch(PDO::FETCH_ASSOC);?>
                      <h5 class="description-header"><?= $result_gain["returnProduct"]?></h5>
                      <span class="description-text">TOTAL DEVOLUCIONES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reporte</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="d-md-flex">
                  <div class="p-1 flex-fill" style="overflow: hidden">
                    <!-- Map will be created here -->
                    
            <!-- /.card -->
            <div class="row">
              <div class="col-md-6">
                
              </div>
              <!-- /.col -->

              <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Ultimos clientes</h3>

                    <div class="card-tools">
                      <span class="badge badge-danger">8 Nuevos clientes</span>
                      
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                    <?php
                         $select_client = $conn->prepare("SELECT * FROM users WHERE user='Client' ORDER BY id DESC LIMIT 8 " ); 
    $select_client->execute();
    if($select_client->rowCount() > 0){
     while($fetch_client = $select_client -> fetch(PDO::FETCH_ASSOC)){
  ?>
                      <li>
                          <?php if($fetch_client["avatar"] == ""){
                              echo '<img src="dist/img/default-150x150.png" width="150" alt="User Image">';
                          }else{
                              echo '<img src="dist/img/'.$fetch_client["avatar"].'" width="150" alt="User Image">';
                          }?>
                        
                        <a class="users-list-name" href="#"><?= $fetch_client["name"]?> <?= $fetch_client["lastName"]?></a>
                        <span class="users-list-date"><?= $fetch_client["regDate"]?></span>
                      </li>
                      <?php } }?>
                      
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="users.php">Ver todos los clientes</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Pedidos recientes</h3></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Producto</th>
                      <th>Estado</th>
                      <th>Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                         $select_products = $conn->prepare("SELECT p.*, s.productName AS product_name FROM orders p INNER JOIN products s ON p.productId = s.id ORDER BY p.id DESC LIMIT 10" ); 
    $select_products->execute();
    if($select_products->rowCount() > 0){
     while($fetch_product = $select_products -> fetch(PDO::FETCH_ASSOC)){
  ?>
                    <tr>
                      <td><a href="#"><?= $fetch_product['id'];?></a></td>
                      <td><?= $fetch_product['product_name'];?></td>
                      <td><?php if ($fetch_product['orderStatus'] == "Valider") { ?>
        <span class="badge badge-primary">
            Validar
        </span>
    <?php 
        
    }else if ($fetch_product['orderStatus'] == "Payer"){
        ?>
        <span class="badge badge-warning">
            Pagar
        </span>
    <?php
    } else if ($fetch_product['orderStatus'] == "En Traitement"){
        ?><span class="badge badge-info">
            En Proceso
        </span>
        <?php
    } else if ($fetch_product['orderStatus'] == "Livrer"){
        ?><span class="badge badge-success">
            Enviado
        </span>
        <?php
    }
    else if ($fetch_product['orderStatus'] == "Complet"){
        ?><span class="badge badge-success">
            Completado
        </span>
        <?php
    }
    ?></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?= $fetch_product['orderDate'];?></div>
                      </td>
                    </tr>
                    <?php };
                    } ?>
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
                <a href="orders.php" class="btn btn-sm btn-info float-right">Ver Pedidos</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            
            <!-- /.info-box -->


            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Productos añadido recientemente</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php
                    $selectRecent = $conn -> prepare ("SELECT * FROM products ORDER BY id DESC LIMIT 6");
                    $selectRecent->execute();
                    if ($selectRecent -> rowCount() > 0){
                        while($fetchRecent = $selectRecent -> fetch(PDO::FETCH_ASSOC)){
                    ?>
                  <li class="item">
                    <div class="product-img">
                        <?php if($fetchRecent["productImage1"] == ""){
                              echo '<img src="dist/img/default-150x150.png" class="img-size-50" alt="User Image">';
                          }else{
                              echo '<img alt="Product Image" class="table-avatar" class="img-size-50" src="img/product/'.$fetchRecent["productImage1"].'">';
                          }?>
                     
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title"><?= $fetchRecent["productName"];?>
                        <span class="badge badge-warning float-right"><?= $fetchRecent["productPrice"];?>€</span></a>
                      <span class="product-description">
                        <?= $fetchRecent["productDescription"];?>
                      </span>
                    </div>
                  </li>
                  <?php }
                  } ?>
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="product.php" class="uppercase">Ver todos los productos</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include 'components/footer.php'; ?>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
