<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>
<section class="col-12" style="grid-column: 1/ 7; grid-row: 1;">
<h1>Ajouter une catégorie</h1>
    <?php  App\Core\Form::showForm($formCategory); ?>
</section>
<section class="col-12" style="grid-column: 7/ 13; grid-row: 1;">
    <table id="table_all_categories" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Catégorie</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($listCategories)){

            foreach ($listCategories as $category){

            ?>
        <tr class="text-center">
            <td>
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($category["creationDate"])) ?></p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($category["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($category["updateDate"])) ?></p>
            </td>
            <td>
                <p class="listItem-cpt"><b><?= $category["label"] ?></p>
            </td>
            <td class="action-btn">
                <div class="listItem-cpt listActions">
                    <a href="#" id="editArticle" onclick="editArticle(this)" data-id="<?= $category["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                    </a>
                    <a href="#" id="deleteArticle" onclick="deleteArticle(this)" data-id="<?= $category["id"] ?>">
                        <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                    </a>
                </div>
            </td>

        </tr>
        <?php } ?>
        <?php } ?>

        </tbody>
    </table>
</section>

<script src=<?php App\Core\View::getAssets("category.js")?>></script>
<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>