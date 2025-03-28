<?php
    if(isset($args['policy'])) {
        $policy = $args['policy'];
    }

    $title = get_the_title($policy->ID);
    $description = get_field('description', $policy->ID);
    $link = get_field('link', $policy->ID);
?>

<div class="rescinded-policy">
    <div class="rescinded-policy__header">
        <h4 class="rescinded-policy__title">
            <?php get_template_part('svg/icon-close-box'); ?>
            <?php echo $title; ?>
        </h4>
    </div>

    <div class="rescinded-policy__body">
        <div class="rescinded-policy__description | copy copy-3 flow">
            <?php echo $description; ?>
        </div>
    </div>

    <div class="rescinded-policy__footer">
        <a class="rescinded-policy__link" href="<?php echo $link; ?>" target="_blank">
            Link
            <?php get_template_part('svg/icon-external-link'); ?>
        </a>
    </div>
</div>