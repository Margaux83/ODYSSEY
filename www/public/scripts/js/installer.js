var installer_actualPart = 1;
var installer_lastPart = 4;
var installer_Submit = null;
document.addEventListener("DOMContentLoaded", function(event) {
    installer_Submit = document.getElementById('installer_submit');
    installer_Submit.addEventListener('click', function(event) {installer_goToNextPart(event)}, false);
});

var installer_elements = {
    'part-1': {
        title: 'Bienvenue sur Odyssey',
        mainText: "<p>OdyseyCMS permet de créer rapidement de nouvelles applications pour les agences de voyages. Après l'installation, vous pourrez vous connecter à un panneau d'administration pour éditer la configuration de votre site Web.</p><p>L'URL de base est l'URL de votre site Web qui peut être lue à partir de la barre supérieure de votre navigateur.</p>"
    },
    'part-2': {
        title: 'Choisissez votre thème',
        mainText: "<p>Odyssey vous permet de personnaliser pleinement votre environnement de CMS.</p><p>Vous pouvez donc choisir un thème parmi ceux proposé ci-dessous afin de travailler avec un thème idéal selon vos envies.</p><p>D’autres thèmes vous seront mis à disposition afin de les personnaliser dans l’onglet Template de votre CMS Odyssey.</p>"
    },
    'part-3': {
        title: 'Configurez votre base de données',
        mainText: "<p>Odysey a besoin d'une base de données MySQL pour fonctionner, disponible sur la plupart des serveurs Web. Remplissez les informations d'identification fournies par votre société d'hébergement dans le formulaire.</p><p>Le champ des tables de préfixe permet de définir le préfixe ajouté au début du nom des tables. Nous vous conseillons de laisser la valeur \"ody\" (nb: un underscore sera automatiquement ajouté après le préfixe).</p>"
    },
    'part-4': {
        title: 'Créez votre compte utilisateur',
        mainText: "<p>Les champs suivants vous permettront de créer votre compte utilisateur. Ce compte aura le plein pouvoir de faire des modifications dans l'administration. Veuillez choisir soigneusement votre mot de passe.</p><p>Une fois que vous aurez cliqué sur le bouton «Lancer l'installation», Odyssey s'installera et vous pourrez vous connecter au panneau d'administration.</p>"
    }
}

function installer_goToPreviousPart(){
    document.getElementById('installer_testDb').style.visibility = 'hidden';
    if(installer_actualPart === 4) {
        document.getElementById('installer_testDb').style.visibility = 'visible';
    }
    if (installer_actualPart === 2){
        document.getElementById('installer_goBackButton').classList.add('d-none');
    }
    document.getElementById('installer_submit').innerHTML = 'Suivant';
    document.getElementById('installer-stepElement-part-' + installer_actualPart).classList.remove('selected');
    document.getElementById('installer-stepElement-stateIcon-part-' + installer_actualPart).innerHTML = '';
    document.getElementById('installer-formElementsContainer-part-' + installer_actualPart).classList.add('d-none');
    installer_loadSection(-- installer_actualPart);
}

function installer_goToNextPart(event){
    document.getElementById('installer_testDb').style.visibility = 'hidden';
    if(installer_actualPart === 2) {
        document.getElementById('installer_testDb').style.visibility = 'visible';
    }
    if(installer_actualPart < 4) {
        event.preventDefault();
    }
    if (installer_actualPart < installer_lastPart){
        document.getElementById('installer_goBackButton').classList.remove('d-none');
        document.getElementById('installer-stepElement-part-' + installer_actualPart).classList.remove('selected');
        document.getElementById('installer-stepElement-part-' + installer_actualPart).classList.add('passed');
        document.getElementById('installer-stepElement-stateIcon-part-' + installer_actualPart).innerHTML = '';
        document.getElementById('installer-formElementsContainer-part-' + installer_actualPart).classList.add('d-none');
        installer_loadSection(++ installer_actualPart);
    }
}

function installer_loadSection(index){
    if (index === installer_lastPart){
        document.getElementById('installer_submit').innerHTML = 'Lancer l\'installation';
    }
    document.getElementById('installer_titlePart').innerHTML = installer_elements['part-' + index].title;
    document.getElementById('installer_descPart').innerHTML = installer_elements['part-' + index].mainText;
    document.getElementById('installer-stepElement-stateIcon-part-' + installer_actualPart).innerHTML = installer_elements.iconSelected;
    document.getElementById('installer-formElementsContainer-part-' + index).classList.remove('d-none');
    document.getElementById('installer-stepElement-part-' + installer_actualPart).classList.remove('passed');
    document.getElementById('installer-stepElement-part-' + installer_actualPart).classList.add('selected');
}

function installer_checkDbConnection(event) {
    var bddName = document.getElementById('config-bddName').value;
    var bddHost = document.getElementById('config-bddHost').value;
    var bddUser = document.getElementById('config-bddUser').value;
    var bddPwd = document.getElementById('config-bddPwd').value;
    if(bddName.length === 0 || bddHost.length === 0 || bddUser.length === 0 || bddPwd.length === 0) {
        alert("Veuillez saisir tous les champs ci-dessus afin de tester la connectivité de la base de données !");
    } else {
        var form = $("form");
        var post_data = form.serialize();
        // Fire off the request to /installer with POST datas
        request = $.ajax({
            url: "/installer",
            type: "post",
            data: post_data
        });

        // Callback handler that will be called on success
        request.done(function (response, textStatus, jqXHR){
            // Fire a success message if database connection is correct / error message if incorrect
            if(response === "true") {
                Swal.fire(
                    'Succès',
                    'Les informations de connexion à la base de données sont correctes',
                    'success'
                )
            } else {
                Swal.fire(
                    'Erreur',
                    'Les informations de connexion à la base de données sont incorrectes',
                    'error'
                )
            }
        });
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Alert the error to the console
            alert("Erreur : " + textStatus, errorThrown);
        });


    }
}