<?php get_header(); ?>

    <?php
        $style = 'class="noimg"';
    ?>

    <section id="title" <?php echo $style ?>><!-- .noimg if no image. padding - half img height + 40 -->
        <?php if(isset($_GET['s']) && $_GET['s'] != ''){ ?>
            <h2>Search results for</h2>
            <h1>"<?php echo ucwords(get_query_var('s')) ?>"</h1>
        <?php }else{ ?>
            <h2>Auldey Toys</h2>
            <h1>Search</h1>
        <?php } ?>
    </section>

    <section class="main clearfix">
        <article class="content-main full-width">

            <form action="<?php bloginfo('url'); ?>" method="get" class="search-404 search-page">
                <label for="s">Search</label>
                <input type="search" id="s" name="s" placeholder="Search by keyword or model #" />
                <button type="submit">Find It</button>
            </form>

            <?php if(have_posts()){ ?>

                <div id="everything">
                    <?php while(have_posts()){ the_post() ?>
                        <?php switch($post->post_type){
                            case 'page':
                                if($img = get_field('banner_slider')){
                                    $img = $img[0]['sizes']['search-true'];
                                }elseif($img = get_field('header_image')){
                                    $img = $img['sizes']['search-true'];
                                }

                                if(get_field('callout_title')){
                                    $sub = get_field('callout_title');
                                }elseif(get_field('header_title')){
                                    $sub = get_field('header_title');
                                }

                                if(get_field('callout_text')){
                                    $exc = get_field('callout_text');
                                }elseif(get_field('header_text')){
                                    $exc = get_field('header_text');
                                }else{
                                    $exc = get_the_excerpt();
                                }

                                if($mod = get_field('brand_modules')){
                                    $mod = $mod[0];
                                    $sub = $mod['header'];
                                    $exc = strip_tags($mod['content']);
                                }
                            break;

                            case 'manual':
                                if(has_post_thumbnail(get_field('associated_toy'))){
                                    //$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_field('associated_toy')),'search-sm');
                                    $toy = get_field('associated_toy');
                                    $id = get_post_thumbnail_id($toy);
                                    $img = wp_get_attachment_image_src($id,'search-sm');
                                    $img = $img[0];
                                }
                                $sub = get_field('model_number');
                                $link = get_field('manual_download') .'" download="';
                            break;

                            case 'video':
                                $vidID = get_field('vimeo_id');
                                if(has_post_thumbnail()){
                                    $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'search-true'); $thb = $thb[0];
                                }else{
                                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vidID.php"));
                                    $img = $hash[0]['thumbnail_large'];
                                }
                                $cats = get_the_terms($post->ID, 'video-brand');
                                $catOut = '';
                                for($c = 0; $c < count($cats); $c++){
                                    $catOut .= $cats[$c]->name;
                                    if($c + 1 < count($cats)) $catOut .= ', ';
                                }
                                $sub = $catOut . ' Video';
                            break;

                            case 'toy':
                                $img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'search');
                                $img = $img[0];
                                $cats = get_the_terms($post->ID, 'brand');
                                $catOut = '';
                                for($c = 0; $c < count($cats); $c++){
                                    $catOut .= $cats[$c]->name;
                                    if($c + 1 < count($cats)) $catOut .= ', ';
                                }
                                $sub = $catOut . ' Toy';
                                $exc = get_the_excerpt();
                            break;
                        };
                        if(empty($img)) $img = get_bloginfo('url') . '/ui/images/search-ph.jpg';
                        if(empty($link)) $link = get_permalink();
                        if(empty($sub)) $sub = '';
                        if(empty($exc)) $exc = '';
                        ?>
                        <div class="result clearfix">
                            <div class="image">
                                <?php if($post->post_type == 'video'){ ?>
                                    <a href="http://vimeo.com/<?php echo $vidID ?>" class="lb video">
                                        <img src="<?php echo $img ?>" alt="" /><span class="play"></span>
                                    </a>
                                <?php }elseif($post->post_type == 'manual'){ ?>
                                    <a href="<?php echo $link; ?>">
                                        <img src="<?php echo $img ?>" alt="" />
                                        <img src="<?php bloginfo('url') ?>/ui/images/search-manual.png" class="s-manual" />
                                    </a>
                                <?php }else{ ?>
                                    <a href="<?php echo $link; ?>"><img src="<?php echo $img ?>" alt="" /></a>
                                <?php } ?>
                            </div>
                            <div class="text">
                                <h3><a href="<?php echo $link; ?>"><?php the_title() ?></a></h3>
                                <h4><?php echo $sub; ?></h4>
                                <p><?php echo $exc; ?></p>
                            </div>
                        </div>
                    <?php unset($link); unset($img); unset($sub); unset($exc); } ?>


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
