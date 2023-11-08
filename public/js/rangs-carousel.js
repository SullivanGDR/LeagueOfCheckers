const prevButton = document.querySelector(".prev-button");
const nextButton = document.querySelector(".next-button");
const scrollContainer = document.querySelector(".scroll-container");

prevButton.addEventListener("click", () => {
scrollContainer.scrollLeft -= 432; // Ajustez la valeur de défilement à votre préférence
});

nextButton.addEventListener("click", () => {
scrollContainer.scrollLeft += 432; // Ajustez la valeur de défilement à votre préférence
});