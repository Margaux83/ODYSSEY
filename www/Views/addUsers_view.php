<section class="col-6" style="grid-column: 1 / 12; grid-row: 1 ;">
    <h1 class="titleSection"><img src=<?php App\Core\View::getAssets("icons/icon_user.png")?> alt="">Ajout d'un utilisateur</h1>
    <form action="#" method="post" class="form-group">
        <div class="form-input">
            <label>Identifiant</label>
            <input type="text" name="id">
        </div>
        <div class="form-input">
            <label>Adresse email</label>
            <input type="text" name="email">
        </div>
        <div class="form-input">
            <label>Nom</label>
            <input type="text" name="name">
        </div>
        <div class="form-input">
            <label>Prénom</label>
            <input type="text" name="firstname">
        </div>
        <div class="form-input">
            <label>Numéro de téléphone</label>
            <input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        </div>
        <div class="form-input">
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-input">
            <label>Rôle par défaut</label>
            <select name="role" id="role-select">
                <option value="">Inscrit</option>
            </select>
        </div>
        <div class="checkbox-input">
            <input type="checkbox" id="verification" name="verification" value="verification">
            <label for="verification">Envoyer un mail au nouvel utilisateur pour le prévenir de la création de son compte</label>
        </div>
        <button type="submit" class="btn-standard is-blue">Enregistrer</button>
    </form>
</section>