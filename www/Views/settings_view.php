<section class="col-8" style="grid-column: 1 / 8; grid-row: 1;">
    <?php if(!empty($formErrors)):?>
    <?php foreach($formErrors as $error):?>
    <li><?= $error ;?>
        <?php endforeach;?>
        <?php endif;?>

        <?php  App\Core\FormBuilderWYSWYG::showFormSettings($form); ?>
</section>
<!--
<section class="col-8" style="grid-column: 1 / 8; grid-row: 2;">
    <h1>Informations du site</h1>
    <form action="#" method="post" class="form-group">
        <div class="form-input">
            <label>Titre</label>
            <input type="text" name="titre">
        </div>
        <div class="form-input">
            <label>Slogan</label>
            <input type="text" name="slogan">
        </div>
        <div class="form-input">
            <label>Langue du site</label>
            <select name="language" id="language-select">
                <option value="">Français (fr_FR)</option>
            </select>
        </div>
        <div class="form-input">
            <label>Rôle par défaut</label>
            <select name="role" id="role-select">
                <option value="">Inscrit</option>
            </select>
        </div>
        <div class="form-input">
            <label>Fuseau horaire</label>
            <select name="timezone" id="timezone-select">
                <option value="">(UTC+01:00) Paris</option>
            </select>
        </div>
        <button type="submit" class="btn-standard is-blue">Enregistrer</button>
    </form>
</section>
<section class="col-8" style="grid-column: 1 / 8; grid-row: 3;">
    <h1>Informations d'adresses</h1>
    <form action="#" method="post" class="form-group">
        <div class="form-input">
            <label>Adresse web d'ODYSSEY</label>
            <input type="text" name="address_odyssey">
        </div>
        <div class="form-input">
            <label>Adresse web du site</label>
            <input type="text" name="address_site">
        </div>
        <div class="form-input">
            <label>Adresse de messagerie</label>
            <input type="text" name="address_messagerie">
        </div>
        <button type="submit" class="btn-standard is-blue">Enregistrer</button>
    </form>
</section>
-->
<section class="col-12" style="grid-column: 8 / 13; grid-row: 1;">
    <h1>Données du site</h1>
    <canvas id="dataChart" width="400" height="400"></canvas>
</section>
