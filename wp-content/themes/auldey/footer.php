    <footer id="footer" class="clearfix">
        <div class="left">
            <a href="<?php bloginfo('url'); ?>" class="logo"><img src="<?php bloginfo('url') ?>ui/images/logo-footer.png" alt="<?php bloginfo('name') ?>" /></a>
            <?php the_field('footer_text','options'); ?>
        </div>
        <div class="right">
            <?php if($ig = get_field('instagram_username','options')){ ?>
                <a href="http://www.instagram.com/<?php echo $ig ?>" target="_blank" class="social-instagram external"></a>
            <?php } if($fb = get_field('facebook_url','options')){ ?>
                <a href="<?php echo $fb ?>" target="_blank" class="social-facebook external"></a>
            <?php } ?>
        </div>
    </footer>

    <div style="display:none;">
        <div class="external-lb">
            <h2>Prepare for Takeoff!</h2>
            <h3>By clicking "continue" you'll be flying off the Auldey web site and landing on a social site. Remember, they have different terms and privacy policies.</h3>
            <p>KIDS, get your parent's permission before visiting other sites and NEVER share any personal info about yourself – including your full name, address and phone number and let your parent or guardian handle any transaction.</p>
            <a href="#" target="_blank" class="btn"><span>Continue</span></a>
            <a href="#" class="right">Back to Auldey</a>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
