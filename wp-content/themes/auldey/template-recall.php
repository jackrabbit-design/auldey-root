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
        <?php } if($file = get_field('download_file')){ ?>
            <a href="<?php echo $file ?>" class="btn recall"><span><?php the_field('download_label'); ?></span></a>
        <?php } ?>

    </section>

    <section class="main clearfix">

        <article class="affected">
            <h3>Products Affected</h3>
            <?php while(have_rows('affected_products')){ the_row(); ?>
                <div class="product">
                    <img src="<?php $img = get_sub_field('product_image'); echo $img['sizes']['medium'] ?>" alt="" />
                    <h4><?php the_sub_field('product_name'); ?></h4>
                    <h6><?php the_sub_field('product_numbers'); ?></h6>
                    <p><?php the_sub_field('product_details'); ?></p>
                </div>
            <?php } ?>
        </article>

        <article class="content-main recall">
            <?php the_content(); /*?>
            <!-- <ol>
                <li>Provide proof of destruction of the USB charge cord. A photo showing the cord cut in two pieces is sufficient. Submit by e-mail to <a href="mailto:aeroproducts@auldey.us">aeroproducts@auldey.us</a> or by mail to:
                    <em>
                        Auldey Toys of North America<br />
                        ATTN: Consumer Service AERO<br />
                        1900 Crown Colony Drive – Ste 388<br />
                        Quincy MA, 02169
                    </em>
                </li>
                <li>
                    In your e-mail or mail submission, please include your <b>full name</b> and <b>complete mailing address</b> so that a replacement charge cord can be provided.
                </li>
                <li>
                    Please allow 2-4 weeks for receipt of your replacement charge cord.
                </li>
            </ol>
            <p>If you have any questions on the instructions above, or require further information, please contact us toll-free at 1-844-303-8936 from 9 a.m. to 5 p.m. EST Mon-Fri, or email <a href="mailto:aeroproducts@auldey.us">aeroproducts@auldey.us</a>.</p> -->*/ ?>
        </article>
        <aside class="sidebar">
            <?php if($side = get_field('sidebar_image')){ ?>
                <img src="<?php echo $side['sizes']['medium'] ?>" alt="<?php the_title(); ?>" />
            <?php } ?>
        </aside>
    </section>

<?php get_footer(); ?>
