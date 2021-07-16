<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<form action="add-media">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter un média</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_medias" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Nom du média</th>
            <th>Média</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if(!empty($mediaInfos)){


        foreach ($mediaInfos as $media){

        ?>
                <tr class="text-center">
                    <td>
                        <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($media["creationDate"])) ?></p>
                        <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($media["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($media["updateDate"])) ?></p>
                    </td>
                    <td>
                        <p class="listItem-cpt"><?= $media["name"] ?></p>
                    </td>
                    <td>
                        <img src=<?php App\Core\View::getAssets("uploads/{$media["media"]}")?> alt="" height="50" width="50"></p>
                    </td>
                    <td class="action-btn">
                        <div class="listItem-cpt listActions">
                            <a href="">
                                <img src=<?php App\Core\View::getAssets("icons/icon-clipboard.png")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="editMedia" onclick="editMedia(this)" data-id="<?= $media["id"] ?>">
                                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                            </a>
                            <a href="#" id="deleteMedia" onclick="deleteMedia(this)" data-id="<?= $media["id"] ?>">
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


<script src=<?php App\Core\View::getAssets("media.js")?>></script>

<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>