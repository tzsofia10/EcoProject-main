// Navigáció betöltése
function loadNavbar() {
  fetch('html/navbar.php')
    .then(response => response.text())
    .then(data => {
      document.querySelector('.navbar').innerHTML = data;
    })
    .catch(error => console.error('Hiba a navigáció betöltésekor:', error));
}

// Footer betöltése
function loadFooter() {
  const footerDiv = document.querySelector(".footer");
  fetch("html/footer.html")
    .then(response => {
      if (!response.ok) throw new Error("Hiba a footer betöltésekor.");
      return response.text();
    })
    .then(data => {
      footerDiv.innerHTML = data;
    })
    .catch(error => console.error("Hiba a footer betöltésekor:", error));
}

// Betöltés DOMContentLoaded eseményre
document.addEventListener("DOMContentLoaded", () => {
  loadNavbar();
  loadFooter();
});
