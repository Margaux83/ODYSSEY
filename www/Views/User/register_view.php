
<section>
    <h1>Inscription</h1>
</section>
<section>
    <form method="POST">
        <div class="formElement">
            <label for="name" class="requiredLabel">Nom</label>
            <input name="lastname" id="name" type="text" placeholder="Votre nom" required>
        </div>
        <div class="formElement">
            <label for="firstname" class="requiredLabel">Prénom</label>
            <input name="firstname" id="firstname" type="text" placeholder="Votre prénom" required>
        </div>
        <div class="formElement">
            <label for="email" class="requiredLabel">Adresse Mail</label>
            <input name="email" id="email" type="email" placeholder="your.email@exemple.com" required>
        </div>
        <div class="formElement">
            <label for="password" class="requiredLabel">Mot de passe</label>
            <input name="password" id="password" type="password" required>
        </div>
        <div class="formElement">
            <label for="password-confirm" class="requiredLabel">Confirmer mot de passe</label>
            <input name="password-confirm" id="password-confirm" type="password" required>
        </div>
        <div class="formElement">
            <label for="firstname" class="requiredLabel">Téléphone</label>
            <input name="phone" id="firstname" type="text" placeholder="Votre numéro de téléphone" required>
        </div>
        <div class="formSubmitElement">
            <button id="login_submit" type="submit" class="secondary" onclick="window.location='login'">SE CONNECTER</button>
            <button id="login_submit" type="submit" class="primary">S'INSCRIRE</button>
        </div>
    </form>
</section>
