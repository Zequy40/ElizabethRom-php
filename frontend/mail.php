<?php 

include '_backAdmin/conexion/conexion.php';
session_start();

    $user_id = $_SESSION['user_id'];

$fetch_cart = $conn->prepare("SELECT p.*,  s.productName AS product_name, s.productPrice AS product_price, s.productImage1 AS product_image FROM orders p INNER JOIN products s ON p.productId = s.id WHERE orderStatus = 1 AND send = 0 AND userId =".$user_id);
			$fetch_cart->execute();
			if ($fetch_cart->rowCount() > 0) {
				while ($fetch = $fetch_cart->fetch(PDO::FETCH_ASSOC)) {
                    $output[] = $fetch;
				}
                }
                $fetch_user = $conn->prepare("SELECT email, userName  FROM `users` WHERE  id =".$user_id);
                $fetch_user->execute();
                $fetch_result = $fetch_user->fetch(PDO::FETCH_ASSOC);
                
                $cliente = $fetch_result['email'];
                // Construir el cuerpo del correo
                $body = 'Confirmación de su pedido:';
                $body .= '<br>'.$fetch_result['userName'].'<br>';
                $body .= '<br><br>Resumen de pedido:<br><br>';
                foreach ($output as $item) {
                    $body .= '<b>Producto:</b> ' . $item['product_name'] . '<br>';
                    $body .= '<b>Precio:</b> ' . $item['product_price'] . '€<br>';
                    $body .= '<b>talla: </b> ' . $item['weight'] . '<br>';
                    $body .= '<b>color: </b> ' . $item['colors'] . '<br>';
                    $body .= '<b>Cantidad: </b> ' . $item['quantity'] . '<br>';
                    $body .= '<br>';
                    $body .= 'Gracias por confiar en Elizabet Rom';
                }
                
                // Dirección de correo del cliente
                $cliente = $fetch_result['email'];
                
                // Asunto del correo
                $asunto = 'Pedido Realizado en Elizabeth Rom';

                $bcc = 'pedidos@elizabethrom.com'; 
                $bcc2 = 'elizabethrombrand@gmail.com';
                
                // Cabeceras del correo
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: pedidos@elizabethrom.com' . "\r\n";
                $headers .= 'Bcc: ' . $bcc . ',' . $bcc2 . "\r\n";
                
                // Enviar el correo
                $mailSent = mail($cliente, $asunto, $body, $headers);
                
                // Verificar si el correo se envió correctamente
                if ($mailSent) {
                    echo 'Correo de confirmación enviado con éxito';
                } else {
                    echo 'Error al enviar el correo de confirmación';
                }
                
                header(sprintf("Location:index.php"));
                ?>
  