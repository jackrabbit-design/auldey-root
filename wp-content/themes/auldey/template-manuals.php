<?php /* Template Name: Manuals */ get_header(); the_post(); ?>

<section id="title" class="noimg"><!-- .noimg if no image. padding - half img height + 40 -->
    <h2>SUPPORT</h2>
    <h1>Manuals</h1>
</section>

<section class="callout manual">
    <h3>Looking for a user manual?</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper volutpat erat et consequat. Quisque vestibulum ut ipsum in condimentum. Nulla nunc ligula, dignissim eget laoreet eget, cursus a sem.</p>
</section>

<section id="manual-types">
    <ul>
        <li><span>Search</span></li>
        <li class="active"><span>Browse By Brands</span></li>
    </ul>
</section>


<section id="manual-brands">
    <a href="#" class=" active"><img src="ui/images/logo_waveracers.png" alt="" /></a>
    <a href="#" class=""><img src="ui/images/logo_superwings.png" alt="" /></a>
    <a href="#" class=""><img src="ui/images/logo_racetin.png" alt="" /></a>
    <a href="#" class=""><img src="ui/images/logo_skyrover.png" alt="" /></a>

</section>

<form id="manual-search">
    <div>
        <label for="search">Search</label>
        <input placeholder="Search by keyword or model#" name="search" id="search" type="text" />
    </div>
    <div>
        <label for="brands">Filter by Brands</label>
        <span class="select-menu">
            <select name="brands" id="brands">
                <option value="">Brand 1</option>
                <option value="">Brand 2</option>
                <option value="">Brand 3</option>
                <option value="">Brand 4</option>
                <option value="">Brand 5</option>
            </select>
        </span>
    </div>
    <button class="submit" type="submit">Find it</button>
</form>

<?php
$args = array(
    'post_type' => 'manual',
    'posts_per_page' => 6
);

query_posts($args);
if(have_posts()){
?>

<section id="manual-results">
    <div class="content-main">
        <h3>Wave Racers User Manuals</h3>
    </div>
    <div class="content-main">
        <h4>1 result for</h4>
        <h3>TTYW85819</h3>
    </div>
    <ul id="results">
        <?php while(have_posts()){ the_post(); ?>
            <li><a href="<?php the_field('manual_download') ?>" download class="clearfix">
                <img src="http://www.placekitten.com/144/99" alt="" />
                <p><?php the_title() ?>
                    <small><?php the_field('model_number'); ?></small>
                </p>
            </a></li>
        <?php } ?>
    </ul>
</section>
<?php } ?>

<?php get_footer(); ?>
