/*-----------------------------------------------------------------------------------

 Webiste Name: Top Brand Mate
 Description: This is E-commerce website
 Author: Narola infotech

----------------------------------------------------------------------------------- */

// 01.on scroll add class 
// 02.Pre loader
// 03.Pre loader
// 01.Pre loader
// 01.Pre loader


/*=====================
01.on scroll add class 
==========================*/
const navbar = document.getElementById('header-container')

// OnScroll event handler
const onScroll = () => {

  // Get scroll value
  const scroll = document.documentElement.scrollTop

  // If scroll value is more than 0 - add class 
  if (scroll > 0) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled")
  }
}

// Use the function
window.addEventListener('scroll', onScroll);


/*=====================
02.  on scroll add class 
==========================*/
var swiper = new Swiper(".testimonials-swiper", {
  slidesPerView: 1,
  spaceBetween: 15,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  breakpoints: {

    767: {
      slidesPerView: 2,
    },
    992: {
      slidesPerView: 3,
    }
  },
});