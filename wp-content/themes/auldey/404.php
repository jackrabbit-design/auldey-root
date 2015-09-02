<?php get_header(); ?>

    <section id="title" class="noimg fourohfour"><!-- .noimg if no image. padding - half img height + 40 -->
        <h3>Uh oh! That page can’t be found.</h3>
        <p>We’ll get the crew right on that. Until then, <a href="<?php bloginfo('url') ?>">head back home</a>.</p>
    </section>

    <section class="main clearfix fourohfour">
        <img src="<?php bloginfo('url') ?>/ui/images/404.png" alt="" class="img-404" />
        <form action="<?php bloginfo('url'); ?>" method="get" class="search-404">
            <label for="s">Search</label>
            <input type="search" id="s" name="s" placeholder="Search Auldey" />
            <button type="submit">Find It</button>
        </form>
    </section>

    <hr/>

<?php get_footer(); ?>
