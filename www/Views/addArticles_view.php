
<section class="col-12" style="grid-column: 1 / 10; grid-row: 1;">
    <form method="post" enctype="multipart/form-data" action="../Controllers/Article.php">
    <div class="formTitleHeadOfPage">

            <label for="title"  class="label">Veuillez choisir le titre pour votre article</label>
            <br><br>
            <input required type="text" name="title" class="input">
    </div>

    <label for="hello"></label><textarea class="trumbowygTextarea" id="hello" name="content"></textarea>
    <br>
    <label for="status" class="label">Statut</label>
    <select required name="status">
        <option value="1">Validé et posté</option>
        <option value="2">En attente de validation</option>
        <option value="3">Brouillon</option>
        <option value="4">Créé</option>
    </select>
    &emsp;
    &emsp;
    <label for="visibility" class="label">Visibilité</label>
    <select required name="visibility">
        <option value="1">Protégé</option>
        <option value="2">Public</option>
        <option value="3">Privé</option>
    </select>

        <button class="buttonComponent d-flex floatRight" style="float: right">Enregistrer le brouillon</button>

</section>

<section class="col-12 d-flex-column multipleSectionContainer" style="grid-column: 10 / 13; grid-row: 1;">
    <div class="sectionHeader verticalSectionMargin d-flex">
        <h1 class="titleSection d-flex">Article</h1>
        <button class="buttonComponentThin d-flex">Appercu</button>
    </div>
    <div class="col-12 marginBottomtMultipleSection">
        <div class="sectionHeader d-flex">
            <h1 class="titleSection d-flex">Description</h1>
        </div>
        <br>
        <p id="modalButtonAddArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Ajouter une description</p>
    </div>
    <br>
    <div class="col-12 marginBottomtMultipleSection">
        <div class="sectionHeader d-flex">
            <h1 class="titleSection d-flex">Catégorie</h1>
        </div>
        <br>
        <select required name="category" class="selectVerticalSection">
            <option value="1">Voyage</option>
            <option value="2">Nature</option>
            <option value="3">Culture</option>
            <option value="4">Pays</option>
        </select>
        <br><br>
        <p id="modalButtonAddCategoryArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>
    </div>
    <br>
    <div class="col-12 marginBottomtMultipleSection">
        <div class="sectionHeader d-flex">
            <h1 class="titleSection d-flex">Page</h1>
        </div>
        <br>
        <select required name="category" class="selectVerticalSection">
            <option value="1">Accueil</option>
            <option value="2">Voyages</option>
            <option value="3">Réservations</option>
            <option value="4">Contact</option>
        </select>
        <br><br>
    </div>
    <br>
    <div class="col-12 marginBottomtMultipleSection">
        <div class="sectionHeader d-flex">
            <h1 class="titleSection d-flex">Publication</h1>
        </div>
        <br>
        <select required name="publication" class="selectVerticalSection">
            <option value="1">Tout de suite</option>
            <option value="2">Dans 5 minutes</option>
            <option value="3">Dans 30 minutes</option>
            <option value="4">Dans 1 heure</option>
        </select>
        <br><br>
     <!--   <p class="actionVerticalSection"><img src=<?php //App\Core\View::getAssets("icons/clock-regular.svg")?> alt="" height="15" width="15">Choisir une heure de publication</p>-->
    </div>

    <div class="sectionFooter d-flex">
        <h1 class="titleSection d-flex"></h1>
        <button class="buttonComponentThin d-flex">Publier</button>
    </div>
    </form>
</section>



<div id="ModalDescAddArticle" class="col-12 modal" >
    <!-- Modal content -->
    <div class="modal-comment d-flex-wrap d-flex">
        <div class="headerForModalDesc d-flex">
            <h1 class="titleModal d-flex">Ajout d'une description</h1>
            <span class="closeComment d-flex">&times;</span>
        </div>

        <form class="d-flex d-flex-wrap">
            <textarea class="textareaComment d-flex" name="comment"></textarea>
            <button type="submit" class="buttonComponent d-flex" id="saveModalButton">Enregistrer</button>
        </form>
    </div>
</div>

<div id="ModalCategoryAddArticle" class="col-12 modal" >
    <!-- Modal content -->
    <div class="modal-comment d-flex-wrap d-flex">
        <div class="headerForModalDesc d-flex">
            <h1 class="titleModal d-flex">Ajout d'une catégorie</h1>
            <span class="closeComment d-flex">&times;</span>
        </div>

        <form class="d-flex d-flex-wrap formModalOneInput">
            <input type="text" name="title" class="inputOneModal d-flex">
            <button type="submit" class="buttonComponent d-flex" id="saveModalButton">Enregistrer</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#hello').trumbowyg({
            autogrow: true
        });
    });
</script>

<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>