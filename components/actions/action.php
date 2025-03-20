<?php

    $title = get_the_title();
    $agency = get_field('agency');
    $sub_component = get_field('sub_component');
    $status = get_field('status');
    $type = get_field('document_type');
    $date = get_field('date');
    $link = get_field('external_link');    
    $summary = get_field('summary');
    $policies_rescinded = get_field('policies_rescinded');
    $summary_of_prior_policies = get_field('summary_of_prior_policies');
    $policy_directing_rescission = get_field('policy_directing_rescission');
    $likely_effects_of_current_policy = get_field('likely_effects_of_current_policy');
?>


<?php 

    //var_dump($type->name);

?>

<article class="action">
    <div class="action__header">
        <span class="action__date | sub-header"><?php echo $date; ?></span>
        <h2 class="action__title">
            <?php echo $title; ?>

            <span class="action__type | badge"><?php echo $type->name; ?></span>
            <span class="action__status | status">
                <span class="action__status-indicatator | status__indicatator" style="background-color: <?php $color = get_field('color', 'action-status_' . $status->term_id); echo $color; ?>;"></span>
                <?php echo $status->name; ?>
            </span>
        </h2>
    </div>

    <div class="action__body">
        <div class="action__body-wrapper">
            <div class="action__details">
                <?php if($agency) : ?>
                    <div class="action__detail | one-col">
                        <h4 class="sub-header">Agency</h4>
                        <p class="action__agency | action__value copy-2">
                            <?php echo $agency->name; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if($sub_component) : ?>
                    <div class="action__detail | one-col">
                        <h4 class="sub-header">Sub-Component</h4>
                        <p class="action__sub-component | action__value copy-2">
                            <?php echo $sub_component->name; ?>
                        </p>
                    </div>
                <?php endif; ?>            

                <?php if($link) : ?>
                    <?php
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div class="action__detail | two-col">
                        <h4 class="sub-header">External Link</h4>
                        <p class="action__external-link | action__value copy-2">
                            <a class="action__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($link_title); ?>
                                <?php get_template_part('svg/icon-external-link'); ?>
                            </a>
                        </p>
                    </div>
                <?php endif; ?>             

                <?php if($summary) : ?>
                    <div class="action__detail | two-col">
                        <h4 class="sub-header">Summary</h4>
                        <div class="action__summary | copy copy-2 flow">
                            <?php echo $summary; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="action__analysis">
                <h3 class="action__analysis-header | sub-header">Analysis</h3>

                <div class="action__analysis-list">
                    <?php if($policies_rescinded) : ?>
                        <div class="action__detail">
                            <h4 class="analysis-header">Policies Rescinded</h4>
                            <div class="action__policies-rescinded | copy copy-2 flow">
                                <?php echo $policies_rescinded; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($summary_of_prior_policies) : ?>
                        <div class="action__detail">
                            <h4 class="analysis-header">Summary of Prior Policies</h4>
                            <div class="action__summary-of-prior-policies | copy copy-2 flow">
                                <?php echo $summary_of_prior_policies; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($policy_directing_rescission) : ?>
                        <div class="action__detail">
                            <h4 class="analysis-header">Policy Directing Rescission</h4>
                            <div class="action__policy-directing-rescission | copy copy-2 flow">
                                <?php echo $policy_directing_rescission; ?>      
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($likely_effects_of_current_policy) : ?>
                        <div class="action__detail">
                            <h4 class="analysis-header">Likely Effects of Current Policy</h4>
                            <div class="action__likely-effects-of-current-policy | copy copy-2 flow">
                                <?php echo $likely_effects_of_current_policy; ?>       
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button class="action__toggle">
            <span class="action__toggle-label">Expand</span>
            <?php get_template_part('svg/icon-caret-down'); ?>
        </button>
    </div>

    <div class="action__footer">
        <p class="action__footer-date">Last Updated: <?php echo get_the_modified_date(); ?> at <?php echo get_the_modified_time(); ?></p>
    </div>
</article>