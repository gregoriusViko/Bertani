// File: js/carousel.js
let currentSlide = 0;
const slides = document.querySelectorAll("#carouselSlides > div");
const totalSlides = slides.length;

function updateCarousel() {
    const carousel = document.getElementById("carouselSlides");
    carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
    document.querySelectorAll(".dot").forEach((dot, index) => {
        dot.classList.toggle("bg-gray-800", index === currentSlide);
        dot.classList.toggle("bg-gray-400", index !== currentSlide);
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateCarousel();
}

function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

function goToSlide(slideIndex) {
    currentSlide = slideIndex;
    updateCarousel();
}

// Auto-slide every 3 seconds
setInterval(nextSlide, 4000);
