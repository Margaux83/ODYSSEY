<section style="grid-column: 1 / 7; grid-row: 1; padding: 10px; padding-bottom: 30px;">
    <h1>Informations générales du compte</h1>
    <?php  App\Core\Form::showForm($form); ?>
</section>

<section style="grid-column: 7 / 13; grid-row: 1; padding: 10px;">
    <h1>Modifier votre mot de passe</h1>
    <div>
        <?php  App\Core\Form::showForm($formPassword); ?>
    </div>
</section>