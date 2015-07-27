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
        <?php the_content(); ?>
    </div>
    <div class="gallery">
        <img src="http://www.placekitten.com/525/364" alt="" />
        <div class="gallery-small">
            <span class="x" style="background-image:url(http://www.placekitten.com/79/82)" data-big="http://www.placekitten.com/525/364"></span>
            <span style="background-image:url(http://www.placekitten.com/78/79)" data-big="http://www.placekitten.com/525/365"></span>
            <span style="background-image:url(http://www.placekitten.com/78/81)" data-big="http://www.placekitten.com/525/366"></span>
        </div>
    </div>
</section>

<section id="demo">
    <h3>See it in Action</h3>
    <h2>Demo Video</h2>
    <a href="#" class="video">
        <img src="ui/images/vid-lg.jpg" alt="" />
        <span class="light"></span>
        <span class="dark"></span>
        <div class="text">
            <h4>Waveracers</h4>
            <h3>Lorem ipsum loop set</h3>
        </div>
        <span class="play"></span>
    </a>
    <a href="#" class="btn"><span>More Videos</span></a>
</section>

<section id="more-toys">
    <h3>Even more toys</h3>
    <h2>You'll Love</h2>
    <div class="toys clearfix">
        <div class="toy">
            <img src="http://www.placekitten.com/270/195" alt="">
            <h4>Frenzy XT</h4>
        </div>
        <div class="toy">
            <img src="http://www.placekitten.com/270/195" alt="">
            <h4>Frenzy XT</h4>
        </div>
        <div class="toy">
            <img src="http://www.placekitten.com/270/195" alt="">
            <h4>Frenzy XT</h4>
        </div>
    </div>
    <a href="#" class="btn"><span>More Waveracers</span></a>
</section>

<section id="purchase">
    <h4>Where to purchase WaveRacer toys</h4>
    <div class="stores">
        <div class="store"><img src="http://placekitten.com/185/43" alt="" /></div>
        <div class="store"><img src="http://placekitten.com/77/102" alt="" /></div>
        <div class="store"><img src="http://placekitten.com/182/50" alt="" /></div>
    </div>
</section>

<?php get_footer(); ?>