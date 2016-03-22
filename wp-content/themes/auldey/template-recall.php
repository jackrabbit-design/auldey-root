<?php /* Template Name: Recall */ get_header(); the_post(); ?>

    <?php $style = 'class="noimg"'; ?>

    <section id="title" <?php echo $style ?>><!-- .noimg if no image. padding - half img height + 40 -->
        <?php
        if($post->post_parent){
            $parent = get_the_title($post->post_parent);
        }else{
            $parent = "Auldey";
        }
        ?>
        <h2><?php echo $parent ?></h2>
        <h1><?php the_title(); ?></h1>
        <?php if(get_field('callout_title') || get_field('callout_text')){ ?>
            <h3><?php the_field('callout_title') ?></h3>
            <?php the_field('callout_text') ?>
        <?php } ?>
        <a href="#" class="btn recall"><span>Download Consumer Safety Notice</span></a>

    </section>

    <section class="main clearfix">

        <article class="affected">
            <h3>Products Affected</h3>
            <div class="product">
                <img src="//placeimg.com/400/189" alt="" />
                <h4>Sky Rover Aero Spin</h4>
                <h6>YW859110-2, YW859110-3, YW859110-6, TTYW859110-5</h6>
                <p>Sold between 1/1/2015 - 1/1/2016</p>
            </div>
            <div class="product">
                <img src="//placeimg.com/400/189" alt="" />
                <h4>Sky Rover Aero Spin</h4>
                <h6>YW859110-2, YW859110-3, YW859110-6, TTYW859110-5</h6>
                <p>Sold between 1/1/2015 - 1/1/2016</p>
            </div>

        </article>

        <article class="content-main <?php if(!$side) echo 'full-width'; ?>">
            <?php the_content(); ?>
        </article>
        <aside class="sidebar">
            <img src="<?php //echo $side['sizes']['side-img'] ?>" alt="<?php the_title(); ?>" />
        </aside>
    </section>

<?php get_footer(); ?>
