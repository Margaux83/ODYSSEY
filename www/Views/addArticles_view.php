
<section class="col-12" style="grid-column: 1 / 6; grid-row: 2;">
    <p id="modalButtonAddArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Ajouter une description</p>

</section>
<section class="col-12" style="grid-column: 7 / 13; grid-row: 2;">

    <p id="modalButtonAddCategoryArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>
</section>
<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">

    <?php if(!empty($formErrors)):?>
    <?php foreach($formErrors as $error):?>
    <li><?= $error ;?>
        <?php endforeach;?>
        <?php endif;?>

        <?php  App\Core\FormBuilderArticle::showFormArticle($form); ?>
</section>



<div id="ModalDescAddArticle" class="col-12 modal" >
    <!-- Modal content -->
    <div class="modal-comment d-flex-wrap d-flex">
        <div class="headerForModalDesc d-flex">
            <h1 class="titleModal d-flex">Ajout d'une description</h1>
            <span class="closeComment d-flex">&times;</span>
        </div>

        <form class="d-flex d-flex-wrap formModalOneInput" >
            <label>
                <textarea class="textareaComment d-flex" name="comment"></textarea>
            </label>
            <button type="submit" class="buttonComponent d-flex" id="saveModalButton">Enregistrer</button>
        </form>
    </div>
</div>

<div id="ModalCategoryAddArticle" class="col-12 modal">
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

        $('#content').trumbowyg({
            autogrow: true
        });
    });
</script>

<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>