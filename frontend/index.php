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


</head>

<body>
    <main>
         <div class="mobile">
            <?php include 'header.php' ?>
        </div>
         <div class="mobile">
            <?php include 'slider.php' ?>
            <?php include 'sectionClothe.php' ?>
            <?php include 'sectionDestacado.php' ?>
            <?php include 'sectionCart.php' ?>
            <?php include 'footer.php' ?>
        </div>
        <div class="tablet">
            <?php include 'slider_tablet.php' ?>
            <?php include 'header_tablet.php' ?>
            <?php include 'sectionClothe.php' ?>
            <?php include 'sectionDestacado.php' ?>
            <?php include 'sectionCart.php' ?>
        </div>
        <div class="desktop">
            <?php include 'header_desktop.php' ?>
            <div class="desktop_limit">
                <?php include 'head_desktop.php' ?>
                <?php include 'sectionClothe.php' ?>
                <?php include 'sectionDestacado.php' ?>
                <?php include 'footer_desktop.php' ?>
            </div>
        </div>
        <?php include 'menu.php' ?>

    </main>
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

    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const nextImage = document.querySelector('#siguiente');
        const prevImage = document.querySelector('#anterior');
        let intervalId;
        let timeoutId;

        function showSlide(n) {
            const slides = document.querySelectorAll('.SliderSlide');
            const btn = document.querySelector('.SliderBtn');
            const skeleton = document.querySelector('.skeleton-container');

            skeleton.style.display = 'none';
            btn.style.display = 'flex';
            // Oculta todas las diapositivas
            slides.forEach(slide => {
                slide.style.display = 'none';
            });

            // Muestra la diapositiva deseada
            slides[n].style.display = 'block';
            currentSlide = n;
            resetTimeout()
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % 6;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + 6) % 6;
            showSlide(currentSlide);
        }

        function resetTimeout() {
            // Limpia el timeout anterior y establece uno nuevo
            clearTimeout(timeoutId);
            timeoutId = setTimeout(startAutoSlide, 10000); // 10 segundos
        }

        function startAutoSlide() {
            // Inicia el slider automáticamente cada 3 segundos
            intervalId = setInterval(nextSlide, 3000);
        }

        nextImage.addEventListener('pointerdown', () => {
            clearInterval(intervalId);
            nextSlide();
        });

        prevImage.addEventListener('pointerdown', () => {
            clearInterval(intervalId);
            prevSlide();
        });

        // Iniciar el slider automáticamente cada 3 segundos
        startAutoSlide();
    });
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const nextImage = document.querySelector('#siguiente2');
        const prevImage = document.querySelector('#anterior2');
        let intervalId;
        let timeoutId;

        function showSlide(n) {
            const slides = document.querySelectorAll('.SliderSlide2');
            const btn = document.querySelector('.SliderBtn2');
            const skeleton = document.querySelector('.skeleton-container2');

            skeleton.style.display = 'none';
            btn.style.display = 'flex';
            // Oculta todas las diapositivas
            slides.forEach(slide => {
                slide.style.display = 'none';
            });

            // Muestra la diapositiva deseada
            slides[n].style.display = 'block';
            currentSlide = n;
            resetTimeout()
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % 6;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + 6) % 6;
            showSlide(currentSlide);
        }

        function resetTimeout() {
            // Limpia el timeout anterior y establece uno nuevo
            clearTimeout(timeoutId);
            timeoutId = setTimeout(startAutoSlide, 10000); // 10 segundos
        }

        function startAutoSlide() {
            // Inicia el slider automáticamente cada 3 segundos
            intervalId = setInterval(nextSlide, 3000);
        }

        nextImage.addEventListener('pointerdown', () => {
            clearInterval(intervalId);
            nextSlide();
        });

        prevImage.addEventListener('pointerdown', () => {
            clearInterval(intervalId);
            prevSlide();
        });

        // Iniciar el slider automáticamente cada 3 segundos
        startAutoSlide();
    });

    // Espera a que todas las imágenes se carguen antes de iniciar el slider
    window.addEventListener('load', function() {
        // Ahora el script de slider se ejecutará después de que todas las imágenes estén cargadas
        document.dispatchEvent(new Event('DOMContentLoaded'));
    });

    const icons = document.querySelectorAll(".footer_icon");
    const active = document.querySelector(".footer_iconMenu")

    // Agrega un evento de clic al botón del menú
    nav.addEventListener('pointerdown', function() {
        nav.classList.add('actived')
        menuButton.classList.toggle('activation');


        icons.forEach(icon => {
            if (icon.classList.contains('linked')) {
                const correspondingDiv = icon.parentElement;
                if (nav.classList.contains('actived')) {
                    if (correspondingDiv.classList.contains('actived')) {
                        correspondingDiv.classList.remove('actived');
                        nav.classList.add('actived')
                        active.classList.add('initial')
                    } else {
                        correspondingDiv.classList.add('actived')
                        nav.classList.remove('actived')
                        active.classList.remove('initial')
                    }
                }
            };
        })


    })


    navTablet.addEventListener('pointerdown', function() {
        menuButton.classList.add('activation');
    })
    closeTablet.addEventListener('pointerdown', () => {
        menuButton.classList.remove('activation');
    })

    const headerNav = document.querySelector('.desktop_contain')
    const headerLi = document.querySelectorAll('.a_a')
    const title = document.querySelector('.desktop_p')
    const title2 = document.querySelector('.desktop_p1')
    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            headerNav.classList.add("scrolled");
            title.style.color = "#FFF";
            title2.style.color = "#FFF"
            headerLi.forEach(item => {
                item.style.color = "#FFF";

            });
        } else {
            headerNav.classList.remove('scrolled')
            title.style.color = "#522b11";
            title2.style.color = "#000";
            headerLi.forEach(item => {
                item.style.color = "#000";
            });

        }
    })
</script>

</html>