<?php /* Template Name: Contact */ get_header(); the_post(); ?>

<section id="title" class="noimg"><!-- .noimg if no image. padding - half img height + 40 -->
    <h3>Have questions or need some help?</h3>
    <p>Check out our <a href="#">FAQ</a> and <a href="">Manuals</a> and if you don't see what you need, contact customer support at (844)303-8396 or <a href="mailto:customerservice@auldey.us">customerservice@auldey.us</a>.</p>
</section>

<section id="contact">
    <form action="#" class="contact">
        <ul>
            <li class="sm">
                <label for="">Name</label>
                <div class="ginput_container"><input type="text"></div>
            </li>
            <li class="sm">
                <label for="">Email Address</label>
                <div class="ginput_container"><input type="text"></div>
            </li>
            <li>
                <label for="">Messages</label>
                <div class="ginput_container"><textarea></textarea></div>
            </li>
        </ul>
        <div class="gform_footer">
            <button type="submit"><span>Submit</span></button>
        </div>
    </form>
</section>

<?php get_footer(); ?>
