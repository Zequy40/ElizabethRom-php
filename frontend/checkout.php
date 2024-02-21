<?php
if(isset($_POST['confirm'])){
  $pid = $_POST['pid'];
  $price = $_POST['price'];
}
require __DIR__ .'/vendor/autoload.php';

$stripeSecretKey = "sk_test_51OlaAbKyLnc6f8hesuluAPaLnGqZS3gzGdey81WzBQlu8xKw0ByDPIQyB4d2IJgQ3TJN8gxld0UdzOq31Jr3btRq00R1jjG0AJ";

\Stripe\Stripe::setApiKey($stripeSecretKey);
header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://elizabethrom.com';

$checkout_session = \Stripe\Checkout\Session::create([
    'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/mail.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'quantity' => 1,
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $price,
      'product_data' => [
        'name' => 'Cardigan',
        'description' => 'Cárdigan oversize de punto',
                
      ]
    ]
  ]],
  
]);

http_response_code(303);
header("Location: " . $checkout_session->url);
  