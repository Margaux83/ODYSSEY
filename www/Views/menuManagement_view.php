<style>




</style>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_menu.png")?> alt="">Menu</h1>
       <!-- <a class="page-title-action" href="">Gérer avec la prévisualisation en direct</a> -->

    </div>
    <div class="manage-menus">
        <span class="first-menu-message">
			Créez votre premier menu ci-dessous.	
		</span><!-- /first-menu-message -->
    </div><!-- /manage-menus -->
</section>

<section class="col-12" style="grid-column: 1 / 5; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Ajouter des éléments de menu</h1>
    </div>
    
    
</section>


<section class="col-12" style="grid-column: 5 / 13; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Structure de menu</h1>
    </div>
    <div id="nav-menu-header">
        <div class="major-publishing-actions">
            <label class="menu-name-label" for="menu-name">Nom du menu</label>
            <input style="margin-left:30px" name="menu-name" id="menu-name" type="text" class="menu-name" required="required" value=""/>
            <div class="publishing-action">
        </div><!-- END .major-publishing-actions -->
    </div><!-- END .nav-menu-header -->
    <div id="">
        <div id="" >
            
            <p style="margin-top:30px;" class="" id="">Donnez à votre menu un nom, puis cliquez sur « Créer le menu ».</p>

            <div class="menu-settings" >
                <h3>Réglages du menu</h3>
                <!--    <legend style="margin-top:1em;" class="menu-settings-group-name howto">Ajoutez automatiquement  des pages</legend>
                    <div class="menu-settings-input checkbox-input">
                        <input type="checkbox" name="auto-add-pages" id="auto-add-pages" value="1" /> <label for="auto-add-pages">Ajouter automatiquement les pages de premier niveau à ce menu</label>
                    </div> -->
                    <legend style="margin-top:1em;" class="">Afficher l’emplacement</legend>
                        <div class="">
                            <input type="checkbox" name="menu-locations[primary]" id="locations-primary" value="0" />
                            <label for="locations-primary">Menu principal</label>
                        </div>

                        <div class="menu-settings-input checkbox-input">
                            <input type="checkbox" name="menu-locations[footer]" id="locations-footer" value="0" />
                            <label for="locations-footer">Menu secondaire</label>
                        </div>

                        <div style="margin-left:24cm">
                            <button type="submit" class="buttonComponent d-flex">Créer le menu </button>
                        </div>
                        
            </div>
            


        </div><!-- /#post-body-content -->
    </div><!-- /#post-body -->
</section>
        
<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>