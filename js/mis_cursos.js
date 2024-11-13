// mis_cursos.js

function showTab(tabId) {
    // Ocultar todos los contenidos de las pestañas
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    
    // Quitar la clase activa de todos los botones
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Mostrar el contenido de la pestaña seleccionada y marcar el botón
    document.getElementById(tabId).classList.add('active');
    document.querySelector(`button[onclick="showTab('${tabId}')"]`).classList.add('active');
}

// Establecer la pestaña "En curso" como activa al cargar la página
document.addEventListener("DOMContentLoaded", () => {
    showTab('en_curso');
});
