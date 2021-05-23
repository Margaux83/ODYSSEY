<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Template de Front</title>
		<meta name="description" content="ceci est la page de front">
	</head>
	<body>
		<header>
			<h1>Template Frontoffice</h1>
		</header>
        <!-- Intégration du modal d'affichage de message -->
        <?php $this->addModal("alert"); ?>

        <!-- intégrer le vue -->
		<?php include $this->view ?>

	</body>
</html>