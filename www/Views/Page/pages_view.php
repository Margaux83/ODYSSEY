<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>
<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_pages" class="table thead-dark">
        <thead>
        <tr>
            <th>Dates</th>
            <th>Titre et description</th>
            <th>Créateur</th>
            <th>Statut</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <tr class="text-center">
            <td>
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
            </td>
            <td>
                <p class="listItem-cpt"><b>Ceci est une page</b><br>Messi vs Ronaldo</p>
            </td>
            <td>Loudo M.</td>
            <td>En cours de création</td>
            <td class="action-btn">
                <a href="#">
                    <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                </a>
                <a href="#">
                    <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                </a>
                <a href="#">
                    <img class="openModalConfirmDeleteComment" data-target="ModalConfirmDeleteComment" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Mes pages</h1>
    </div>
    <ul class="listItemBasic limit-height-450">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  15/05/2021</p>

            </div>
            <div>
                <p class="listItem-cpt"><b>Ceci est une page</b><br>Messi vs Ronaldo</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Louis M.</b><br>Rôle éditeur</p>
            </div>
            <div>
                <p class="listItem-cpt">En cours de création</p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img class="openModalConfirmDeleteComment" data-target="ModalConfirmDeleteComment" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
    </ul>
</section>
<section class="col-12" style="grid-column: 7 / 13; grid-row: 2;">
    <h1>Données du site</h1>
    <canvas id="dataChart" width="200" height="200"></canvas>
</section>

<script src=<?php App\Core\View::getAssets("jquery-3.3.1.js")?>></script>
<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>

<script>
    $(document).ready(function() {
        $('#table_all_pages').DataTable({

        });
    } );
</script>

