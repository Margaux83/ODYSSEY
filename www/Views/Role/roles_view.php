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
                        <?php if($role['id'] !== "1") { ?>
                        <a href="edit-role?role=<?= $role['id'] ?>" id="editPage" onclick="editPage(this)" data-id="">
                            <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <a href="#" id="deleteRole" onclick="deleteRole(this)" data-id="<?= $role["id"] ?>">
                            <img src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
                        </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</section>

<script src=<?php App\Core\View::getAssets("libraries/datatables.js")?>></script>
<script src=<?php App\Core\View::getAssets("libraries/jquery.redirect.js")?>></script>

<script>
    $(document).ready(function() {
        $('#table_all_roles').DataTable({
        });
    });
    function deleteRole(e) {
        let id = $(e).attr("data-id");

        swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir en arrière",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, supprimer!',
            cancelButtonText: 'Non, annuler!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swal.fire(
                    'Supprimé!',
                    'Votre rôle a bien été supprimé.',
                    'success'
                ).then(function() {
                    $.post( "delete-role", { id_role: id, deleteRole: "true" })
                        .done(function( data ) {
                            location.reload();
                        });
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal.fire(
                    'Annulé',
                    'Votre rôle n\'a pas été supprimé',
                    'error'
                )
            }
        })
    }
</script>
