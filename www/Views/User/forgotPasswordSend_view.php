<section>
    <h1>Mot de passe oublié</h1>
</section>
<section>
    <?php  App\Core\Form::showForm($form); ?>
    <form method="POST">
        <div class="formSubmitElement">
            <button id="login_submit" type="button" class="secondary" onclick="window.location='login'">RETOUR</button>
        </div>
    </form>
</section>