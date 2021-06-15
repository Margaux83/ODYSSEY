<section>
    <h1>Connexion</h1>
</section>
<section>
    <form method="POST">
        <div class="formElement">
            <label for="login-email" class="requiredLabel">Identifiant</label>
            <input name="login-email" id="login-email" type="text" placeholder="your.email@exemple.com" required>
        </div>

        <div class="formElement">
            <label for="login-pwd" class="requiredLabel">Mot de passe</label>
            <input name="login-pwd" id="config-pwd" type="password" required>
        </div>
        <div class="formElement ">
            <p><a href="/forgotpassword" class="forget-password">Mot de passe oublié ?</a></p>
        </div>

        <div class="formSubmitElement">
            <button id="login_submit" type="submit" class="secondary" onclick="window.location='register'">S'INSCRIRE</button>
            <button id="login_submit" type="submit" class="primary">SE CONNECTER</button>
        </div>
    </form>
</section>