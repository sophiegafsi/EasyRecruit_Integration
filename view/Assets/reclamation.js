// Fonction pour vérifier si le texte contient des chiffres
  function hasNumber(text) {
      return /\d/.test(text);
  }
  function correctmail(text) {
    // Expression régulière pour vérifier le format d'un e-mail
    var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    // Vérifie si la chaîne de texte correspond à l'expression régulière
    if(regex.test(text)) {
        return true; // L'e-mail est valide
    } else {
        return false; // L'e-mail est invalide
    }
}


  // Sélection du formulaire et du message
  const form = document.getElementById('contact-form');
  const messageDiv = document.getElementById('message');

  // Ajout d'un écouteur d'événements pour le formulaire
  form.addEventListener('submit', function(event) {
        alert("dormulaire soumis");
      event.preventDefault(); // Empêche la soumission du formulaire par défaut

      // Récupération des valeurs du nom et du prénom
      const nom = document.getElementById('nom').value;
      const prenom = document.getElementById('prenom').value;
      const mail=document.getElementById('mail').value;

      // Sélection des éléments pour les messages d'erreur
      const nomError = document.getElementById('nomError');
      const prenomError = document.getElementById('prenomError');
      const mailError = document.getElementById('emailError');

      // Vérification si le nom ou le prénom contient des chiffres
      if (hasNumber(nom)) {
          nomError.textContent = "Nom incorrect";
      } else {
          nomError.textContent = ""; // Efface le message d'erreur
      }

      if (hasNumber(prenom)) {
          prenomError.textContent = "Prénom incorrect";
      } else {
          prenomError.textContent = ""; // Efface le message d'erreur
      }
      if(correctmail(mail)){
        mailError.textContent="";
      }
      else
      {
        mailError.textContent="mail incorrect";
      }

      return false; // Empêche la soumission du formulaire
  });