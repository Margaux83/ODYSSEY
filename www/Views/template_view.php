<section style="grid-column: 1 / 13; grid-row: 1;">
    <ul class="templateCards">
        <?php
            foreach ($templates as $key => $template) {
                echo '<li class="templateCard">' . $template . '</li>';
            }
        ?>
    </ul>
</section>