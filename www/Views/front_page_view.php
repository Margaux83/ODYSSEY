
<h1><?= (empty($title)) ? 'test' : $title; ?></h1>
<section>
    <?php echo $content?>
</section>

<?php echo App\Core\FrontPage::getCommentarySection($idArticle); ?>