<?php

    $copyright = get_field('footer_copyright', 'options');
    
    if($copyright): 

?>

    <div class="site-footer__copyright | copy copy-3">
        <?php echo $copyright; ?>
    </div>

<?php endif; ?>