<section>
    <h1>Créer nouveau mot de passe</h1>
</section>
<section>
    <?php  App\Core\Form::showForm($form); ?>
    <form method="POST">
        <div class="formSubmitElement">
            <button id="login_submit" type="button" class="secondary" onclick="window.location='forgotpassword'">RETOUR</button>
        </div>
    </form>
</section>