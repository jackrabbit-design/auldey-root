<?php /* Template Name: Manuals */ get_header(); the_post(); ?>

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

<section id="manual-types" <?php echo (isset($_GET['search']) ? 'class="s"' : ''); ?>>
    <ul>
        <li data-href="<?php the_permalink() ?>" class="<?php echo (isset($_GET['search']) ? '' : 'active'); ?>"><span>Browse By Brand</span></li>
        <li data-href="<?php the_permalink() ?>?search" class="<?php echo (isset($_GET['search']) ? 'active' : ''); ?>"><span>Search</span></li>
    </ul>
</section>

<form id="manual-search" method="get" action="<?php the_permalink() ?>">
    <div>
        <label for="search">Search</label>
        <input placeholder="Search by keyword or model #" name="search" id="search" type="text" />
    </div>
    <button class="submit" type="submit">Find it</button>
</form>

<section id="manual-brands">
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 11, 'manual-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_waveracers.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 14, 'manual-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_superwings.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 10, 'manual-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_racetin.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 9, 'manual-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_skyrover.png" alt="" />
        </a>
</section>

<?php
$args = array(
    'post_type' => 'manual',
    'posts_per_page' => -1
);

if(isset($_GET['search']) && !empty($_GET['search'])){
    $args = array_merge($args,array('s' => $_GET['search']));
}

query_posts($args); ?>

<section id="manual-results">
    <?php if(isset($_GET['search']) && !empty($_GET['search'])){ ?>
        <div class="content-main">
            <h4><?php echo $ct = $wp_query->post_count; ?> result<?php echo ($ct == 1 ? '' : 's') ?> for</h4>
            <h3><?php echo strtoupper($_GET['search']) ?></h3>
        </div>
    <?php }else{ ?>
        <div class="content-main">
            <h3 class="sort-text">
                <span>All</span> User Manuals
            </h3>
        </div>
    <? } ?>

    <?php if(have_posts()){ ?>


        <ul id="results" class="manuals">
            <?php while(have_posts()){ the_post();
                $cats = get_the_terms($post->ID, 'manual-brand');
                $catSlug = '';
                for($c = 0; $c < count($cats); $c++){
                    $catSlug .= $cats[$c]->slug;
                }
                ?>
                <li data-brand="<?php echo $catSlug ?>">
                    <a href="<?php the_field('manual_download') ?>" download class="clearfix">
                        <?php if(has_post_thumbnail(get_field('associated_toy'))){
                            echo get_the_post_thumbnail(get_field('associated_toy'),'manual-grid');
                        } ?>
                        <p><?php the_title() ?>
                            <small><?php the_field('model_number'); ?></small>
                        </p>
                    </a>
                </li>
            <?php } ?>
        </ul>

<?php } wp_reset_query(); ?>

</section>

<?php get_footer(); ?>
