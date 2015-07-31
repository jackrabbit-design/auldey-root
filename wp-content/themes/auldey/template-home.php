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

<?php if(have_rows('brands')){ $i = 1; ?>
    <div id="brand-grid">
        <?php while(have_rows('brands')){ the_row();
            $sq = get_sub_field('brand_image');
            $sq = $sq['sizes']['brand-grid-image'];
            $logo = get_sub_field('brand_logo');
            $logo = $logo['sizes'];
            $mar = $logo['brand-grid-logo-width'] / 2;
            $bot = $logo['brand-grid-logo-height'] / 2;
            $gif = get_sub_field('brand_gif');
            $gif = $gif['url'];
            ?>
            <div class="brand">
                <img class="square static" src="<?php echo $sq; ?>" alt="<?php the_sub_field('brand_name'); ?>" />
                <img class="square anim" src="<?php echo $gif; ?>" alt="<?php the_sub_field('brand_name'); ?>" />
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
    <h2><?php the_field('blue_section_text'); ?></h2>
</div>

<div id="toys">

    <?php if(have_rows('toys_slider')){ ?>
        <div id="toys-slider">
            <?php while(have_rows('toys_slider')){ the_row();
                $img = get_sub_field('toy_image');
                $img = $img['sizes'];
                $feat = $img['toy-slide'];
                $mar = $img['toy-slide-width'] / 2;
                $text = get_sub_field('toy_description');
                $toyLink = get_sub_field('toy_link');
                $brandLink = get_sub_field('brand_link');
                ?>
                <div class="slide">
                    <img src="<?php echo $feat ?>" alt="" style="margin-left:-<?php echo $mar ?>px;" />
                    <div class="popup">
                        <div class="expand"><span>+</span></div>
                        <div class="more">
                            <div class="more-holder clearfix">
                                <?php echo $text ?>
                                <div class="buttons">
                                    <a href="<?php echo get_permalink($toyLink->ID); ?>" class="btn"><span>View Toy</span></a>
                                    <a href="<?php echo $brandLink ?>" class="right">View Superwings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="center">
        <span class="btn more-toys"><span>More Toys</span></a>
    </div>
</div>

<?php

  $username = get_field('instagram_username','options');
  $access_token = get_field('instagram_access_token','options');
  $count = '5'; //How many shots do you want?

  //2 - Include the php class
  include('instagram.php');

  //3 - Instanciate
  if(!empty($username) && $username!='yourusername' && !empty($access_token) && $access_token!='youraccesstoken'){
      $isg = new instagramPhp($username,$access_token); //instanciates the class with the parameters
      $shots = $isg->getUserMedia(array('count'=>$count)); //Get the shots from instagram
  } else {
      echo'Please update your settings to provide a valid username and access token';
  }

?>

<div id="share">
    <div class="wrap">
        <h3><?php the_field('social_small_header'); ?></h3>
        <h2><?php the_field('social_large_header'); ?></h2>
        <div id="instagram">
            <?php if(!empty($shots)){
                //echo $isg->simpleDisplay($shots);
                $i = 1;
                foreach($shots->data as $istg){
                    //echo "<pre>"; print_r($istg); echo "</pre>";
                    $blueText = $istg->caption->text;
                    preg_match('#\[(.*?)\]#', $blueText, $match);
                    ?>
                    <div class="shot s<?php echo $i++ ?>">
                        <img src="<?php echo $istg->images->low_resolution->url ?>" alt="" />
                        <div class="bottom">
                            <span class="text"><?php echo $match[1] ?></span>
                            <span class="bg"></span>
                        </div>
                        <div class="content">
                            <div class="text"><?php echo str_replace($match,'',$blueText) ?></div>
                        </div>
                    </div>
                    <?
                }
            } ?>
        </div>
        <div class="social">
            <p><?php the_field('instagram_callout'); ?></p>
            <a href="<?php the_field('facebook_url','options'); ?>" class="follow red">
                <div class="social-instagram"></div>
            <span><?php the_field('instagram_label'); ?></span>
            </a>
        </div>
        <div class="social">
            <p><?php the_field('facebook_callout'); ?></p>
            <a href="//instagram.com/<?php the_field('instagram_username','options'); ?>" class="follow blue">
                <div class="social-facebook"></div>
                <span><?php the_field('facebook_label'); ?></span>
            </a>
        </div>
    </div>
</div>


<?php get_footer(); ?>
