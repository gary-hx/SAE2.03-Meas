

let templateFile = await fetch('./component/NewMovieForm/template.html');
let template = await templateFile.text();


let NewMovieForm = {};

NewMovieForm.format = function(handler){
    let html= template;
    html = html.replace('{{handler}}', handler);
    return html;
}

// Fonction pour envoyer les données du formulaire au serveur
NewMovieForm.submitForm = async function(){
    let form = document.querySelector('.addMovie__form');
    let fd = new FormData(form);
    
    try {
        // Envoie la requête POST au serveur
        let response = await fetch('../server/script.php', {
            method: 'POST',
            body: fd
        });
        
        let result = await response.json();
        
        if (response.ok) {
            alert(result);
            // Réinitialise le formulaire
            form.reset();
        } else {
            alert('Erreur: ' + result);
        }
    } catch (error) {
        alert('Erreur lors de l\'envoi: ' + error);
        console.error(error);
    }
}

export {NewMovieForm};