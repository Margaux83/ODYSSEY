<section class="col-12" style="grid-column: 1 / 13; grid-row: 1;">

</section>

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

<script src=<?php App\Core\View::getAssets("modal.js")?>></script>
<script src=<?php App\Core\View::getAssets("popups.js")?>></script>

<script>
    $("#title").keyup(function(){
        update();
    });
    function update() {
        let value = $('#title').val().replace(/[^a-z0-9\w\d]+/g, "-");
        $("#uri").val(value.toLowerCase());
    }
</script>