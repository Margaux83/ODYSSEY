
<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <?php
    /*
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
    $test = json_encode($_POST['values']);
    var_dump($test);
    */
    ?>
    <form id="role-form" class="roles_edit" method="post" action="">

        <label>Titre du rôle</label>
        <input type="text" class="form-control" name="name" value="<?= (!empty($_GET['role']) ? $roleResult['name'] : '')?>" required>

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