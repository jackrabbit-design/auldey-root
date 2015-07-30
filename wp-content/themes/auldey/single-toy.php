<?php get_header(); the_post(); ?>

<section id="title" class="noimg">
    <?php
    $cats = get_the_terms($post->ID, 'brand');
    $catOut = '';
    for($c = 0; $c < count($cats); $c++){
        $catOut .= $cats[$c]->name;
        if($c + 1 < count($cats)) $catOut .= ', ';
    }
    ?>
    <h2><?php echo $catOut; ?></h2>
    <h1><?php the_title() ?></h1>
</section>

<section id="product" class="clearfix">
    <div class="content-main">
        <?php
        the_content();
        if($manual = get_field('associated_manual')){
            $manual = get_field('manual_download',$manual->ID);
            echo '<a class="btn" href="'.$manual.'" download><span>Download Manual</span></a>';
        }
        ?>

    </div>
    <?php
    $gal = get_field('image_gallery');
    if(has_post_thumbnail($post->ID)){
        $thb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'gal-thb');
        $big = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'gal-big'); ?>
    <?php } ?>
    <div class="gallery">

        <img src="<?php echo $big[0] ?>" alt="" />
        <div class="gallery-small">
            <span class="x" style="background-image:url(<?php echo $thb[0] ?>)" data-big="<?php echo $big[0] ?>"></span>
            <?php if($gal){ foreach($gal as $img){ ?>
                <span style="background-image:url(<?php echo $img['sizes']['gal-thb'] ?>)" data-big="<?php echo $img['sizes']['gal-big'] ?>"></span>
            <?php } } ?>
        </div>
    </div>
</section>

<?php if(have_rows('additional_modules')){
    while(have_rows('additional_modules')){ the_row();


        if(get_row_layout() == 'featured_video'){ // !! VIDEO
            $h3 = get_sub_field('video_subheader');
            $h2 = get_sub_field('video_header');
            $v = get_sub_field('featured_video');
            $cats = get_the_terms($v, 'video-brand');
            $catOut = '';
            for($c = 0; $c < count($cats); $c++){
                $catOut .= $cats[$c]->name;
                if($c + 1 < count($cats)) $catOut .= ', ';
            }
            $vidID = get_field('vimeo_id',$v);
            if(has_post_thumbnail($v)){
                $thb = wp_get_attachment_image_src(get_post_thumbnail_id($v), 'home-video'); $thb = $thb[0];
            }else{
                $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vidID.php"));
                $thb = $hash[0]['thumbnail_large'];
            }
            ?>

            <section id="demo">
                <?php if($h3) echo "<h3>{$h3}</h3>"; ?>
                <?php if($h2) echo "<h2>{$h2}</h2>"; ?>
                <a href="http://vimeo.com/<?php echo $vidID ?>" class="lb video">
                    <img src="<?php echo $thb; ?>" alt="" />
                    <span class="light"></span>
                    <span class="dark"></span>
                    <div class="text">
                        <h4><?php echo $catOut ?></h4>
                        <h3><?php echo get_the_title($v) ?></h3>
                    </div>
                    <span class="play"></span>
                </a>

            </section>

        <?php }elseif(get_row_layout() == 'other_toys'){ // !! OTHER TOYS
            $h3 = get_sub_field('other_toys_subheader');
            $h2 = get_sub_field('other_toys_header');
            $toys = get_sub_field('other_toys');
            shuffle($toys);
            $i = 1;
            ?>

            <section id="more-toys">
                <?php if($h3) echo "<h3>{$h3}</h3>"; ?>
                <?php if($h2) echo "<h2>{$h2}</h2>"; ?>
                <div class="toys clearfix">
                    <?php foreach($toys as $toy){
                        if($i++ > 3) continue; ?>
                        <a href="<?php echo get_permalink($toy); ?>" class="toy">
                            <?php if(has_post_thumbnail($toy)){ ?>
                                <?php echo get_the_post_thumbnail($toy,'toy-thb'); ?>
                            <?php } ?>
                            <h4><?php echo get_the_title($toy) ?></h4>
                        </a>
                    <?php } ?>
                </div>
                <a href="<?php the_sub_field('button_link') ?>" class="btn"><span><?php the_sub_field('button_label') ?></span></a>
            </section>

        <?php }elseif(get_row_layout() == 'where_to_purchase'){ // !! WHERE TO PURCHASE ?>

            <section id="purchase">
                <h4>Where to purchase WaveRacer toys</h4>
                <div class="stores">
                    <div class="store"><img src="http://placekitten.com/185/43" alt="" /></div>
                    <div class="store"><img src="http://placekitten.com/77/102" alt="" /></div>
                    <div class="store"><img src="http://placekitten.com/182/50" alt="" /></div>
                </div>
            </section>

        <?php }
    }
} ?>

<?php get_footer(); ?>
