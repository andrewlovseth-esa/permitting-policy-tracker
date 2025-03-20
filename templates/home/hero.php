<?php

    $hero = get_field('hero');
    $photo = $hero['photo'];
    $headline = $hero['headline'];
    $copy = $hero['copy'];

?>

<section class="hero | content-grid">
    <?php if($photo): ?>
        <div class="hero__photo">
            <?php echo wp_get_attachment_image($photo['ID'], 'full'); ?>
        </div>
    <?php endif; ?>

    <div class="hero__info">
        <?php if($headline): ?>
            <h2 class="hero__headline | sub-header"><?php echo $headline; ?></h2>
        <?php endif; ?>

        <?php if($copy): ?>
            <div class="hero__copy | copy copy-2">
                <?php echo $copy; ?>
            </div>
        <?php endif; ?>
    </div>
</section>