<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">
    <!--<button class="btn btnPrimary">Ajouter un média</button><br><br>-->

    <?php if(!empty($formErrors)){?>
        <?php foreach($formErrors as $error):?>
            <div class="error"><?= $error ;?></div>

        <?php endforeach;?>
    <?php } else { //?>

    <?php } ?>
    <?php  App\Core\FormBuilderWYSWYG::showForm($form); ?>

</section>

<script>
    $(document).ready(function(){
        $('#content').trumbowyg({
            autogrow: true
        });
    });
</script>