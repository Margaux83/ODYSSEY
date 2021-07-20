
<h1><?php echo $title?></h1>
<section>
    <?php echo $content?>
</section>

<?php echo App\Core\FrontPage::getCommentarySection($idArticle); ?>