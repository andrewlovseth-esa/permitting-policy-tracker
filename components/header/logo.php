<?php

    $logo = get_field('header_logo', 'options'); 

?>

<?php if($logo): ?>
    <div class="site-logo">
        <a href="<?php echo site_url('/'); ?>" class="site-logo__link">
            <span class="site-logo__image"><?php echo wp_get_attachment_image($logo['ID'], 'full'); ?></span>
        </a>
    </div>
<?php endif; ?>