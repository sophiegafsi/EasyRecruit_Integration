
function validateForm() {
    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;
    var password = document.getElementById("password").value;
    var companyName = document.getElementById("company_name").value;
    var phone = document.getElementById("phone").value;
    
    // Validation de l'email
    if (email === "") {
        alert("Veuillez saisir une adresse e-mail.");
        return false;
    }
    // Vous pouvez ajouter d'autres validations JavaScript ici
    
    return true;
}
