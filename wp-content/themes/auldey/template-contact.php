<?php /* Template Name: Contact */ get_header(); the_post(); ?>

<section id="title" class="noimg"><!-- .noimg if no image. padding - half img height + 40 -->
    <?php the_content(); ?>
</section>

<section id="agecheck" class="content-main">
    <h2><?php the_field('age_check_header'); ?></h2>
    <?php the_field('age_check_body'); ?>
    <a class="btn yes" href="#"><span><?php the_field('yes_button_text'); ?></span></a>
    <a class="btn red no" href="#"><span><?php the_field('no_button_text'); ?></span></a>
</section>

<section id="contact">
    <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
</section>

<section id="denied" class="content-main">
    <h2><?php the_field('denied_header'); ?></h2>
    <?php the_field('denied_body'); ?>
</section>

<?php get_footer(); ?>
