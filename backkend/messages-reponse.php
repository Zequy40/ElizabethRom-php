<?php include 'conexion/conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

if(isset($_POST['reponse'])){
   $message_id = $_GET['id'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   
   // Recuperar el ID del usuario, asegúrate de tener una variable $user_id con el ID del usuario correcto
   $user_id = $_SESSION['user_id'];  // Debes ajustar esto según cómo manejas la sesión del usuario

   // Consulta para obtener el ID del usuario que envió el mensaje original
   $select_message = $conn->prepare("SELECT userId FROM messages WHERE id = ?");
   $select_message->execute([$message_id]);

   if($select_message->rowCount() > 0){
       $message_data = $select_message->fetch();  // Obtener los resultados de la consulta
       $original_user_id = $message_data['userId'];
       $response = 1;
       $status = 1;// ID del usuario que envió el mensaje original

       // Insertar el nuevo mensaje
       $insert_message = $conn->prepare("INSERT INTO messages (title, message, findId, userId, response, status) VALUES (?, ?, ?, ?, ?, ?)");
       $insert_message->execute([$name, $details, $original_user_id, $user_id, $response,$status ]);
       
       header('Location: messages.php');
   } else {
       // Manejar el caso en el que no se encuentra el mensaje original
       echo "Mensaje no encontrado";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Project Add</title>

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
            <h1>Ajouter une Categorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Créer Categorie</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

            </div>
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                    <?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Attention</strong><br> '.$message.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
      }
   }
?>
                  
                  <div class="form-group">
                    <label for="exampleCat">Titre:</label>
                    <input type="text" class="form-control" id="exampleCat" placeholder="Titre" required maxlength="100" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleDescription">Message:</label>
                    <textarea name="details" id="exampleDescription" placeholder="Message" class="form-control" required maxlength="500" cols="30" rows="10"></textarea>
                  </div>
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="reponse">Envoyer</button>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include 'components/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
