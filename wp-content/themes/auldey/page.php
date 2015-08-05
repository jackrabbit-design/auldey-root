<?php get_header(); the_post(); ?>

    <?php if($img = get_field('header_image')){
        $p = $img['sizes']['brand-slide-height'] / 2 + 40;
        $style = 'style="padding-bottom:';
        $style .= $p;
        $style .= 'px; margin-bottom:';
        $style .= $p;
        $style .= 'px;"';
    }else{
        $style = 'class="noimg"';
    } ?>

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
        <?php if($img){
            $w = $img['sizes']['brand-slide-width'] / 2;
            $h = $img['sizes']['brand-slide-height'] / 2;
            $u = $img['sizes']['brand-slide'];
            ?>
            <img src="<?php echo $u ?>" alt="<?php the_title(); ?>" style="bottom:-<?php echo $h ?>px; margin-left:-<?php echo $w ?>px;" />
        <?php } ?>
    </section>

    <section class="callout">
        <h3><?php the_field('callout_title'); ?></h3>
        <?php the_field('callout_text'); ?>
    </section>

    <section class="main clearfix">
        <article class="content-main">
            <?php the_content(); ?>
        </article>
        <aside class="sidebar">
            <?php if($side = get_field('sidebar_image')){ ?>
                <img src="<?php echo $side['sizes']['side-img'] ?>" alt="<?php the_title(); ?>" />
            <?php } ?>
        </aside>
    </section>

<?php get_footer(); ?>
