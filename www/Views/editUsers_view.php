<section class="col-12" style="grid-column: 1 / 13; grid-row: 1">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_comment.png")?> alt="">Liste des utilisateurs</h1>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Nom</p>
            <p class="flex-weight-1">Prénom</p>
            <p class="flex-weight-1">Email</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Rôle</p>
            <p class="flex-weight-1">Date d'inscription</p>
            <p class="flex-weight-1">Dernière connexion</p>
            <p class="flex-weight-1">Action</p>
        </li>
        <?php for ($i=0;$i<7;$i++){?>
            <li class="listItem">
                <div class="listItem-cpt">
                    <p>Martin</p>
                </div>
                <div class="listItem-cpt">
                    <p>Jean</p>
                </div>
                <div class="listItem-cpt">
                    <p>martin.jean@gmail.com</p>
                </div>
                <div class="listItem-cpt">
                    <p>Connecté</p>
                </div>
                <div class="listItem-cpt">
                    <p>Inscrit</p>
                </div>
                <div class="listItem-cpt">
                    <p>12/02/2021</p>
                </div>
                <div class="listItem-cpt">
                    <p>15/02/2021</p>
                </div>
                <div class="listItem-cpt listActions">
                    <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                </div>
            </li>
        <?php } ?>
    </ul>
</section>

<section class="col-6" style="grid-column: 1 / 13; grid-row: 2;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">Modifier un utilisateur</h1>
    <?php  App\Core\FormBuilder::showForm($form); ?>
    </form>
</section>