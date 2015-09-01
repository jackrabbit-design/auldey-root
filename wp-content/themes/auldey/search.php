<?php get_header(); ?>

    <?php
        $style = 'class="noimg"';
    ?>

    <section id="title" <?php echo $style ?>><!-- .noimg if no image. padding - half img height + 40 -->
        <h2>Search results for</h2>
        <h1>"<?php echo ucwords(get_query_var('s')) ?>"</h1>
    </section>

    <section class="main clearfix">
        <article class="content-main full-width">
            <?php set_query_var('posts_per_page',5);
            if(have_posts()){ ?>

                <div id="everything">
                    <?php while(have_posts()){ the_post() ?>
                        <pre><?php echo $post->post_type ?></pre>
                        <div class="result">
                            <div class="text">
                                <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
                                <?php the_excerpt() ?>
                            </div>
                        </div>
                    <?php } ?>


                    <section id="pagination">
                        <?php echo paginate_links(array(
                            'show_all' => true,
                            'before_page_number' => '<span>',
                            'after_page_number' => '</span>',
                            'prev_text' => '<span>&#9668; Prev</span>',
                            'next_text' => '<span>Next &#9658;</span>'
                        )); ?>
                    </section>
                </div>

            <?php } wp_reset_query(); ?>

        </article>
    </section>

<?php get_footer(); ?>
