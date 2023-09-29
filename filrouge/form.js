function validerCommande(e) {
    e.preventDefault();
    var nom = document.getElementById("nom").value;
    var tel = document.getElementById("tel").value;
    var email = document.getElementById("email").value;
    var adresse = document.getElementById("adresse").value;
  
    if (
      nom === "" ||
      tel === "" ||
      email === "" ||
      adresse === ""
    ) {
      alert("Veuillez remplir tous les champs obligatoires.");
      return false;
    }
  
    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!emailRegex.test(email)) {
      alert("Veuillez entrer une adresse e-mail valide.");
      return false;
    }
  
    if (!/^[0-9]{10}/.test(tel)) {
      alert("Veuillez entrer un numéro de téléphone valide (10 chiffres).");
      return false;
    }
  
    alert("La commande a été effectuée avec succès.");
    window.location.href = "index.php";
  }
  