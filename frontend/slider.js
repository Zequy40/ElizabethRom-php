
document.addEventListener('DOMContentLoaded', function () {
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

// Espera a que todas las imágenes se carguen antes de iniciar el slider
window.addEventListener('load', function () {
    // Ahora el script de slider se ejecutará después de que todas las imágenes estén cargadas
    document.dispatchEvent(new Event('DOMContentLoaded'));
});

const menuButton = document.querySelector('#menuNav');
const nav = document.querySelector('#menu');

const icons = document.querySelectorAll(".footer_icon");
const active = document.querySelector(".footer_iconMenu")

// Agrega un evento de clic al botón del menú
nav.addEventListener('pointerdown', function () {
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

const cart = document.querySelector('#addToCart')
const user = document.querySelector('.user-account')
const close = document.querySelector('#close-account')
cart.addEventListener('click', () => {
    cart.style.pointerEvents = "none";
    user.classList.add("active")
    
})
close.addEventListener('pointerdown', () => {
    user.classList.remove('active')
    cart.style.pointerEvents = "auto";
})

const navTablet = document.querySelector('.menuTablet');

    const closeTablet = document.querySelector('#close');
  




