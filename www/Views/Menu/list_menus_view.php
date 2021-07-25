<section style="grid-column: 1 / 13; grid-row: 1;">
    <label for="ody_selectMenu">Sélectionner un menu pour le modifier</label>
    <div class="formContainer" style="margin-top: 5px; margin-bottom: 10px;">
        <div class="formElement" style="margin: 0;">
            <select id="ody_selectMenu" onchange="ody_changeMenuSelected(this)">
                <option value=''>Créer un menu</option>
                <?php
                    foreach ($menus as $key => $menu) {
                        echo '<option value="'.$menu['id'].'">'.$menu['name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</section>

<section id="ody_displayMenuElementsContainer" class="col-4" style="grid-column: 1 / 5; grid-row: 2;">
    <h1 class="titleSection">Afficher des éléments au menu</h1>

    <ul class="multiList">
        <li id="ody_pagesList" class="listHiddable">
            <h2 class="listTitle" onclick="document.getElementById('ody_pagesList').classList.toggle('hidden')">Pages</h2>
            <ul class="checkList">
                <?php
                    foreach ($pages as $key => $page) {
                        echo '<li id="ody_page_'.$page['id'].'">'
                            .'<input onchange="ody_toggleMenuObject(\''.$page['id'].'\', \'Page\')" id="ody_menuChecklist_page_'.$page['id'].'" type="checkbox">'
                            .'<div class="checklistContent">'
                                . '<label for="ody_menuChecklist_page_'.$page['id'].'">'.$page['title'].'</label>'
                            .'</div>'
                        .'</li>';
                    }
                ?>
            </ul>
        </li>
        <li id="ody_articlesList" class="listHiddable hidden">
            <h2 class="listTitle" onclick="document.getElementById('ody_articlesList').classList.toggle('hidden')">Articles</h2>
            <ul class="checkList">
                <?php
                    foreach ($articles as $key => $article) {
                        echo '<li id="ody_article_'.$article['id'].'">'
                            .'<input onchange="ody_toggleMenuObject(\''.$article['id'].'\', \'Article\')" id="ody_menuChecklist_article_'.$article['id'].'" type="checkbox">'
                            .'<div class="checklistContent">'
                                . '<label for="ody_menuChecklist_article_'.$article['id'].'">'.$article['title'].'</label>'
                            .'</div>'
                        .'</li>';
                    }
                ?>
            </ul>
        </li>
    </ul>
</section>

<section id="ody_structureMenuContainer" class="col-8" style="grid-column: 5 / 13; grid-row: 2;">
    <h1 class="titleSection">Structure du menu</h1>
    <?php  App\Core\Form::showForm($formMenuCreation);?>
</section>

<script>
    var lastSelectedMenuId = '';
    var menus = [<?php 
        foreach ($menus as $key => $menu) {
            echo "{
                'id': \"".$menu['id']."\",
                'name': \"".$menu['name']."\",
                'contentMenu': '".$menu['contentMenu']."',
            },";
        }?>];
    
    var pages = [<?php
        foreach ($pages as $key => $page) {
            echo "{
                'id': \"".$page['id']."\",
                'title': \"".$page['title']."\",
                'uri': \"".$page['uri']."\"
            },";
        }
    ?>];
    var articles = [<?php 
        foreach ($articles as $key => $article) {
            echo "{
                'id': \"".$article['id']."\",
                'title': \"".$article['title']."\",
                'uri': \"".$article['uri']."\"
            },";
        }
    ?>];

    var selectedMenuId = '';
    var actualMenu = [];

    function ody_changeMenuSelected(selectInfos) {
        selectedMenuId = document.getElementById('ody_selectMenu').value;
        actualMenu = [];
        ody_cleanMenuElements();

        if (selectedMenuId) {
            ody_showMenuDataWithId(selectedMenuId);
        }else {
            document.getElementById("ody_inputContainer_contentMenu").innerHTML = `<input id="contentMenu" name="contentMenu" type="hidden" placeholder="">`;
            document.getElementById("submitButton").innerHTML = 'Créer le menu';
            ody_showMenuData();

            document.getElementById('id').value = selectedMenuId;
            document.getElementById('name').value = selectedMenuId 
                ? selectInfos.options[selectInfos.selectedIndex].text
                : '';

            lastSelectedMenuId = selectedMenuId;
        }
    }

    function ody_cleanMenuElements() {
        pages.forEach(function(page) {
            document.getElementById(`ody_menuChecklist_page_${page.id}`).checked = false;
        });
        articles.forEach(function(article) {
            document.getElementById(`ody_menuChecklist_article_${article.id}`).checked = false;
        });
    }

    function ody_toggleMenuObject(idObject, typeObject) {
        var alreadyPresent = actualMenu.filter(function(menu) {
            return menu.id === idObject && menu.object === typeObject;
        })

        if (alreadyPresent.length) {
            ody_removeMenuObject(idObject, typeObject);
        }else {
            actualMenu.push({
                'id': idObject,
                'object': typeObject,
                'order': '100'
            });
            ody_loadMenuData(actualMenu);
        }
    }

    function ody_removeMenuObject(idObject, typeObject) {
        document.getElementById(`ody_menuChecklist_${typeObject.toLowerCase()}_${idObject}`).checked = false;
        actualMenu = actualMenu.filter(function(menu) {
            return !(menu.id === idObject && menu.object === typeObject);
        });
        ody_loadMenuData(actualMenu);
    }

    function ody_loadMenuData(dataContentMenu) {
        const contentSelectedMenu = dataContentMenu.sort(function(a, b) {
            return parseInt(a.order) - parseInt(b.order);
        });
        let htmlContentSelectedMenu = [];
        contentSelectedMenu.forEach(function(contentSelected) {
            var selectedObject = '';
            switch (contentSelected.object) {
                case 'Page':
                    selectedObject = pages.filter(function(page) { 
                        return page.id === contentSelected.id 
                    })[0];
                    break;
                case 'Article':
                    selectedObject = articles.filter(function(article) { 
                        return article.id === contentSelected.id 
                    })[0];
                    break;
                default:
                    break;
            }
            if (selectedObject) {
                document.getElementById(`ody_menuChecklist_${contentSelected.object.toLowerCase()}_${contentSelected.id}`).checked = true;
                htmlContentSelectedMenu.push(`<li id="${contentSelected.id}" draggable="true">
                    <article class="menuManagementListContent">
                        <p>${selectedObject.title}</p>
                        <p>${contentSelected.object} : ${selectedObject.uri}</p>
                    </article>
                    <img onclick="ody_removeMenuObject(\'${contentSelected.id}\', \'${contentSelected.object}\')" src=<?php App\Core\View::getAssets("icons/times-solid.svg")?> alt="Supprimer"/>
                </li>`);
            }else {
                console.log(contentSelected);
            }
        });

        ody_showMenuData(htmlContentSelectedMenu);
        document.getElementById('contentMenu').value = JSON.stringify(dataContentMenu);
    }

    function ody_showMenuData(dataContentMenu = []) {
        document.getElementById("ody_inputContainer_contentMenu").innerHTML = `<input id="contentMenu" name="contentMenu" type="hidden" placeholder="">
            <p style="margin: 10px 0 5px 0">Contenu du menu</p>
            <ul class="menuManagementList">
                <li>
                    <div class="menuManagementListContent">
                        <p>Accueil</p>
                        <p>Page obligatoire : /home</p>
                    </div>
                </li>
            </ul>
            <ul id="menuManagementList" class="menuManagementList">
                ${dataContentMenu.join('\n')}
            </ul>
            <ul class="menuManagementList">
                <li>
                    <div class="menuManagementListContent">
                        <p>Contact</p>
                        <p>Page obligatoire : /contact</p>
                    </div>
                </li>
            </ul>`;

        ody_addDraggableMenuElements();
    }

    function ody_showMenuDataWithId(idMenu = null) {
        if (!idMenu) {
            ody_showMenuData();
            return;
        }

        menus.forEach(function(menu) {
            if (menu.id == idMenu) {
                actualMenu = JSON.parse(menu['contentMenu']);
                ody_loadMenuData(actualMenu);
                document.getElementById('id').value = idMenu;
                document.getElementById('name').value = menu.name;

                lastSelectedMenuId = selectedMenuId;
                document.getElementById("submitButton").innerHTML = 'Enregistrer';
                document.getElementById('ody_selectMenu').value = idMenu;
            }
        });
    }

    var ody_lastDragElement = null;

    function ody_handleDragStart(e) {
        ody_lastDragElement = this;

        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', this.outerHTML);
        
        this.classList.add('dragElem');
    }

    function ody_handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        this.classList.add('over');

        e.dataTransfer.dropEffect = 'move';

        return false;
    }

    function ody_handleDragLeave(e) {
        this.classList.remove('over');
    }

    function ody_handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (ody_lastDragElement != this) {
            this.parentNode.removeChild(ody_lastDragElement);
            var dropHTML = e.dataTransfer.getData('text/html');
            this.insertAdjacentHTML('beforebegin',dropHTML);
            var dropElem = this.previousSibling;
            ody_addDraggableEffet(dropElem);
        }
        ody_lastDragElement.classList.remove('dragElem');
        this.classList.remove('over');
        return false;
    }

    function ody_handleDragEnd(e) {
        ody_lastDragElement.classList.remove('dragElem');
        this.classList.remove('over');

        var cols = document.querySelectorAll('#menuManagementList li');
        [].forEach.call(cols, function(col, index) {
            actualMenu.forEach(function(actualMenuElement) {
                if (actualMenuElement.id == col.id) {
                    actualMenuElement.order = index;
                }
            })
        });

        actualMenu.sort(function(a,b) {
            return a.order - b.order;
        });

        document.getElementById('contentMenu').value = JSON.stringify(actualMenu);
    }

    function ody_addDraggableMenuElements() {
        var cols = document.querySelectorAll('#menuManagementList li');
            [].forEach.call(cols, ody_addDraggableEffet);
    }

    function ody_addDraggableEffet(object) {
        object.addEventListener('dragstart', ody_handleDragStart, false);
        object.addEventListener('dragover', ody_handleDragOver, false);
        object.addEventListener('dragleave', ody_handleDragLeave, false);
        object.addEventListener('drop', ody_handleDrop, false);
        object.addEventListener('dragend', ody_handleDragEnd, false);
    }

    document.addEventListener('DOMContentLoaded', function() {
        ody_showMenuDataWithId(<?php echo ($menuSelected ?? '');?>);
    })
</script>