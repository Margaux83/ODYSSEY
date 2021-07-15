<section>
    <h1>Mot de passe oublié</h1>
</section>
<section>
    <form method="POST">
        <div class="formElement">
            <label for="token" class="requiredLabel">Token</label>
            <input name="token" id="token" type="text" placeholder="" value="<?= isset($_GET['token']) ? $_GET['token'] : "" ?>" required>
        </div>

        <div class="formElement">
            <label for="login-pwd" class="requiredLabel">Mot de passe</label>
            <input name="password" id="config-pwd" type="password" required>
        </div>
        <div class="formElement">
            <label for="login-pwd" class="requiredLabel">Confirmer mot de passe</label>
            <input name="password-confirm" id="config-pwd" type="password" required>
        </div>

        <div class="formSubmitElement">
            <button id="forget_submit" class="secondary" onclick="window.location='forgotpassword'">RETOUR</button>
            <button id="forget_submit" type="submit" class="primary">ENVOYER</button>
        </div>
    </form>
</section>