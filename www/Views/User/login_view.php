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
    <!----<form method="POST">
        <div class="formElement">
            <label for="login-email" class="requiredLabel">Identifiant</label>
            <input name="login-email" id="login-email" type="email" placeholder="your.email@exemple.com" required>
        </div>

        <div class="formElement">
            <label for="login-pwd" class="requiredLabel">Mot de passe</label>
            <input name="login-pwd" id="login-pwd" type="password" required>
        </div>
        <div class="formElement ">
            <p><a href="/forgotpassword" class="forget-password">Mot de passe oublié ?</a></p>
        </div>

        <div class="formSubmitElement">
            <button id="login_submit" class="secondary" onclick="window.location='register'">S'INSCRIRE</button>
            <button id="login_submit" type="submit" class="primary">SE CONNECTER</button>
        </div>
    </form>---->
</section>