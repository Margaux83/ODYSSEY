
<h1><?php echo $title?></h1>
<section>
    <?php echo $content?>
    <?php echo (empty($label)) ? '' : "<strong>Catégorie</strong> : " . $label  ?>
</section>
<?php echo App\Core\FrontPage::getCommentarySection($idArticle); ?>