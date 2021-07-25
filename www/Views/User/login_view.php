<section>
    <h1>Connexion</h1>
</section>
<section>
    <?php  App\Core\Form::showForm($form); ?>
    <form method="POST">
        <div class="formElement ">
            <p><a href="/forgotpassword" class="forget-password">Mot de passe oublié ?</a></p>
        </div>
        <div class="formSubmitElement">
            <button id="login_submit" type="button" class="secondary" onclick="window.location='register'">S'INSCRIRE</button>
        </div>
    </form>
</section>