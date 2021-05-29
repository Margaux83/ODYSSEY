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
    
            <div class="menu-settings" >
                <!--    <legend style="margin-top:1em;" class="menu-settings-group-name howto">Ajoutez automatiquement  des pages</legend>
                    <div class="menu-settings-input checkbox-input">
                        <input type="checkbox" name="auto-add-pages" id="auto-add-pages" value="1" /> <label for="auto-add-pages">Ajouter automatiquement les pages de premier niveau à ce menu</label>
                    </div> -->
                   <!-- <legend style="margin-top:1em;" class="">Afficher l’emplacement</legend> -->

                    <?php
                    
                    App\Core\FormBuilder::showForm($form);
                    
                    ?>  

                        
                        
            </div>
            


        </div><!-- /#post-body-content -->
    </div><!-- /#post-body -->
</section>
        
<script src=<?php App\Core\View::getAssets("charts.js")?>></script>
<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>