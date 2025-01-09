//alert("JavaScript está funcionando!");
// Selección de elementos del carrusel
const carouselSlide = document.querySelector(".carousel-slide");
const carouselItems = document.querySelectorAll(".carousel-item");
const images = document.querySelectorAll(".carousel-slide img");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

let counter = 0; //Contador que rastrea la posición actual del carrusel.
const size = images[0].clientWidth; //Ancho de la primera imagen del carrusel, utilizado para calcular el desplazamiento horizontal.

// Evento OnLoad para inicializar la página
document.addEventListener("DOMContentLoaded", () => {
  carouselItems.forEach((item) => {
    const img = item.querySelector("img");
    const description = item.querySelector(".description");

    // Ocultar la descripción al cargar la página
    description.style.display = "none";

    // Evento OnMouseOver para redimensionar la imagen
    img.addEventListener("mouseover", () => {
      img.style.transform = "scale(2)";
    });

    // Evento OnMouseOut para volver al tamaño normal
    img.addEventListener("mouseout", () => {
      img.style.transform = "scale(1)";
    });

    // Evento OnClick para mostrar la descripción
    img.addEventListener("click", () => {
      description.style.display =
        description.style.display === "none" ? "block" : "none";
    });
  });

  // Inicializar el carrusel
  initCarousel();
});

// Lógica de navegación del carrusel
//Botón siguiente
nextBtn.addEventListener("click", () => {
  if (counter >= images.length - 1) return;
  carouselSlide.style.transition = "transform 0.5s ease-in-out";
  counter++;
  carouselSlide.style.transform = "translateX(" + -size * counter + "px)";
});

//Botón anterior
prevBtn.addEventListener("click", () => {
  if (counter <= 0) return;
  carouselSlide.style.transition = "transform 0.5s ease-in-out";
  counter--;
  carouselSlide.style.transform = "translateX(" + -size * counter + "px)";
});

//Ajuste de transición
carouselSlide.addEventListener("transitionend", () => {
  if (images[counter].id === "lastClone") {
    carouselSlide.style.transition = "none";
    counter = images.length - 2;
    carouselSlide.style.transform = "translateX(" + -size * counter + "px)";
  }
  if (images[counter].id === "firstClone") {
    carouselSlide.style.transition = "none";
    counter = images.length - counter;
    carouselSlide.style.transform = "translateX(" + -size * counter + "px)";
  }
});

// Función para inicializar el carrusel (placeholder para posibles futuras inicializaciones)
function initCarousel() {
  // Lógica de inicialización aquí si es necesaria
  console.log("Página cargada, carrusel inicializado.");
}
