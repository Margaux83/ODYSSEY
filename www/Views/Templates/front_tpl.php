<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Odyssey - <?= (empty($title)) ? 'Accueil ' : $title; ?></title>
	<meta name="description" content="<?= $description ?>">
	<link rel="stylesheet" type="text/css" href=<?php App\Core\View::getAssets(App\Core\FrontPage::getTemplateCss());?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="nav-responsive">
        <nav>
            <ul>
                <li class="selected">
                    <i class="fa fa-home"></i>
                    <p>Accueil</p>
                </li>
                <li>
                    <i class="fa fa-plane"></i>
                    <p>Voyages</p>
                </li>
                <li>
                    <i class="fa fa-newspaper-o"></i>
                    <p>Articles</p>
                </li>
                <li>
                    <i class="fa fa-comment"></i>
                    <p>Contact</p>
                </li>
            </ul>
        </nav>
    </div>
    <header>
        <div class="header-topElements">
			<a class="titlePage" href="/"><img src=<?php App\Core\View::getAssets("logos/odyssey_logo_v2.svg")?> alt="Odyssey" class="back-mainPage-header-logo"></a>
            <nav>
				<?php echo App\Core\FrontPage::getFrontMenu('Menu header');?>
            </nav>
        </div>
        <div class="header-content">
            <h1>Un nouveau moyen de créer du contenu</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit rem laudantium eveniet nostrum itaque cumque harum. Numquam assumenda, cumque, sed illum fuga incidunt quidem fugiat magnam exercitationem modi dolor ex.
            </p>
            
            <div class="inputButton">
                <input placeholder="Rechercher">
                <button>
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </header>

	<main>
        <?php $this->addModal("alert"); ?>

        <!-- intégrer le vue -->
		<?php include $this->view ?>
	</main>

	
	<footer>
		<div>
			<h2>Odyssey</h2>
			<div class="inputButton">
				<input placeholder="Rechercher">
				<button>
					<i class="fa fa-search"></i>
				</button>
			</div>
		</div>
		<nav>
			<p>Navigation</p>
			<?php echo App\Core\FrontPage::getFrontMenu('Menu footer');?>
		</nav>
	</footer>

</body>
</html>