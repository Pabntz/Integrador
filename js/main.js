window.onscroll = function() {
  stickyHeader();
};

function stickyHeader() {
  // Selecciona el header
  var header = document.querySelector("header");
  // Obtiene la posición actual de scroll
  var sticky = header.offsetTop;

  // Cuando se scrollea, añade la clase 'sticky' al header
  if (window.pageYOffset > sticky) {
      header.classList.add("sticky");
  } else {
      // Si vuelve a la parte superior, remueve la clase 'sticky'
      header.classList.remove("sticky");
  }
}

function toggleAside() {
  var aside = document.getElementById("menuAside");
  aside.classList.toggle("open");
}

function toggleUserMenu() {
  var menu = document.getElementById("userMenu");
  menu.classList.toggle("show");
}

// Cierra el menú si se hace clic fuera de él
window.onclick = function(event) {
  if (!event.target.matches('.user-icon')) {
      var dropdowns = document.getElementsByClassName("user-dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
          }
      }
  }
}

// Carrusel de noticias
let currentIndex = 0;
const newsItems = document.querySelectorAll('.news-item');

function showNewsItem(index) {
  newsItems.forEach((item, i) => {
      item.classList.remove('active');
      if (i === index) {
          item.classList.add('active');
      }
  });
}

function rotateNews() {
  currentIndex = (currentIndex + 1) % newsItems.length;
  showNewsItem(currentIndex);
}

// Mostrar la primera noticia y empezar la rotación
showNewsItem(currentIndex);
setInterval(rotateNews, 4000); // Cambia cada 4 segundos
