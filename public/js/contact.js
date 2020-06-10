// Selection des élmts (tous les champs, et le formulaire)
var form = $('form');
var firstNameInput = $('input[name=firstname]');
var lastNameInput = $('input[name=lastname]');
var emailInput=$('input[name=email]');
var messageTextarea = $('textarea[name=yourmessage]');

// Je détecte l'evt submit sur le form -> executer une fonction onSubmit
// A la soumission, je récupère la valeur de TOUS les champs, et les afficher dans la console

function onSubmit(event) {
    event.preventDefault();

    //on recupere les valeurs
    var firstname = firstNameInput.val();
    var lastname = lastNameInput.val();
    var email = emailInput.val();
    var message = messageTextarea.val();
    console.log(firstname);
    console.log(lastname);
    console.log(email);
    console.log(message);

    //Traitement des erreurs:

    // N°1  sur FIRSTNAME:
    if(firstname.length == 0) {
        firstNameInput.addClass('border-danger');
        alert("Vous devez renseigner un prénom");
    }
    else if (firstname.length < 2 || firstname.length > 15 ) {
        firstNameInput.addClass('border-danger');
        alert("Le prénom doit être compris et 15 car");
    }
    else {
        firstName.removeClass('border-danger');
    }


    // N°2  sur LASTNAME:
    if(lastName.length == 0) {
        firstNameInput.addClass('border-danger');
        alert("Vous devez renseigner un prénom");
    }
    else if (firstname.length < 2 || firstname.length > 15 ) {
        firstNameInput.addClass('border-danger');
        alert("Le nom doit être compris et 15 car");
    }
    else {
        firstName.removeClass('border-danger');
    }

} // Fin fonction onSubmit()

// A la soumission du formulaire
form.on('submit', onSubmit);
