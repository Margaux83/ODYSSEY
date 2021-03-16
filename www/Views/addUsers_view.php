<style>
    .form-group {
        padding: 25px 25px 0px 25px;
    }
    .form-input {
        padding-bottom: 18px;
    }
    .form-input input, select {
        background: none;
        color: #000000;
        font-size: 18px;
        padding: 10px 10px 10px 15px;
        width: 490px;
        border-radius: 10px;
        border: 1px solid #c6c6c6;
    }
    .form-input label {
        padding-right: 50px;
        display: inline-block;
        width: 180px;
        text-align: left;
        font-weight: bold;
    }

    .btn-standard{
        min-width: 10rem;
        font-family: system-ui, sans-serif;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        border: 1px solid silver;
        color: white;
        margin: 0.15rem;
    }
    .btn-standard:hover{
        background-color: #3FA1BC !important;
    }
    .btn-standard.is-blue{
        background-color: #155263;
    }

    .container i {
        margin-left: -30px;
        cursor: pointer;
    }

    .checkbox-input {
        padding-bottom: 20px;
    }
</style>

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