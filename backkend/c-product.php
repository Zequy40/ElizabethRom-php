<?php ini_set('display_errors', '1');
require_once('../Connections/conexion.php');

if(!isset($_SESSION['MM_Username']) || empty($_SESSION['MM_Username'])){
  header("location: ../../acceso.html");
  exit;
}

$query_DatosConsulta2 = sprintf("SELECT * FROM tblUsuarios WHERE intActivo=1");

$DatosConsulta2 = mysqli_query($con,  $query_DatosConsulta2) or die(mysqli_error($con));
$row_DatosConsulta2 = mysqli_fetch_assoc($DatosConsulta2);
$totalRows_DatosConsulta2 = mysqli_num_rows($DatosConsulta2);
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google" content="notranslate">


    <title>Administración de PlusCover</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="icon" href="../../icon-hires.png">
    <link rel="icon" href="../../icon-normal.png">
    <link href="../css/miscss.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">

        <a class="navbar-brand" href="#">Pluscover</a>
    </div>
    <!-- /.navbar-header -->

    <div class="nav-product">
        <ul class="nav navbar-top-links navbar-right">
            <li><a href="comercial.php" class="return"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                    </svg></a> </li>
    </div>
    </ul>
    <!-- /.dropdown-messages -->

</nav>

<body>

    <div id="wrapper">






        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bienvenido <?php echo $_SESSION['webpluscover_User'];?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <?php
            switch ($_GET["option"]){
               case 1:
                    ?> 

                <?php $query_DatosConsulta = sprintf("SELECT * FROM subCategory");
                                        $DatosConsulta = mysqli_query($con,  $query_DatosConsulta) or die(mysqli_error($con));
                                        $row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta);
                                        $totalRows_DatosConsulta = mysqli_num_rows($DatosConsulta); 
                                        if ($totalRows_DatosConsulta > 0) {  
                                            do { 
                                                     ?>
                <div class="col-xs-6">
                    <a href="t-product.php?option=<?php echo $row_DatosConsulta["id"];?>" class="description">
                        <div class="table-responsive">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h4 class="card-title"><?php if($row_DatosConsulta["idCategory"] == 1){ 
                                        echo "Vycover";}
                                        else if($row_DatosConsulta["idCategory"] == 2){
                                            echo "Woodcover";
                                        }else if($row_DatosConsulta["idCategory"] == 3){
                                            echo "Deckcover";
                                        }else if($row_DatosConsulta["idCategory"] == 4){
                                            echo "Ecover";
                                        }else if($row_DatosConsulta["idCategory"] == 5){
                                            echo "Bamcover";
                                        }?></h4>
                                    <p class="card-text"><?php echo $row_DatosConsulta["name"];?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                
                      
                           } while ($row_DatosConsulta = mysqli_fetch_assoc($DatosConsulta)); 
             } 
            else
             { //MOSTRAR SI NO HAY RESULTADOS ?>
                No hay resultados.
                <?php } 
                
                break;
			}
			?>

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morrisjs/morris.min.js"></script>
        <script src="../data/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>