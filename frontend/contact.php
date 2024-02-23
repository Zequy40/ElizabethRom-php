<?php include '_backAdmin/conexion/conexion.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};

if (isset($_POST['exit'])) {
    session_start();
    session_unset();
    session_destroy();

    header('location:#');
}
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EliRom Brand.</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="slider.css">
    <link rel="stylesheet" href="sectionClothe.css">
    <link rel="stylesheet" href="sectionDestacado.css">
    <link rel="stylesheet" href="sectionCart.css">
    <link rel="stylesheet" href="footer.css">
    <script defer src="slider.js"></script>
    


</head>
<body>
<div class="mobile">
            <?php include 'header.php' ?>
        </div>
        <div class="tablet">
           
            <?php include 'header_tablet.php' ?>
            
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
         
        </div>
    
<section class="contact_principal">
  
    
    <div class="divider">
		<div class="contact_notification">
            <div class="contact_notiglow"></div>
            <div class="contact_notiborderglow"></div>
            <div class="contact_notititle">Bienvenido a mi contacto</div>
            <div class="contact_notibody">Si deseas ponerte en contacto con nosotros, utiliza los diferentes medios disponibles:
                
            </div>
            <div class="contact_notibody">
                
                <div class="contact_contain">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                      </svg>
                  <p><a href="mailto:admin@elizabethrom.com">admin@elizabethrom.com</a></p></div>
                </div>
            </div>
            <div class="contact_card">
                <!-- Icon Instagram -->
                <a href="https://www.instagram.com/elizabethrombrand?igsh=MnhjYm5oemc1a2Nn" class="contact_socialContainer contact_containerOne">
                  <svg class="contact_socialSvg contact_instagramSvg" viewBox="0 0 16 16"> <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path> </svg>
                </a>
                
                <a href="https://pin.it/4ixiGWm" class="contact_socialContainer contact_containerTwo">
                    <!-- Icon Pinterest -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="contact_socialSvg contact_twitterSvg" viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 0 0-2.915 15.452c-.07-.633-.134-1.606.027-2.297.146-.625.938-3.977.938-3.977s-.239-.479-.239-1.187c0-1.113.645-1.943 1.448-1.943.682 0 1.012.512 1.012 1.127 0 .686-.437 1.712-.663 2.663-.188.796.4 1.446 1.185 1.446 1.422 0 2.515-1.5 2.515-3.664 0-1.915-1.377-3.254-3.342-3.254-2.276 0-3.612 1.707-3.612 3.471 0 .688.265 1.425.595 1.826a.24.24 0 0 1 .056.23c-.061.252-.196.796-.222.907-.035.146-.116.177-.268.107-1-.465-1.624-1.926-1.624-3.1 0-2.523 1.834-4.84 5.286-4.84 2.775 0 4.932 1.977 4.932 4.62 0 2.757-1.739 4.976-4.151 4.976-.811 0-1.573-.421-1.834-.919l-.498 1.902c-.181.695-.669 1.566-.995 2.097A8 8 0 1 0 8 0"/>
                  </svg>            </a>
                  
                <a href="https://www.tiktok.com/@elizabethrombrand?_t=8iYuzFCo7hB&_r=1" class="contact_socialContainer contact_containerThree">
                  <!-- Icon tiktok -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="contact_socialSvg contact_linkdinSvg" viewBox="0 0 16 16">
                    <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                  </svg>
                </a>
                
                
              </div>    
              </div>   
	</section>

  <div class="mobile">
            <?php include '../footerAccount.php' ?>
    </div>
    <?php include 'menu.php' ?>
    <div class="desktop">
      <div class="notification_desktop">
        <h1>Nuestro equipo</h1>
        <p>Nuestra politica de respuesta, es de contestar lo más rápido posible, pero teniendo en cuenta el volumen de trabajo y dependiendo de nuestro flujo de trabajo podemos demorar en contestar entre 24 y 48h. Le agredecemos su confianza y estaremos al tanto de todo contacto recibido.</p>
        <p>
        El equipo Elizabeth Rom Brand
      </p>
            </div>
            <?php include 'footer_desktop.php' ?>
         
        </div>       
</body>
<script>
    const navTablet = document.querySelector('.menuTablet');
    const menuButton = document.querySelector('#menuNav');
    const closeTablet = document.querySelector('#close');
    const nav = document.querySelector('#menu');

    navTablet.addEventListener('pointerdown', function() {
        menuButton.classList.add('activation');
    })
    closeTablet.addEventListener('pointerdown', () => {
        menuButton.classList.remove('activation');
    })
</script>
</html>