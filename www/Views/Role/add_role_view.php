
<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <form id="role-form" class="roles_edit" method="post" action="">

        <label>Titre du rôle</label>
        <input type="text" class="form-control" name="name" value="<?= (!empty($_GET['role']) ? $roleResult['name'] : '')?>" required><br>
        <input type="checkbox" id="selectall" name="values[]" value="1">
        <label for="">Tous sélectionner</label>

        <?php foreach($rolesList as $role => $role_data) { ?>
            <?php if(isset($role_data['title'])) { ?>
                <h3><?= $role_data['title'] ?></h3>
            <?php } ?>

            <?php foreach($role_data['values'] as $perm => $perm_data) { ?>
                <div class="form-group">
                    <input type="checkbox" id="<?= $perm ?>" name="values[<?= $perm ?>]" value="1" <?= (isset($_GET['role'])) ? ($roleClass->getPerms($perm, $_GET['role'])) ? 'checked' : ''  : ''?>>
                    <label for="<?= $perm ?>"><?= $perm_data['desc'] ?></label>
                </div>
            <?php } ?>

        <?php } ?>

        <button class="btn" type="submit">Enregistrer le role</button>
    </form>
    <button onclick="window.location='/admin/roles'">Retour</button>

</section>
<script src=<?php App\Core\View::getAssets("libraries/jquery-3.3.1.js")?>></script>

<script>
    $('#selectall').click(function() {
        $(this.form.elements).filter(':checkbox').prop('checked', this.checked);
    });
</script>