<?php 

include '../backkend/conexion/conexion.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};
$fetch_cart = $conn->prepare("SELECT p.*,  s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus = 1 AND userId =".$user_id);
			$fetch_cart->execute();
			if ($fetch_cart->rowCount() > 0) {
				while ($fetch = $fetch_cart->fetch(PDO::FETCH_ASSOC)) {
                    $output[] = $fetch;
				}
                }

$body = 'Confirmación de su pedido:';
$body .= '<br><br><br>Resumen de pedido:<br><br>';
foreach ($output as $item) {
    $body .= '<b>Producto:</b> ' . $item['product_name'] . '<br>';
    $body .= '<b>Precio:</b> ' . $item['product_price'] . '€<br>';
    $body .= '<b>talla: </b> ' . $item['weight'] . '<br>';
    $body .= '<b>color: </b> ' . $item['colors'] . '<br>';
    $body .= '<b>Cantidad: </b> ' . $item['quantity'] . '<br>';
    $body .= '<br>';
    $body .= 'Gracias por confiar en Elizabet Rom';
}

$fetch_user = $conn->prepare("SELECT email  FROM `users` WHERE  id =".$user_id);
$fetch_user->execute();
$fetch_result = $fetch_user->fetch(PDO::FETCH_ASSOC);

$cliente = $fetch_result['email'];

$asunto = 'Pedido Realizado en Elizabeth Rom';
use PHPMailer\PHPMailer\PHPMailer;
                        use PHPMailer\PHPMailer\Exception;

                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                       
                        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                        try {
                            //Server settings
                            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'smtp.servidor-correo.net';  // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'dptweb@pluscover.es';                 // SMTP username
                            $mail->Password = 'Kely_1404_1404';                           // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                    // TCP port to connect to
                        
                            //Recipients
                            $mail->setFrom('dptweb@pluscover.es', 'Administración');
                           $mail->addCC('skyditec@gmail.com', 'Pedido');
                            $mail->addAddress($cliente);
                        
                            //Content
                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = $asunto;
                            $mail->Body    = $body;
                            $mail->CharSet = 'UTF-8';
                        
                            $mail->send();
                            echo 'Mensaje enviado';
                        } catch (Exception $e) {
                            echo 'No se envío el mensaje.', $mail->ErrorInfo;
                        }
                        header(sprintf("Location:index.php"));
                        
?>

