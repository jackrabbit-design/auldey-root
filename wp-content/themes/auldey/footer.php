    <footer id="footer" class="clearfix">
        <div class="left">
            <a href="<?php bloginfo('url'); ?>" class="logo"><img src="<?php bloginfo('url') ?>/ui/images/logo-footer.png" alt="<?php bloginfo('name') ?>" /></a>
            <?php the_field('footer_text','options'); ?>
        </div>
        <div class="right">
            <?php if($ig = get_field('instagram_username','options')){ ?>
                <a href="http://www.instagram.com/<?php echo $ig ?>" target="_blank" class="social-instagram external"></a>
            <?php } if($fb = get_field('facebook_url','options')){ ?>
                <a href="<?php echo $fb ?>" target="_blank" class="social-facebook external"></a>
            <?php } ?>
            <p class="jrd">
                <a class="external" href="http://www.jumpingjackrabbit.com" target="_blank">Website Design</a> by <a class="external" href="http://www.jumpingjackrabbit.com" target="_blank">Jackrabbit</a>
            </p>
        </div>
    </footer>

    <div style="display:none;">
        <div class="external-lb">
            <?php the_field('speedbump_body','options'); ?>
            <a href="#" target="_blank" class="btn"><span>Continue</span></a>
            <a href="#" class="right">Back to Auldey</a>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
