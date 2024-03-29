<?php $this->addModal("alert"); ?>
<section class="stepContainer">
    <div id='installer-stepElement-part-1' class="stepElement selected">
        <div class="stepStatusAndPath">
            <div id="installer-stepElement-stateIcon-part-1" class="stepStatus">
                <img src=<?php App\Core\View::getAssets("/icons/icon_plane.png")?> alt="" class="iconWhite">
            </div>
            <div class="stepPath"></div>
        </div>
        <p>Général</p>
    </div>
    <div id='installer-stepElement-part-2' class="stepElement">
        <div class="stepStatusAndPath">
            <div id="installer-stepElement-stateIcon-part-2" class="stepStatus"></div>
            <div class="stepPath"></div>
        </div>
        <p>Thèmes</p>
    </div>
    <div id='installer-stepElement-part-3' class="stepElement">
        <div class="stepStatusAndPath">
            <div id="installer-stepElement-stateIcon-part-3" class="stepStatus"></div>
            <div class="stepPath"></div>
        </div>
        <p>Base de données</p>
    </div>
    <div id='installer-stepElement-part-4' class="stepElement">
        <div class="stepStatusAndPath">
            <div id="installer-stepElement-stateIcon-part-4" class="stepStatus"></div>
            <div class="stepPath"></div>
        </div>
        <p>Utilisateur</p>
    </div>
</section>
<section>
    <div class="imgContainer" style="background-image: url(<?php App\Core\View::getAssets("/installer/img_computer.png")?>);">
    </div>
    <div class="textContainer">
        <h1 id="installer_titlePart">Bienvenue sur Odyssey</h1>
        <p id="installer_descPart">
            OdyseyCMS permet de créer rapidement de nouvelles applications pour les agences de voyages.
            Après l'installation, vous pourrez vous connecter à un panneau d'administration pour éditer la configuration de votre site Web.
        </p>
        <!--<p>
            L'URL de base est l'URL de votre site Web qui peut être lue à partir de la barre supérieure de votre navigateur.
        </p>-->
    </div>
