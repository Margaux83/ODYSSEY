
<h1 class="titleOfPage">Pages des Articles</h1><br>

<form action="ajouter-article">
    <button type="submit" class="buttonComponent d-flex"><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> height="15" width="15">Ajouter article</button>
</form>

<section class="col-12" style="grid-column: 1/ 13; grid-row: 1;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex"><img src=<?php App\Core\View::getAssets("icons/icon_page.png")?> alt="">Liste des articles</h1>
        <h1 id="modalButton" class="searchButtonSection">Rechercher<img class="colorSearchButton" src=<?php App\Core\View::getAssets("icons/search-solid.svg")?> alt="" ></h1>
    </div>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php for ($i=0;$i<6;$i++){?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp; 12/12/2021</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Titre de l'article</b> - Ceci est la description de l’article, elle permet à un utilisateur de savoir rapidement si le contenu
                    est intéressant ou non, il faut donc être concis et précis dans la réalisation de cette partie...</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Prénom NOM</b><br>Rôle Editeur</p>
            </div>
            <div>
                <p class="listItem-cpt">En attente de validation</p>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/tag-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="20" width="20">
                <img class="deleteArticle" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php } ?>
    </ul>
</section>

<section class="col-12" style="grid-column: 1 / 7; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Mes articles</h1>
    </div>
    <ul class="listItemBasic limit-height-900">
        <li class="legend">
            <p class="flex-weight-1">Dates</p>
            <p class="flex-weight-1">Titres et descriptions</p>
            <p class="flex-weight-1">Créateur</p>
            <p class="flex-weight-1">Status</p>
            <p class="flex-weight-1">Actions</p>
        </li>
        <?php for ($i=0;$i<4;$i++){?>
        <li class="listItem">
            <div class="listItem-cpt">
                <p><img src=<?php App\Core\View::getAssets("icons/plus-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp;  12/12/2021</p>
                <p><img src=<?php App\Core\View::getAssets("icons/check-solid.svg")?> alt="" height="15" width="15">&nbsp;&nbsp; 12/12/2021</p>
            </div>
            <div>
                <p class="listItem-cpt"><b>Titre de l'article</b></p>
            </div>
            <div>
                <p class="listItem-cpt">En attente de validation</p>
            </div>
            <div class="statsBasic">
                <div class="statisticsBasic listItem-cpt">
                    <h2 class="numberStat numberStat-positive">28</h2>
                    <p>Cette semaine</p>
                </div>
            </div>
            <div class="listItem-cpt listActions">
                <img src=<?php App\Core\View::getAssets("icons/tag-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/eye-solid.svg")?> alt="" height="20" width="20">
                <img src=<?php App\Core\View::getAssets("icons/pen-solid.svg")?> alt="" height="20" width="20">
                <img class="deleteArticle" src=<?php App\Core\View::getAssets("icons/trash-solid.svg")?> alt="" height="20" width="20">
            </div>
        </li>
        <?php } ?>
    </ul>
</section>

<section class="col-12" style="grid-column: 7 / 13; grid-row: 2;">
    <div class="sectionHeader d-flex">
        <h1 class="titleSection d-flex">Evolution du nombre de vues par articles</h1>
    </div>
    <canvas id="viewPerChart" width="775" height="400"></canvas>
</section>



<div id="myModal" class="col-6 modal">

    <!-- Modal content -->
    <div class="modal-content-Article">
        <span class="close">&times;</span>
        <h1>Recherche d'article</h1>
        <form>
            <label for="title"  class="labelModal">Titre</label>
            <input type="text" id="inputTitleArticle" name="title" class="inputModal">
            <br>

            <label for="category" class="labelModal">Catégorie</label>
            <select name="category" id="">
                <option value="Voyage">Voyage</option>
                <option value="Nature">Nature</option>
                <option value="Culture">Culture</option>
                <option value="Pays">Pays</option>
            </select>

            <label for="page" class="labelModal">Page</label>
            <select name="page" id="">
                <option value="Accueil">Accueil</option>
                <option value="Voyages">Voyages</option>
                <option value="Réservations">Réservations</option>
                <option value="Contact">Contact</option>
            </select>
            <br>

            <label for="publication" class="labelModal">Publication</label>
            <select name="publication" id="">
                <option value="Tout de suite">Tout de suite</option>
                <option value="Dans 5 minutes">Dans 5 minutes</option>
                <option value="Dans 30 minutes">Dans 30 minutes</option>
                <option value="Dans 1 heure">Dans 1 heure</option>
            </select>

            <label for="status" class="labelModal">Statut</label>
            <select name="status" id="">
                <option value="Validé et posté">Validé et posté</option>
                <option value="En attente de validation">En attente de validation</option>
                <option value="Brouillon">Brouillon</option>
                <option value="Créé">Créé</option>
            </select>
            <br>

            <label for="creator" class="labelModal">Créateur</label>
            <input type="text" name="creator" class="inputModal">
            <br>

            <label for="dateCreation" class="labelModal">Date de création</label>
            <input id="dateCreationArticle" type="date" name="dateCreation" class="inputModal">
            <br>

            <button type="submit" class="buttonComponent d-flex" id="searchModalButton">Rechercher</button>
        </form>
    </div>

</div>

<script>
    var barChartData = {
        labels: [
            "Absence of OB",
            "Closeness",
            "Credibility",
            "Heritage",
            "M Disclosure",
            "Provenance",
            "Reliability",
            "Transparency"
        ],
        datasets: [
            {
                label: "Blue",
                backgroundColor: '#155263',
                borderWidth: 1,
                data: [3, 5, 6, 7,3, 5, 6, 7]
            },
            {
                label: "Grey",
                backgroundColor: '#C4C4C4',
                borderWidth: 1,
                data: [4, 7, 3, 6, 10,7,4,6]
            }
        ]
    };

    var chartOptions = {
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    window.onload = function() {
        var ctx = document.getElementById("viewPerChart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: "bar",
            data: barChartData,
            options: chartOptions
        });
    };


    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("modalButton");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>