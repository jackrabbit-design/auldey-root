    <footer id="footer" class="clearfix">
        <div class="left">
            <a href="<?php bloginfo('url'); ?>" class="logo"><img src="<?php bloginfo('url') ?>ui/images/logo-footer.png" alt="<?php bloginfo('name') ?>" /></a>
            <?php the_field('footer_text','options'); ?>
        </div>
        <div class="right">
            <?php if($ig = get_field('instagram_username','options')){ ?>
                <a href="http://www.instagram.com/<?php echo $ig ?>" target="_blank" class="social-instagram"></a>
            <?php } if($fb = get_field('facebook_url','options')){ ?>
                <a href="<?php echo $fb ?>" target="_blank" class="social-facebook"></a>
            <?php } ?>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
