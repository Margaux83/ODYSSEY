<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets("datatables.css")?>>
<style>
    table tbody td {
        min-width: 100px;
    }
</style>
<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <table id="table_all_roles" class="table thead-dark">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($allRoles as $role) { ?>
            <tr class="text-center">
                <td><?= $role['id'] ?></td>
                <td><?= $role['name'] ?></td>
                <td class="action-btn">
                    <div class="listItem-cpt listActions">
                        <a href="edit-role?role=<?= $role['id'] ?>" id="editPage" onclick="editPage(this)" data-id="">
                            <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="deleteRole" onclick="deleteRole(this)" data-id="<?= $role["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                        </a>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<script src=<?php App\Core\View::getAssets("datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("jquery.redirect.js")?>></script>
<script src=<?php App\Core\View::getAssets("roles.js")?>></script>