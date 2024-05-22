// Sélection des éléments du DOM
const searchBar = document.querySelector(".search input"),
  searchIcon = document.querySelector(".search button"),
  usersList = document.querySelector(".users-list");

// Gestion du clic sur l'icône de recherche
searchIcon.onclick = () => {
  // Basculer la classe "show" sur la barre de recherche et "active" sur l'icône de recherche
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  // Mettre le focus sur la barre de recherche
  searchBar.focus();
  // Réinitialiser la valeur de la barre de recherche si elle est déjà active
  if (searchBar.classList.contains("active")) {
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
};

// Gestion de l'événement de saisie dans la barre de recherche
searchBar.onkeyup = () => {
  let searchTerm = searchBar.value;
  // Ajouter ou supprimer la classe "active" en fonction de la présence de texte dans la barre de recherche
  if (searchTerm !== "") {
    searchBar.classList.add("active");
  } else {
    searchBar.classList.remove("active");
  }

  // Création d'une requête AJAX pour la recherche d'utilisateurs
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Mise à jour de la liste des utilisateurs avec les résultats de la recherche
        let data = xhr.response;
        usersList.innerHTML = data;
      }
    }
  };
  // Configuration de l'en-tête de la requête
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // Envoi de la requête avec le terme de recherche
  xhr.send("searchTerm=" + searchTerm);
};

// Mise à jour automatique de la liste des utilisateurs toutes les 500 millisecondes
setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Mise à jour de la liste des utilisateurs si la barre de recherche n'est pas active
        let data = xhr.response;
        if (!searchBar.classList.contains("active")) {
          usersList.innerHTML = data;
        }
      }
    }
  };
  // Envoi de la requête
  xhr.send();
}, 500);
