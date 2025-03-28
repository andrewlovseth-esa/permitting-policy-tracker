<?php
    if(isset($args['policy'])) {
        $policy = $args['policy'];
        $index = $args['index'];
    }

    $title = get_the_title($policy->ID);
    $description = get_field('description', $policy->ID);
    $link = get_field('link', $policy->ID);
    $likely_effects_of_current_policy = get_field('likely_effects_of_current_policy', $policy->ID);
?>

<div class="rescinded-policy">
    <div class="rescinded-policy__header <?php echo $index === 1 ? 'open' : ''; ?> | js-rescinded-policy-toggle">
        <h4 class="rescinded-policy__title">
            <?php get_template_part('svg/icon-close-box'); ?>
            <?php echo $title; ?>
        </h4>

        <?php get_template_part('svg/icon-caret-down'); ?>
    </div>

    <div class="rescinded-policy__body <?php echo $index === 1 ? 'open' : ''; ?> js-rescinded-policy-body">
        <div class="rescinded-policy__description | copy copy-3 flow">
            <?php echo $description; ?>

            <p>
                <a class="rescinded-policy__link" href="<?php echo $link; ?>" target="_blank">
                    Link
                    <?php get_template_part('svg/icon-external-link'); ?>
                </a>
            </p>
        </div>

        <?php if($likely_effects_of_current_policy) : ?>
            <div class="rescinded-policy__footer">
                <h4 class="copy copy-3">Likely Effects of Current Policy</h4>

                <div class="copy copy-3 flow">
                    <?php echo $likely_effects_of_current_policy; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>