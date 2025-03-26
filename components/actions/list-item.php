<?php

    $title = get_the_title();
    
    $agency = wp_get_object_terms(get_the_ID(), 'agency')[0] ?? null;
    $sub_component = wp_get_object_terms(get_the_ID(), 'sub-component')[0] ?? null;
    $status = wp_get_object_terms(get_the_ID(), 'action-status')[0] ?? null;
    $type = wp_get_object_terms(get_the_ID(), 'document-type')[0] ?? null;



    $date = get_field('date');
    $link = get_field('external_link');    
    $summary = get_field('summary');
    $policies_rescinded = get_field('policies_rescinded');
    $summary_of_prior_policies = get_field('summary_of_prior_policies');
    $policy_directing_rescission = get_field('policy_directing_rescission');
    $likely_effects_of_current_policy = get_field('likely_effects_of_current_policy');

?>

<article class="list-item">
    <div class="list-item__header | list-item-toggle">
        <h2 class="list-item__title">
            <?php if(!is_null($type)) : ?>
                <span class="list-item__type | badge"><?php echo $type->name; ?></span>
            <?php endif; ?>

            <span class="list-item__title-text"><?php echo $title; ?></span >

            <?php if(!is_null($status)) : ?>
                <span class="list-item__status | status">
                    <span class="list-item__status-indicatator | status__indicatator" style="background-color: <?php $color = get_field('color', 'action-status_' . $status->term_id); echo $color; ?>;"></span>
                    <?php echo $status->name; ?>
                </span>
            <?php endif; ?>
        </h2>
        
        <?php get_template_part('svg/icon-caret-down'); ?>
    </div>

    <div class="list-item__body">
        <div class="list-item__body-wrapper">
            <div class="list-item__details">
                <?php if(!is_null($agency)) : ?>
                    <div class="list-item__detail | one-col">
                        <h4 class="sub-header">Agency</h4>
                        <p class="list-item__agency | list-item__value copy-2">
                            <?php echo $agency->name; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if(!is_null($sub_component)) : ?>
                    <div class="list-item__detail | one-col">
                        <h4 class="sub-header">Sub-Component</h4>
                        <p class="list-item__sub-component | list-item__value copy-2">
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
                    <div class="list-item__detail | two-col">
                        <h4 class="sub-header">External Link</h4>
                        <p class="list-item__external-link | list-item__value copy-2">
                            <a class="list-item__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
                                <?php echo esc_html($link_title); ?>
                                <?php get_template_part('svg/icon-external-link'); ?>
                            </a>
                        </p>
                    </div>
                <?php endif; ?>             

                <?php if($summary) : ?>
                    <div class="list-item__detail | two-col">
                        <h4 class="sub-header">Summary</h4>
                        <div class="list-item__summary | copy copy-2 flow">
                            <?php echo $summary; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($policies_rescinded || $summary_of_prior_policies || $policy_directing_rescission || $likely_effects_of_current_policy) : ?>
                <div class="list-item__analysis">
                    <h3 class="list-item__analysis-header | sub-header">Analysis</h3>

                    <div class="list-item__analysis-list">
                        <?php if($policies_rescinded) : ?>
                            <div class="list-item__detail">
                                <h4 class="analysis-header">Policies Rescinded</h4>
                                <div class="list-item__policies-rescinded | copy copy-2 flow">
                                    <?php echo $policies_rescinded; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($summary_of_prior_policies) : ?>
                            <div class="list-item__detail">
                                <h4 class="analysis-header">Summary of Prior Policies</h4>
                                <div class="list-item__summary-of-prior-policies | copy copy-2 flow">
                                    <?php echo $summary_of_prior_policies; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($policy_directing_rescission) : ?>
                            <div class="list-item__detail">
                                <h4 class="analysis-header">Policy Directing Rescission</h4>
                                <div class="list-item__policy-directing-rescission | copy copy-2 flow">
                                    <?php echo $policy_directing_rescission; ?>      
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($likely_effects_of_current_policy) : ?>
                            <div class="list-item__detail">
                                <h4 class="analysis-header">Likely Effects of Current Policy</h4>
                                <div class="list-item__likely-effects-of-current-policy | copy copy-2 flow">
                                    <?php echo $likely_effects_of_current_policy; ?>       
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="list-item__footer">
            <p class="list-item__footer-date">Last Updated: <?php echo get_the_modified_date(); ?> at <?php echo get_the_modified_time(); ?></p>
        </div> 
    </div>
</article>