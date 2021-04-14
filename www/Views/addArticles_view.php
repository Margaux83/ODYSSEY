
<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">
    <form method="post" enctype="multipart/form-data" action="../Controllers/Article.php">
    <div class="formTitleHeadOfPage">

            <label for="title"  class="label">Veuillez choisir le titre pour votre article</label>
            <input required type="text" name="title" class="input">
    </div>

    <label for="hello"></label><textarea class="trumbowygTextarea" id="hello" name="content"></textarea>

            <label for="dascription" class="label">Description</label>
            <p id="modalButtonAddArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Ajouter une description</p>

            <label for="category" class="label">Catégorie</label>
            <select required name="category">
                <option value="1">Voyage</option>
                <option value="2">Nature</option>
                <option value="3">Culture</option>
                <option value="4">Pays</option>
            </select>
            <p id="modalButtonAddCategoryArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>

            <label for="page" class="label">Page</label>
            <select required name="page">
                <option value="1">Accueil</option>
                <option value="2">Voyages</option>
                <option value="3">Réservations</option>
                <option value="4">Contact</option>
            </select>

            <label for="status" class="label">Statut</label>
            <select required name="status">
                <option value="1">Validé et posté</option>
                <option value="2">En attente de validation</option>
                <option value="3">Brouillon</option>
                <option value="4">Créé</option>
            </select>
            <label for="visibility" class="label">Visibilité</label>
            <select required name="visibility">
                <option value="1">Protégé</option>
                <option value="2">Public</option>
                <option value="3">Privé</option>
            </select>

        <!-- <button class="buttonComponent d-flex floatRight" style="float: right">Enregistrer le brouillon</button>-->
        <button class="buttonComponent d-flex floatRight">Publier</button>
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