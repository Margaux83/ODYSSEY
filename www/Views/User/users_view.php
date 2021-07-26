<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>

<section class="col-6" style="grid-column: 1 / 3; grid-row: 1 ;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">Utilisateurs</h1>
    <div class="d-flex-wrap statisticsBasicContainer" id="dashboard-section-statisticsContainer">
        <?php foreach ($statistics as $key => $statistic) {
            echo $statistic;
        } ?>
    </div>
</section>

<section class="col-12" style="grid-column: 3 / 13; grid-row: 1">
    <table id="table_all_users" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Nom et Prénom</th>
            <th>Email</th>
            <th>Status</th>
            <th>Rôle</th>
            <th>Date d'inscription</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($allUsers)){

        foreach ($allUsers as $user){

            ?>
            <tr class="text-center">
                <td>
                    <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= date("d/m/Y H:i", strtotime($user["creationDate"])) ?></p>
                    <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  <?= (empty($user["updateDate"])) ? 'Pas modifié' : date("d/m/Y H:i", strtotime($user["updateDate"])) ?></p>
                </td>
                <td>
                    <p class="listItem-cpt"><b><?= $user["firstname"] ?></b><br><?= $user["lastname"] ?></p>
                </td>
                <td>
                    <p class="listItem-cpt"><b><?= $user["email"] ?></b></p>
                </td>
                <td>
                    <?php //Mettre le statut de l'user
                    switch ($user["isVerified"]) {
                        case 0:
                            echo "Non vérifié";
                            break;
                        case 1:
                            echo "Vérifié";
                            break;
                    }
                    ?>
                </td>
                <td><?= $user['name'] ?></td>
                <td><?= date("d/m/Y H:i", strtotime($user["creationDate"])) ?></td>
                <td class="action-btn">
                    <?php if($user['id'] !== '1') { ?>
                    <div class="listItem-cpt listActions">
                        <a href="#" id="editUser" onclick="editUser(this)" data-id="<?= $user["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="deleteUser" onclick="deleteUser(this)" data-id="<?= $user["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                        </a>
                    </div>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>

        </tbody>
    </table>
</section>


<section class="col-8" style="grid-column: 1 / 7; grid-row: 2;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Evolution du nombre de connexion</h1>
    <canvas id="bar-chart" width="775" height="400"></canvas>
</section>

<section class="col-8" style="grid-column: 7 / 13; grid-row: 2;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_stat.png")?> alt="">Evolution des inscriptions</h1>
    <canvas id="line-chart" width="775" height="400"></canvas>
</section>

<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>
<script src=<?php App\Core\View::getAssets("users.js")?>></script>