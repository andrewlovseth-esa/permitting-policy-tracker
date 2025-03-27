<?php
    $title = get_the_title();
    $agency = wp_get_object_terms(get_the_ID(), 'agency')[0] ?? null;
    $sub_component = wp_get_object_terms(get_the_ID(), 'sub-component')[0] ?? null;
    $status = wp_get_object_terms(get_the_ID(), 'action-status')[0] ?? null;
    $type = wp_get_object_terms(get_the_ID(), 'document-type')[0] ?? null;
    $link = get_field('external_link');    
    $summary = get_field('summary');
    $policies_rescinded = get_field('policies_rescinded');
    $summary_of_prior_policies = get_field('summary_of_prior_policies');
    $policy_directing_rescission = get_field('policy_directing_rescission');
    $likely_effects_of_current_policy = get_field('likely_effects_of_current_policy');
?>

<article class="action">
    <div class="action__header | action-toggle">
        <h2 class="action__title">
            <?php if(!is_null($type)) : ?>
                <span class="action__type | badge dark"><?php echo $type->name; ?></span>
            <?php endif; ?>

            <span class="action__title-text"><?php echo $title; ?></span >

            <?php if(!is_null($status)) : ?>
                <span class="action__status | status">
                    <span class="action__status-indicatator | status__indicatator" style="background-color: <?php $color = get_field('color', 'action-status_' . $status->term_id); echo $color; ?>;"></span>
                    <?php echo $status->name; ?>
                </span>
            <?php endif; ?>
        </h2>
        
        <?php get_template_part('svg/icon-caret-down'); ?>
    </div>

    <div class="action__body">
        <div class="action__body-wrapper">
            <div class="action__details">
                <?php if(!is_null($agency)) : ?>
                    <div class="action__detail | one-col">
                        <h4 class="sub-header">Agency</h4>
                        <p class="action__agency | action__value copy-2">
                            <?php echo $agency->name; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if(!is_null($sub_component)) : ?>
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

            <?php if($policies_rescinded || $summary_of_prior_policies || $policy_directing_rescission || $likely_effects_of_current_policy) : ?>
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
            <?php endif; ?>
        </div>

        <div class="action__footer">
            <p class="action__footer-date">Last Updated: <?php echo get_the_modified_date(); ?> at <?php echo get_the_modified_time(); ?></p>
        </div> 
    </div>
</article>