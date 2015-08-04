<?php /* Template Name: Videos */ get_header(); the_post(); ?>


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
    <p><?php the_field('header_text
    '); ?></p>
</section>

<section id="manual-types">
    <ul>
        <li class="active"><span>Browse By Brands</span></li>
        <li><span>Search</span></li>
    </ul>
</section>


<section id="manual-brands">
    <a href="#" class=""><img src="<?php bloginfo('url') ?>/ui/images/logo_waveracers.png" alt="" /></a>
    <a href="#" class=""><img src="<?php bloginfo('url') ?>/ui/images/logo_superwings.png" alt="" /></a>
    <a href="#" class=""><img src="<?php bloginfo('url') ?>/ui/images/logo_racetin.png" alt="" /></a>
    <a href="#" class=""><img src="<?php bloginfo('url') ?>/ui/images/logo_skyrover.png" alt="" /></a>

</section>

<?php
$args = array(
    'post_type' => 'video',
    'posts_per_page' => 6
);

query_posts($args);
if(have_posts()){
?>

    <section id="manual-results">
        <div class="content-main">
            <h3>All Videos</h3>
        </div>
        <ul id="results" class="videos">
            <?php while(have_posts()){ the_post();
                $cats = get_the_terms($post->ID, 'video-brand');
                $catOut = '';
                for($c = 0; $c < count($cats); $c++){
                    $catOut .= $cats[$c]->name;
                    if($c + 1 < count($cats)) $catOut .= ', ';
                }
                $vidID = get_field('vimeo_id');
                if(has_post_thumbnail()){
                    $thb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'vid-grid'); $thb = $thb[0];
                }else{
                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vidID.php"));
                    $thb = $hash[0]['thumbnail_large'];
                }
                ?>
                <li>
                    <a href="http://vimeo.com/<?php echo $vidID ?>" class="lb video">
                        <img src="<?php echo $thb ?>" alt="" /><span class="play"></span>
                    </a>
                    <h3><?php the_title() ?></h3>
                    <p><?php echo $catOut; ?></p>
                </li>
            <?php } ?>
        </ul>
    </section>

<?php } ?>

<?php get_footer(); ?>
