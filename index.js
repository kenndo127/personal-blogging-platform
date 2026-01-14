// Carousel Section
const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slide').length;
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

let index = 0;

function showSlide() {
  slides.style.transform = `translateX(-${index * 100}%)`;
}

nextBtn.addEventListener('click', () => {
  index++;

  if (index >= totalSlides) {
    index = 0;
  }

  showSlide();
});

prevBtn.addEventListener('click', () => {
  index--;

  if (index < 0) {
    index = totalSlides - 1;
  }

  showSlide();
});
