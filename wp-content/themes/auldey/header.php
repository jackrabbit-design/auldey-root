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
    <link type="text/plain" rel="author" href="authors.txt" />
    <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />
    <?php wp_head(); ?>
</head>
<body>
    <!--[if lte IE 7]><iframe src="unsupported.html" frameborder="0" scrolling="no" id="no_ie6"></iframe><![endif]-->

    <header id="header">
        <div class="header-wrap">
            <div class="logo-container">
                <a href="<?php bloginfo('url') ?>" class="logo"><img src="ui/images/logo.png" alt="<?php bloginfo('name') ?>" /></a>
                <span class="red"></span>
            </div>
            <div id="nav-icon"><span></span></div>
            <nav id="nav">
                <!-- <ul>
                    <li class="menu-item-has-children"><a href="#"><span>Brands</span></a>
                        <ul>
                            <li><a href="#">nav item 1</a></li>
                            <li><a href="#">nav item 1</a></li>
                            <li><a href="#">nav item 1</a></li>
                            <li><a href="#">nav item 1</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><span>Videos</span></a></li>
                    <li class="menu-item-has-children"><a href="#"><span>Support</span></a></li>
                    <li><a href="#"><span>Our Story</span></a></li>
                    <li><a href="#"><span>Contact</span></a></li>
                    <li class="search"><a href="#"><span><img src="ui/images/ico-search.png" alt=""/></span></a></li>
                </ul> -->
                <?php wp_nav_menu( array('theme_location' => 'main-menu', 'container' => '', 'menu_class' => '', 'menu_id' => '', 'depth' => 2, 'walker' => new jrd_walker() )); ?>
            </nav>
        </div>
    </header>
