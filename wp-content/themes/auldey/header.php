<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!--
                                        +
                                      ++++
                                     ++++++
                                    ++++++++
                                   ++++++++++
                                  ++++++++++++
                                  ++++++++++++,
                                 ++++++++++++++
                                 ++++++++++++++,
                                ,+++++++++++++++
                +??????????????333++++++++++++++
            +++++++++++++I3333333333++++++++++++
          ++++++++++++733333333333333+++++++++++
         +++++++++++333333333333333333++++++++++
         +++++++++   333333333333333333+++++++++
         ++++++++     33333333333333333+++++++++
         ++++++        33333333333333333+++++++
         +++++          3333333333333333+++++++
         ++++             33333333333333++++++
         +++                3333333333333++++
          ++                  33333333333+++
                                333333337++
                                   33333++
                                      33+

    -->
    <meta name="MSSmartTagsPreventParsing" content="true" /><!--[if lte IE 9]><meta http-equiv="X-UA-Compatible" content="IE=Edge"/><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title><?php wp_title() ?></title>
    <link type="text/plain" rel="author" href="<?php bloginfo('url') ?>/authors.txt" />
    <link type="image/x-icon" rel="shortcut icon" href="<?php bloginfo('url') ?>/favicon.png" />

    <?php wp_head(); ?>
</head>
<?php $alert = (!isset($_COOKIE['test4']) ? 'alert' : ''); ?>
<body <?php body_class($alert); ?>>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-66527324-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!--[if lte IE 7]><iframe src="unsupported.html" frameborder="0" scrolling="no" id="no_ie6"></iframe><![endif]-->

    <header id="header">
        <div class="header-wrap">
            <div class="logo-container">
                <a href="<?php bloginfo('url') ?>" class="logo"><img src="<?php bloginfo('url') ?>/ui/images/logo.png" alt="<?php bloginfo('name') ?>" /></a>
                <span class="red"></span>
            </div>
            <div id="nav-icon"><span></span></div>
            <nav id="nav">
                <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'depth' => 2, 'walker' => new jrd_walker() )); ?>
            </nav>
        </div>
    </header>
    <?php if(is_user_logged_in()){ ?>
        <div id="alert">
            <div class="wrap clearfix">
                <div class="left">
                    <img src="/ui/images/ico-hazard.png" alt="" />
                    <strong>Safety Recall</strong>
                    <br/>
                    Aero Spin and Aero Cruz Voluntary Recall
                </div>
                <div class="right">
                    <a href="#" class="close">Close</a>
                    <a href="#" class="btn white"><span>Learn More</span></a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(function($){
                $(window).load(function(){
                    if(!Cookies.get('test4')){
                        $('#alert').addClass('active');
                    }
                });
                $("#alert .close").on('click',function(){
                    $('#alert').fadeOut(200,function(){
                        $('body').removeClass('alert');
                    });
                    Cookies.set('test4',true,{
                        expires: 7
                    });
                    return false;
                });
            });
        </script>
    <?php } ?>