</section>
<section>
    <form onsubmit="installer_goToNextPart()" id="formInstaller" action="/make-install" method="post">
        <div id='installer-formElementsContainer-part-1'>
            <div class="formElement">
                <label for="config-siteName" class="requiredLabel">Nom du site</label>
                <input name="config[siteName]" id="config-siteName" type="text" required>
            </div>
            <!--
            <div class="formElement">
                <label for="config-siteUrl" class="requiredLabel">URL de base</label>
                <input name="config-siteUrl" id="config-siteUrl" placeholder="www.exemple.com" type="text" required>
            </div>
            -->
            <div class="formElement">
                <label for="config-siteLanguage" class="requiredLabel">Langue</label>
                <select name="config[language]" id="config-siteLanguage" required>
                    <option value="fr">Français</option>
                    <option value="en">English</option>
                </select>
            </div>
            <!--
            <div class="formElement">
                <label for="config-siteTimeZone" class="requiredLabel">Fuseau horaire</label>
                <select name="config[siteTimeZone]" id="config-siteTimeZone" required>
                    <option value="utc0">(UTC+0)</option>
                    <option value="utc1">(UTC+1)</option>
                    <option value="utc2">(UTC+2)</option>
                    <option value="utc3">(UTC+3)</option>
                    <option value="utc4">(UTC+4)</option>
                    <option value="utc5">(UTC+5)</option>
                    <option value="utc6">(UTC+6)</option>
                    <option value="utc7">(UTC+7)</option>
                    <option value="utc8">(UTC+8)</option>
                    <option value="utc9">(UTC+9)</option>
                    <option value="utc10">(UTC+10)</option>
                    <option value="utc11">(UTC+11)</option>
                    <option value="utc12">(UTC+12)</option>
                </select>
            </div>
            -->
        </div>

        <div id='installer-formElementsContainer-part-2' class="d-none">
            <div class="formElement">
                <label for="config-siteTheme" class="requiredLabel">Thème</label>
                <select name="config[theme]" id="config-siteTheme" required>
                    <option value="theme_classic/">Par défaut (clair)</option>
                    <option value="theme_dark/">Sombre</option>
                </select>
            </div>
        </div>

        <div id='installer-formElementsContainer-part-3' class="d-none">
            <!--
            <div class="formElement">
                <label for="config-bddServerName" class="requiredLabel">Nom du serveur</label>
                <input name="config-bddServerName" id="config-bddServerName" type="text" required>
            </div>
            -->
            <!--
            <div class="formElement">
                <label for="config-bddServerPort" class="requiredLabel">Port du serveur</label>
                <input name="config-bddServerPort" id="config-bddServerPort" type="text" required>
            </div>
            -->
            <div class="formElement">
                <label for="config-bddName" class="requiredLabel">Nom de la base de données</label>
                <input name="database[dbname]" id="config-bddName" type="text" required>
            </div>

            <div class="formElement">
                <label for="config-bddHost" class="requiredLabel">Hôte de la base de données</label>
                <input name="database[dbhost]" id="config-bddHost" type="text" required>
            </div>

            <div class="formElement">
                <label for="config-bddUser" class="requiredLabel">Utilisateur</label>
                <input name="database[dbuser]" id="config-bddUser" type="text" required>
            </div>

            <div class="formElement">
                <label for="config-bddPwd" class="requiredLabel">Mot de passe</label>
                <input name="database[dbpwd]" id="config-bddPwd" type="password" required>
            </div>
            <div class="formElement">
                <label for="config-bddPrefix">Préfixe</label>
                <input name="database[dbprefix]" id="config-bddPrefix" type="text" value="ody_">
            </div>
        </div>

        <div id='installer-formElementsContainer-part-4' class="d-none">
            <div class="formElement">
                <label for="config-userAdminEmail" class="requiredLabel">Adresse mail</label>
                <input name="user[userAdminEmail]" id="config-userAdminEmail" type="text" required>
            </div>

            <div class="formElement">
                <label for="config-userAdminPwd" class="requiredLabel">Mot de passe</label>
                <input name="user[userAdminPwd]" id="config-userAdminPwd" type="password" required>
            </div>
            <!--
            <div class="formElement">
                <label for="config-userAdminPwdConfirm" class="requiredLabel">Confirmation du mot de passe</label>
                <input name="user[userAdminPwdConfirm]" id="config-userAdminPwdConfirm" type="text" required>
            </div>
            -->

            <div class="formElement">
                <label for="config-userAdminLastName" class="requiredLabel">Nom</label>
                <input name="user[userAdminLastName]" id="config-userAdminLastName" type="text" required>
            </div>

            <div class="formElement">
                <label for="config-userAdminFirstName" class="requiredLabel">Prénom</label>
                <input name="user[userAdminFirstName]" id="config-userAdminFirstName" type="text" required>
            </div>
            <div class="formElement">
                <label for="config-userAdminLastName" class="installFakeDatas">Installation avec de fausses données (pour examen)</label>
                <input name="database[fakeDatas]" id="config-userAdminLastname" type="checkbox">
            </div>
            <!--
            <div class="formElement">
                <label for="config-userAdminMail" class="requiredLabel">Prénom</label>
                <input name="config-userAdminMail" id="config-userAdminMail" type="text" required>
            </div>
            -->
        </div>

        <div class="formSubmitElement">
            <button id="installer_goBackButton" type="button" class="cancel d-none" onclick="installer_goToPreviousPart()">Retour</button>
            <button id="installer_testDb" type="button" class="primary" style="visibility:hidden" onclick="installer_checkDbConnection()">Tester la connectivité</button>
            <button id="installer_submit" type="submit" class="primary">Suivant</button>
        </div>
    </form>
</section>

<footer>
    <p>
        <span style="color: red;">*</span> Ces champs sont obligatoires pour valider l'installation de odysseyCMS.
    </p>
</footer>

<script src=<?php App\Core\View::getAssets("installer.js")?>></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        installer_elements.iconSelected = '<img src=<?php App\Core\View::getAssets("/icons/icon_plane.png")?> alt="" class="iconWhite">';
    })
</script>