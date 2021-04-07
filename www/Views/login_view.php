<section>
    <h1>Connexion</h1>
</section>
<section>
    <form onsubmit="login_tryConnect()">
        <div class="formElement">
            <label for="login-email" class="requiredLabel">Identifiant</label>
            <input name="login-email" id="login-email" type="text" placeholder="your.email@exemple.com" required>
        </div>

        <div class="formElement">
            <label for="login-pwd" class="requiredLabel">Mot de passe</label>
            <input name="login-pwd" id="config-pwd" type="text" required>
        </div>
        <div class="formElement">
            <p>Mot de passe oublié ?</p>
        </div>

        <div class="formSubmitElement">
            <button id="login_submit" type="submit" class="primary">SE CONNECTER</button>
        </div>
    </form>
</section>