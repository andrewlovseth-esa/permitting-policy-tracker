<?php

/*

    Template Name: Home

*/

get_header(); ?>

    <?php  get_template_part('templates/home/hero'); ?>


    <section id="actions">
        <?php get_template_part('templates/home/filters'); ?>

        <?php get_template_part('templates/home/list'); ?>
    </section>



<?php get_footer(); ?>
