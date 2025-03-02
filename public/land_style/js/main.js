// Initialize PureCounter
new PureCounter();

// Initialize GLightBox
const lightbox = GLightbox({
  selector: '.glightbox',
  openEffect: 'zoom',
  closeEffect: 'fade',
  slideEffect: 'slide',
  moreLength: 60,
  autoplayVideos: true,
});

// Initialize AOS animation library
AOS.init({
  duration: 800,
  easing: 'ease-in-out',
  once: true
});

// Mobile menu toggle
const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

menuToggle.addEventListener('click', function() {
  this.classList.toggle('active');
  navLinks.classList.toggle('active');
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
  const navbar = document.querySelector('.navbar');
  if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
  } else {
      navbar.classList.remove('scrolled');
  }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Close mobile menu if open
      menuToggle.classList.remove('active');
      navLinks.classList.remove('active');
      
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
          window.scrollTo({
              top: targetElement.offsetTop - 80,
              behavior: 'smooth'
          });
      }
  });
});