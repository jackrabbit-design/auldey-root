<?php /* Template Name: Contact */ get_header(); the_post(); ?>

<section id="title" class="noimg"><!-- .noimg if no image. padding - half img height + 40 -->
    <?php the_content(); ?>
</section>

<section id="contact">
    <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
</section>

<?php get_footer(); ?>
