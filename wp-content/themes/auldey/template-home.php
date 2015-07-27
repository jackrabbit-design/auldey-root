<?php /* Template Name: Home */ get_header(); the_post(); ?>

<?php if(have_rows('banners')){ ?>
    <div id="banner">
        <?php $i = 0; while(have_rows('banners')){ the_row(); $i++;
            if($banner = get_sub_field('banner_image')){
                $banner = $banner['sizes']['home-banner'];
                $out = '<div class="slide" style="background-image:url('.$banner.')"></div>';
                echo $out;
            };
            if($i == 1) echo $out; // Owl doesnt work if only 1 slide.
        } ?>
    </div>
<?php } ?>

<?php if(have_rows('brands')){ ?>
    <div id="brand-grid">
        <?php while(have_rows('brands')){ the_row();
            $sq = get_sub_field('brand_image');
            $logo = get_sub_field('brand_logo');
            $logo = $logo['sizes'];
            $mar = $logo['brand-grid-logo-width'] / 2;
            $bot = $logo['brand-grid-logo-height'] / 2;
            ?>
            <div class="brand">
                <img class="square"  src="<?php echo $sq['sizes']['brand-grid-image']; ?>" alt="<?php the_sub_field('brand_name'); ?>" />
                <img src="<?php echo $logo['brand-grid-logo'] ?>" alt="<?php the_sub_field('brand_name'); ?>" class="logo" style="margin-left:-<?php echo $mar; ?>px; bottom:-<?php echo $bot; ?>px;" />
            </div>
        <?php } ?>
    </div>
<?php } ?>

<div id="videos">
    <h3><?php the_field('videos_small_header'); ?></h3>
    <h2><?php the_field('videos_large_header'); ?></h2>

    <?php if($videos = get_field('videos')){
    } ?>
    <?php for($i = 0; $i < 3; $i++){
        $v = $videos[$i]->ID;
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
        <a href="http://vimeo.com/<?php echo $vidID ?>" class="lb video <?php echo ($i == 0 ? 'large' : 'small'); ?>">
            <img src="<?php echo $thb; ?>" alt="" />
            <span class="light"></span>
            <span class="dark"></span>
            <div class="text">
                <h4><?php echo $catOut ?></h4>
                <h3><?php echo get_the_title($v) ?></h3>
            </div>
            <?php if($i == 0){ ?>
                <span class="play"></span>
            <?php } ?>
        </a>

    <?php } ?>

    <div class="center clear btn-holder">
        <a class="btn" href="<?php the_field('button_link'); ?>"><span><?php the_field('button_label'); ?></span></a>
    </div>

</div>

<div id="innovative">
    <h2>INNOVATIVE TOYS THAT BRING JOY TO THE WORLD</h2>
</div>

<div id="toys">
    <div id="toys-slider">
        <div class="slide">
            <img src="//placekitten.com/960/568" alt="" style="margin-left:-480px;" />
            <div class="popup">
                <div class="expand"><span>+</span></div>
                <div class="more">
                    <div class="more-holder clearfix">
                        <h5>Superwings</h5>
                        <h4>Donnie</h4>
                        <p>Donnie is the lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor tempus velit, a consectetur massa. Post quam filet erat filium est.</p>
                        <ul>
                            <li>Ages 6+</li>
                            <li>Fully transforms for flight action!</li>
                            <li>Lorem ipsum dolor sit</li>
                        </ul>
                        <div class="buttons">
                            <a href="#" class="btn"><span>View Toy</span></a>
                            <a href="#" class="right">View Superwings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <img src="//placekitten.com/960/568" alt="" style="margin-left:-480px;" />
            <div class="popup">
                <div class="expand"><span>+</span></div>
                <div class="more">
                    <div class="more-holder clearfix">
                        <h5>Superwings</h5>
                        <h4>Donnie</h4>
                        <p>Donnie is the lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tempor tempus velit, a consectetur massa. Post quam filet erat filium est.</p>
                        <ul>
                            <li>Ages 6+</li>
                            <li>Fully transforms for flight action!</li>
                            <li>Lorem ipsum dolor sit</li>
                        </ul>
                        <div class="buttons">
                            <a href="#" class="btn"><span>View Toy</span></a>
                            <a href="#" class="right">View Superwings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="center">
        <span class="btn more-toys"><span>More Toys</span></a>
    </div>
</div>

<div id="share">
    <div class="wrap">
        <h3>Share the love for your</h3>
        <h2>#Auldeytoys</h2>
        <div id="instagram">
            <div class="shot s1">
                <img src="http://www.placekitten.com/301/301" alt="" />
                <div class="bottom">
                    <span class="text">@toyfan2002</span>
                    <span class="bg"></span>
                </div>
                <div class="content">
                    <div class="text">Donnie’s gettin’ dizzy chasin’ tornados! <a href="#">#auldeytoys</a> <a href="">#nevertoooldfortoys</a> <a href="">#sundayfunday</a> <a href="">#superwings</a></div>
                </div>
            </div>
            <div class="shot s2">
                <img src="http://www.placekitten.com/301/301" alt="" />
                <div class="bottom">
                    <span class="text">@toyfan2002</span>
                    <span class="bg"></span>
                </div>
                <div class="content">
                    <div class="text">Donnie’s gettin’ dizzy chasin’ tornados! <a href="#">#auldeytoys</a> <a href="">#nevertoooldfortoys</a> <a href="">#sundayfunday</a> <a href="">#superwings</a></div>
                </div>
            </div>
            <div class="shot s3">
                <img src="http://www.placekitten.com/301/301" alt="" />
                <div class="bottom">
                    <span class="text">@toyfan2002</span>
                    <span class="bg"></span>
                </div>
                <div class="content">
                    <div class="text">Donnie’s gettin’ dizzy chasin’ tornados! <a href="#">#auldeytoys</a> <a href="">#nevertoooldfortoys</a> <a href="">#sundayfunday</a> <a href="">#superwings</a></div>
                </div>
            </div>
            <div class="shot s4">
                <img src="http://www.placekitten.com/301/301" alt="" />
                <div class="bottom">
                    <span class="text">@toyfan2002</span>
                    <span class="bg"></span>
                </div>
                <div class="content">
                    <div class="text">Donnie’s gettin’ dizzy chasin’ tornados! <a href="#">#auldeytoys</a> <a href="">#nevertoooldfortoys</a> <a href="">#sundayfunday</a> <a href="">#superwings</a></div>
                </div>
            </div>
            <div class="shot s5">
                <img src="http://www.placekitten.com/301/301" alt="" />
                <div class="bottom">
                    <span class="text">@toyfan2002</span>
                    <span class="bg"></span>
                </div>
                <div class="content">
                    <div class="text">Donnie’s gettin’ dizzy chasin’ tornados! <a href="#">#auldeytoys</a> <a href="">#nevertoooldfortoys</a> <a href="">#sundayfunday</a> <a href="">#superwings</a></div>
                </div>
            </div>
        </div>
        <div class="social">
            <p>Follow us on Instagram and share your photos with #AULDEYTOYS!</p>
            <a href="#" class="follow red">
                <div class="social-instagram"></div>
                <span>Follow us @AULDEYTOYS</span>
            </a>
        </div>
        <div class="social">
            <p>Learn about new toys, win cool prizes and more by friending us on Facebook!</p>
            <a href="#" class="follow blue">
                <div class="social-facebook"></div>
                <span>Friend on Facebook</span>
            </a>
        </div>
    </div>
</div>


<?php get_footer(); ?>
