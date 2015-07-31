<?php /* Template Name: Brand */ get_header(); the_post(); ?>


    <?php
    $bg = get_field('banner_background'); printr($bg);
    $bg = ($bg ? 'style="background-image:url(' . $bg['sizes']['home-banner'] . ')"' : '');
    ?>

    <section id="brand-slider" <?php echo $bg ?>>
        <?php if($slides = get_field('banner_slider')){ ?>
            <div id="brand-slides">
                <?php foreach($slides as $s){ //printr($s); ?>
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
                    <p><?php the_sub_field('content'); ?></p>
                    <a href="#" class="btn"><span><?php the_sub_field('button_label'); ?></span></a>
                </div>
            </section>

        <?php }elseif(get_row_layout() == 'half_width'){

            $gray = (get_sub_field('gray_background') ? 'gray' : '');
            $orientation = (get_sub_field('orientation') == 'Text on Left' ? 'text-left' : 'text-right');

            ?>

            <section class="half <?php echo $gray . ' ' . $orientation; ?> clearfix">
                <div class="wrap">
                    <div class="content-main">
                        <h4>BUILT FOR SPEED</h4>
                        <h2>Lorem ipsum dolor sit amet, consectetur posit</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper volutpat erat et consequat. Quisque vestibulum ut ipsum in condimentum. Nulla nunc ligula, dignissim eget laoreet eget.</p>
                    </div>
                    <img src="http://www.placekitten.com/480/346" alt="" />
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

    $args = array(
        'post_type' => 'toy',
        'posts_per_page' => 6,
        'brand' => $brand
    );

    query_posts($args);

    if(have_posts()){
    ?>

        <section id="toy-grid">
            <ul>
                <?php while(have_posts()){ the_post();
                    ?>
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
            <a><span>1</span></a>
            <a><span>2</span></a>
            <a><span>3</span></a>
            <a><span>4</span></a>
            <a><span>Next &#9658;</span></a>
        </section>

    <?php } ?>

    <section id="purchase">
        <h4>Where to purchase WaveRacer toys</h4>
        <div class="stores">
            <div class="store"><img src="http://placekitten.com/185/43" alt="" /></div>
            <div class="store"><img src="http://placekitten.com/77/102" alt="" /></div>
            <div class="store"><img src="http://placekitten.com/182/50" alt="" /></div>
        </div>
    </section>


<?php get_footer(); ?>
