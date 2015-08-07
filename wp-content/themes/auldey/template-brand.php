<?php /* Template Name: Brand */ get_header(); the_post(); ?>


    <?php
    $bg = get_field('banner_background');
    $bg = ($bg ? 'style="background-image:url(' . $bg['sizes']['home-banner'] . ')"' : '');
    ?>

    <section id="brand-slider" <?php echo $bg ?>>
        <?php if($slides = get_field('banner_slider')){ ?>
            <div id="brand-slides">
                <?php foreach($slides as $s){ ?>
                    <img src="<?php echo $s['sizes']['brand-slide']; ?>" alt="" class="slide" />
                <?php } ?>
            </div>
        <?php } ?>
        <div id="brand-logo">
            <?php
            $logo = get_field('brand_logo');
            $logo = $logo['sizes'];
            $logoImg = $logo['brand-logo'];
            $logoMar = $logo['brand-logo-height'] / 2;
            ?>
            <img src="<?php echo $logoImg ?>" style="margin-top:-<?php echo $logoMar ?>px;" alt="" /><!-- margin top negative half height -->
        </div>
    </section>

    <?php if(have_rows('brand_modules')){ while(have_rows('brand_modules')){ the_row(); ?>

        <?php if(get_row_layout() == 'full'){ ?>

            <section class="full" style="background-image:url('ui/images/bg-wr.jpg'); padding-top:<?php echo $logoMar + 30 ?>px;"><!-- margin bottom half logo height + 30 -->
                <div class="content-main">
                    <h2><?php the_sub_field('header'); ?></h2>
                    <?php the_sub_field('content'); ?>
                    <a href="#" class="btn"><span><?php the_sub_field('button_label'); ?></span></a>
                </div>
            </section>

        <?php }elseif(get_row_layout() == 'half_width'){

            $gray = (get_sub_field('gray_background') ? 'gray' : '');
            $orientation = (get_sub_field('orientation') == 'Text on Left' ? 'text-left' : 'text-right');
            $img = get_sub_field('image');

            ?>

            <section class="half <?php echo $gray . ' ' . $orientation; ?> clearfix">
                <div class="wrap">
                    <div class="content-main">
                        <?php the_sub_field('content'); ?>
                    </div>
                    <?php if($img){ ?>
                        <img src="<?php echo $img['sizes']['brand-half']; ?>" alt="" />
                    <?php } ?>
                </div>
            </section>

        <?php } ?>

    <?php } } ?>

    <section id="sort">
        <h3>SORT WAVE RACER TOYS</h3>
        <ul>
            <li><span>Newest</span></li>
            <li><span>Price</span></li>
            <li><span>A-Z</span></li>
            <li><span>Indoor</span></li>
            <li><span>Outdoor</span></li>
        </ul>
    </section>

    <?php

    $brand = get_field('brand_to_show');
    $brand = $brand->slug;

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
        'post_type' => 'toy',
        'posts_per_page' => 6,
        'brand' => $brand,
        'paged' => $paged
    );

    query_posts($args);

    if(have_posts()){
    ?>
    <div id="everything">

        <section id="toy-grid">
            <ul>
                <?php while(have_posts()){ the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                            <?php if(has_post_thumbnail()){
                                the_post_thumbnail('toy-grid');
                            } ?>
                            <p><?php the_title(); ?></p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </section>

        <section id="pagination">
            <?php echo paginate_links(array(
                'show_all' => true,
                'before_page_number' => '<span>',
                'after_page_number' => '</span>',
                'prev_text' => '<span>&#9668; Prev</span>',
                'next_text' => '<span>Next &#9658;</span>'
            )); ?>
        </section>

    </div>

    <?php } wp_reset_query(); ?>

    <?php if(have_rows('stores_available')){ ?>
        <section id="purchase">
            <h4><?php the_field('stores_text'); ?></h4>
            <div class="stores">
                <?php while(have_rows('stores_available')){ the_row();
                    $logo = get_sub_field('logo');
                    $logo = $logo['sizes']['store-logo'];
                    $alt = get_sub_field('store_name');
                    $link = get_sub_field('url');
                    if($link){
                        $el = 'a href="'.$link.'" class="store external"';
                        $cl = 'a';
                    }else{
                        $el = 'div class="store"';
                        $cl = $el;
                    }
                    ?>
                    <<?php echo $el; ?>>
                        <img src="<?php echo $logo ?>" alt="<?php echo $alt ?>" />
                    </<?php echo $cl; ?>>
                <?php } ?>
            </div>
        </section>
    <?php } ?>

<?php get_footer(); ?>
