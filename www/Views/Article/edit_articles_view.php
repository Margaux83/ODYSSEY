<script src='https://cdn.tiny.cloud/1/sfgeuuulhp5vmw2y9c0fo94ydvh7zpah75c6trahqaw5g1y7/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script src=<?php App\Core\View::getAssets("fr_FR.js")?>></script>
<script src=<?php App\Core\View::getAssets("tinymce_editor.js")?>></script>

   <section class="col-12" style="grid-column: 1 / 13; grid-row: 2;">
           <?php  App\Core\Form::showForm($form); ?>
   </section>

   <br><br>

   <div id="myModal" class="col-12 modal">

       <!-- Modal content -->
       <div class="modal-content-Article d-flex-wrap" style="flex-grow: 1">
           <div>
               <div class="headerForModalSearch d-flex">
                   <h1 class="titleModal d-flex">Recherche d'article</h1>
                   <span class="close d-flex">&times;</span>
               </div>
               <br><br>

               <form class="d-flex d-flex-wrap">
                   <div class="d-flex divformModal d-flex-wrap">
                       <label for="title"  class="labelModal ">Titre</label>
                       <input type="text" name="title">
                       <br>
                       <label for="creator" class="labelModal ">Créateur</label>
                       <input type="text" name="creator">
                       <br>
                       <label for="dateCreation" class="labelModal">Date de création</label>
                       <input id="dateCreationArticle" type="date" name="dateCreation">
                   </div>
                   <div class="d-flex divformModal d-flex-wrap">
                       <label for="category" class="labelModal d-flex">Catégorie</label>
                       <select name="category" id="">
                           <option value="1">Voyage</option>
                           <option value="2">Nature</option>
                           <option value="3">Culture</option>
                           <option value="4">Pays</option>
                       </select>
                       <br>
                       <label for="page" class="labelModal d-flex">Page</label>
                       <select name="page" id="">
                           <option value="1">Accueil</option>
                           <option value="2">Voyages</option>
                           <option value="4">Réservations</option>
                           <option value="3">Contact</option>
                       </select>
                   </div>
                   <br>

                   <div class="d-flex divformModal d-flex-wrap">
                       <label for="publication" class="labelModal d-flex">Publication</label>
                       <select name="publication" id="">
                           <option value="1">Tout de suite</option>
                           <option value="2">Dans 5 minutes</option>
                           <option value="3">Dans 30 minutes</option>
                           <option value="4">Dans 1 heure</option>
                       </select>
                       <br>
                       <label for="status" class="labelModal d-flex">Statut</label>
                       <select name="status" id="">
                           <option value="1">Validé et posté</option>
                           <option value="2">En attente de validation</option>
                           <option value="3">Brouillon</option>
                           <option value="4">Créé</option>
                       </select>
                   </div>

                   <button type="submit" class="buttonComponent d-flex" id="searchModalButton">Rechercher</button>
               </form>
           </div>
       </div>
   </div>



<div id="ModalConfirmDeleteArticle" class="col-12 modal">
    <div class="modal-deleteArticle d-flex-wrap d-flex">
        <div class="success-checkmark d-flex">
            <div class="check-icon d-flex">
                <img src=<?php App\Core\View::getAssets("icons/exclamation-solid.svg")?> alt="" height="50" width="50">
            </div>
        </div>
        <div class="deleteConfirmation d-flex d-flex-wrap">
            <p>Etes-vous sûr(e) de vouloir supprimer cet article ?</p>
        </div>
        <br>

        <div class="footerDeleteArticleModal d-flex d-flex-wrap">

            &emsp;
            <button class="buttonComponent">Oui, je supprime</button>
            &emsp;
            <button class="buttonComponent-alert closeModalDelete">Annuler</button>
        </div>
    </div>
</div>

   <script src=<?php App\Core\View::getAssets("modal.js")?>></script>
   <script src=<?php App\Core\View::getAssets("popups.js")?>></script>
<script src=<?php App\Core\View::getAssets("article.js")?>></script>

   <script>
       $("#title").keyup(function(){
           update();
       });
       function update() {
           let value = $('#title').val().replace(/[^a-z0-9\w\d]+/g, "-");
           $("#uri").val(value.toLowerCase());
       }
   </script>