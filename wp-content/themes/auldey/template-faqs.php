<?php /* Template Name: FAQs */ get_header(); the_post(); ?>


<section id="title" class="noimg"><!-- .noimg if no image. padding - half img height + 40 -->
    <?php
    if($post->post_parent){
        $parent = get_the_title($post->post_parent);
    }else{
        $parent = "Auldey";
    }
    ?>
    <h2><?php echo $parent ?></h2>
    <h1><?php the_title(); ?></h1>
</section>

<section class="callout manual">
    <h3><?php the_field('header_title'); ?></h3>
    <p><?php the_field('header_text'); ?></p>
</section>

<?php if(have_rows('faqs')){ ?>
    <section id="faqs">
        <?php while(have_rows('faqs')){ the_row(); ?>
            <div class="faq">
                <h3 class="q"><?php the_sub_field('question'); ?></h3>
                <div class="a content-main">
                    <?php the_sub_field('answer'); ?>
                </div>
            <?php } ?>
        </div>

    </section>
<?php } ?>

<?php get_footer(); ?>
