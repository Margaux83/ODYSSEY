
<section class="col-12" style="grid-column: 1 / 13; grid-row: 2;">

    <p id="modalButtonAddCategoryArticle" class="actionVerticalSection"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">Créer une nouvelle catégorie</p>
</section>

<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">
    <?php if(!empty($formErrors)){?>
    <?php foreach($formErrors as $error):?>
            <div class="error"><?= $error ;?></div>

        <?php endforeach;?>
    <?php } else { //?>

    <?php } ?>
        <?php  App\Core\FormBuilderWYSWYG::showFormArticle($form); ?>
</section>




<div id="ModalCategoryAddArticle" class="col-12 modal">
    <!-- Modal content -->
    <div class="modal-comment d-flex-wrap d-flex">
        <div class="headerForModalDesc d-flex">
            <h1 class="titleModal d-flex">Ajout d'une catégorie</h1>
            <span class="closeComment d-flex">&times;</span>
        </div>

        <form class="d-flex d-flex-wrap formModalOneInput" action="" method="post">
            <input type="text" name="addcategory" class="inputOneModal d-flex">
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