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
        <input placeholder="Search by keyword" name="search" id="search" type="text" />
    </div>
    <div>
        <label for="brands">Filter by Brands</label>
        <span class="select-menu">
            <select name="brand" id="brands">
                <option value="">All Brands</option>
                <?php
                $terms = get_terms( 'video-brand' );
                foreach($terms as $t){
                ?>
                    <option value="<?php echo $t->slug ?>"><?php echo $t->name ?></option>
                <?php } ?>

            </select>
        </span>
    </div>
    <button class="submit" type="submit">Find it</button>
</form>

<section id="manual-brands" class="init">
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 4, 'video-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_waveracers.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 12, 'video-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_superwings.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 13, 'video-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_racetin.png" alt="" />
        </a>
    <a href="#" data-brand="<?php
        $term = get_term_by('id', 3, 'video-brand');
        echo $term->slug
        ?>"
        data-name="<?php echo $term->name; ?>">
            <img src="<?php bloginfo('url') ?>/ui/images/logo_skyrover.png" alt="" />
        </a>
</section>

<?php
$args = array(
    'post_type' => 'video',
    'posts_per_page' => -1
);

if(isset($_GET['search']) && !empty($_GET['search'])){
    $args = array_merge($args,array('s' => $_GET['search']));
}
if(isset($_GET['brand']) && !empty($_GET['brand'])){
    $args = array_merge($args,array(
        'tax_query' => array(array(
            'taxonomy' => 'video-brand',
            'field' => 'slug',
            'terms' => $_GET['brand']
        ))
    ));
}

query_posts($args);
if(have_posts()){
?>

    <section id="manual-results">
        <div class="content-main">
            <h3 class="sort-text">
                <?php if(isset($_GET['search']) && !empty($_GET['search'])){ ?>
                    Results for "<?php echo strtoupper($_GET['search']) ?>"
                <?php }else{ ?>
                    <span>All</span> Videos
                <?php } ?>
                <?php if(isset($_GET['brand']) && !empty($_GET['brand'])){ ?>
                    in <?php $b = get_term_by('slug',$_GET['brand'],'video-brand'); echo $b->name ?>
                <?php } ?>
            </h3>
        </div>
        <ul id="results" class="videos">
            <?php while(have_posts()){ the_post();
                $cats = get_the_terms($post->ID, 'video-brand');
                $catOut = '';
                $catSlug = '';
                for($c = 0; $c < count($cats); $c++){
                    $catOut .= $cats[$c]->name;
                    if($c + 1 < count($cats)) $catOut .= ', ';
                    $catSlug .= $cats[$c]->slug;
                }
                $vidID = get_field('vimeo_id');
                if(has_post_thumbnail()){
                    $thb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'vid-grid'); $thb = $thb[0];
                }else{
                    $hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/$vidID.php"));
                    $thb = $hash[0]['thumbnail_large'];
                }
                ?>
                <li data-brand="<?php echo $catSlug ?>">
                    <a href="https://vimeo.com/<?php echo $vidID ?>" class="lb video">
                        <img src="<?php echo $thb ?>" alt="" /><span class="play"></span>
                    </a>
                    <h3><?php the_title() ?></h3>
                    <p><?php echo $catOut; ?></p>
                </li>
            <?php } ?>
        </ul>
    </section>

<?php }else{ ?>
    <div id="manual-results" class="content-main center">
        <h3 class="sort-text">Results for "<?php echo strtoupper($_GET['search']) ?>"</h3>
        <p><br/>Sorry, no videos could be found.</p>
    </div>
<?php } ?>

<?php get_footer(); ?>
