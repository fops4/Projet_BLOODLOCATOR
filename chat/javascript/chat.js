// Sélection des éléments du DOM
const form = document.querySelector(".typing-area"),
  incoming_id = form.querySelector(".incoming_id").value,
  inputField = form.querySelector(".input-field"),
  sendBtn = form.querySelector("button"),
  chatBox = document.querySelector(".chat-box");

// Empêcher la soumission du formulaire par défaut
form.onsubmit = (e) => {
  e.preventDefault();
};

// Focus sur le champ de saisie lorsque la page est chargée
inputField.focus();

// Activer ou désactiver le bouton d'envoi en fonction de la présence de texte dans le champ de saisie
inputField.onkeyup = () => {
  if (inputField.value !== "") {
    sendBtn.classList.add("active");
  } else {
    sendBtn.classList.remove("active");
  }
};

// Gestion de l'envoi du message
sendBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/insert-chat.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Effacer le champ de saisie après l'envoi
        inputField.value = "";
        // Faire défiler jusqu'au bas de la boîte de chat
        scrollToBottom();
      }
    }
  };
  // Création d'un objet FormData pour envoyer les données du formulaire
  let formData = new FormData(form);
  xhr.send(formData);
};

// Gestion des événements lorsque la souris entre ou sort de la boîte de chat
chatBox.onmouseenter = () => {
  chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove("active");
};

// En dehors de la fonction setInterval
let xhr = new XMLHttpRequest();

// À l'intérieur de la fonction setInterval
setInterval(() => {
    // Annuler la requête précédente si elle est en cours
    xhr.abort();

    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Mettre à jour le contenu de la boîte de chat
            let data = xhr.response;
            chatBox.innerHTML = data;
            scrollToBottom();

            // Ajouter cette partie pour afficher l'heure
            let timeElementsOutgoing = chatBox.querySelectorAll('.outgoing .time');
            let timeElementsIncoming = chatBox.querySelectorAll('.incoming .time-t');

            timeElementsOutgoing.forEach((timeElement, index) => {
                timeElement.textContent = timeElementsOutgoing[index].textContent;
            });

            timeElementsIncoming.forEach((timeElement, index) => {
                timeElement.textContent = timeElementsIncoming[index].textContent;
            });

            // Faire défiler jusqu'au bas de la boîte de chat si elle n'est pas active
            if (!chatBox.classList.contains("active")) {
                scrollToBottom();
            }
        }
    };

    // Configuration de l'en-tête de la requête
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Envoi de la requête avec l'ID entrant
    xhr.send("incoming_id=" + incoming_id);
}, 500);


// Fonction pour faire défiler jusqu'au bas de la boîte de chat
function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}

