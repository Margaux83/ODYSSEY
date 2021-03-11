<h1 class="titleOfPage">Ajouter une page</h1>

<section class="col-12 d-flex-column multipleSectionContainer" style="grid-column: 10 / 13; grid-row: 1;">
    <div class="sectionHeader verticalSectionMargin">
        <h1 class="titleSection">Article</h1>
        <button class="buttonComponentThin">Appercu</button>
    </div>
    <div class="col-12 multipleSection">
        <div class="sectionHeader">
            <h1 class="titleSection">Catégorie</h1>
        </div>
        <br>
        <select name="category" class="selectVerticalSection">
            <option value="Voyage">Voyage</option>
            <option value="Nature">Nature</option>
            <option value="Culture">Culture</option>
            <option value="Pays">Pays</option>
        </select>
        <br><br>
        <p class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>
    </div>
    <br>
    <div class="col-12 multipleSection">
        <div class="sectionHeader">
            <h1 class="titleSection">Page</h1>
        </div>
        <br>
        <select name="category" class="selectVerticalSection">
            <option value="Accueil">Accueil</option>
            <option value="Voyages">Voyages</option>
            <option value="Réservations">Réservations</option>
            <option value="Contact">Contact</option>
        </select>
        <br><br>
        <p class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle Page</p>
    </div>
    <br>
    <div class="col-12 multipleSection">
        <div class="sectionHeader">
            <h1 class="titleSection">Publication</h1>
        </div>
        <br>
        <select name="publication" class="selectVerticalSection">
            <option value="Tout de suite">Tout de suite</option>
            <option value="Dans 5 minutes">Dans 5 minutes</option>
            <option value="Dans 30 minutes">Dans 30 minutes</option>
            <option value="Dans 1 heure">Dans 1 heure</option>
        </select>
        <br><br>
        <p class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/clock-regular.svg")?> alt="" height="15" width="15">Choisir une heure de publication</p>
    </div>

    <div class="sectionFooter">
        <h1 class="titleSection"></h1>
        <button class="buttonComponentThin">Publier</button>
    </div>
</section>

<div id="ModalComment" class="col-6 modal">

    <!-- Modal content -->
    <div class="modal-comment">
        <span class="close">&times;</span>
        <h1>Ajout d'une description</h1>
        <form>
            <label>
                <textarea class="textareaComment" name="comment"></textarea>
            </label>
            <br><br>
            <button type="submit" class="buttonComponent" id="searchModalButton">Enregistrer</button>
        </form>
    </div>

</div>

<section class="col-12" style="grid-column: 1 / 10; grid-row: 1;">
    <div class="formTitleHeadOfPage">
        <form class="formHeadOfPage">

            <label for="title"  class="label">Veuillez choisir le titre pour votre article</label>
            <br><br>
            <input type="text" name="title" class="input">
        </form>
    </div>

    <label for="hello"></label><textarea class="trumbowygTextarea" id="hello" name="hello"></textarea>
    <label for="status" class="label">Statut</label>
    <select name="status" id="">
        <option value="Validé et posté">Validé et posté</option>
        <option value="En attente de validation">En attente de validation</option>
        <option value="Brouillon">Brouillon</option>
        <option value="Créé">Créé</option>
    </select>
    &emsp;
    &emsp;
    <label for="visibility" class="label">Visibilité</label>
    <select name="visibility" id="">
        <option value="Protégé">Protégé</option>
        <option value="Public">Public</option>
        <option value="Privé">Privé</option>
    </select>

        <button class="buttonComponent floatRight" style="float: right">Enregistrer le brouillon</button>

</section>

<script>
    $(document).ready(function(){

        $('#hello').trumbowyg({
            autogrow: true
        });
    });
</script>