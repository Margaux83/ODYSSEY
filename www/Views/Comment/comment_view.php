<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_comments" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Commentaire</th>
            <th>Créateur</th>
            <th>Titre de l'article</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php
        //Récupération des informations de tous les commentaires
        foreach($allComments as $comment) { ?>
            <tr class="text-center">
                <td>
                    <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($comment["creationDate"])) ?></p>
                    <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($comment["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($comment["updateDate"])) ?></p>
                </td>
                <td>
                    <p class="listItem-cpt"><b><?= $comment["content"] ?></p>
                </td>
                <td><?= $comment["firstname"]." ".$comment["lastname"] ?></td>
                <td><?= $comment["title"] ?></td>

                <td class="action-btn">
                    <div class="listItem-cpt listActions">
                        <?php if($comment["isVerified"] == 0) {
                            //Si l'article n'est pas vérifié, on affiche un bouton pour le vérifié et un bouton pour le supprimer?>
                        <a href="#" id="verifyComment" onclick="verifyComment(this)" data-id="<?= $comment["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="deleteComment" onclick="deleteComment(this)" data-id="<?= $comment["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/times-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <?php }
                        else{
                            //Si l'article est vérifié, on affiche un bouton pour le supprimer si l'utilisateur a besoin de supprimer après sa vérification
                            ?>
                            <p style="color: #39b400">Le commentaire a été vérifié !</p>
                            <a href="#" id="deleteComment" onclick="deleteComment(this)" data-id="<?= $comment["id"] ?>">
                                <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                            </a>
                        <?php }?>
                    </div>
                </td>
            </tr>

        <?php } ?>
        </tbody>
    </table>
</section>


<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>
<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>
<script src=<?php App\Core\View::getAssets("comments.js")?>></script>