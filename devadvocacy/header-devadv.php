<!doctype html>
<?php
$home = get_home_url();
$class = get_body_class();

$homeActive = in_array('page-template-page-home', $class) ? 'active' : '';
$blogActive = array_intersect(array('blog','single-post'), $class) ? 'class="active"' : '';
$showcaseActive = array_intersect(array('page-template-showcase-home','page-template-showcase-single') , $class) ? 'class="active"' : '';
$searchActive = in_array('page-template-search-results', $class) ? 'active' : '';
$eventActive = in_array('page-template-events', $class) ? 'class="active"' : '';
$serviceActive = in_array('single-doc_page', $class) ? 'active' : '';

?>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>

  <meta charset="utf-8">

  <?php // force Internet Explorer to use the latest rendering engine available ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php wp_title(''); ?></title>

  <?php // mobile meta (hooray!) ?>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1"/>

  <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/ibm-favicon.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/ibm-favicon.png">

  <?php //main stylesheet?>
  <link href="//1.www.s81c.com/common/v18/css/www.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/library/css/style.css">
  <script src="//1.www.s81c.com/common/stats/ida_stats.js"></script>

  <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  <![endif]-->
  <?php // or, set /favicon.ico for IE10 win ?>


  <meta name="msapplication-TileColor" content="#f01d4f">
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/ibm-favicon.png">
  <meta name="theme-color" content="#121212">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

</head>

<body id="ibm-com">

<!-- MASTHEAD_BEGIN -->

  <!-- Masthead mobile -->
<div id="ibm-masthead" role="banner" aria-label="IBM">
  <div id="ibm-mast-options">
    <ul role="toolbar" aria-labelledby="ibm-masthead">
      <li id="ibm-geo" role="presentation">
        <a href="http://www.ibm.com/planetwide/select/selector.html">United States</a>
      </li>
    </ul>
  </div>

  <div id="ibm-universal-nav">

    <div id="ibm-home"><a href="http://www.ibm.com/us-en/">IBM®</a></div>
    <ul id="ibm-menu-links" role="toolbar" aria-label="Site map">
      <li><a href="http://www.ibm.com/sitemap/us/en/">Site map</a></li>
    </ul>

    <div id="ibm-search-module" role="search" aria-labelledby="ibm-masthead">
      <form id="ibm-search-form" action="//www.ibm.com/Search/" method="get">
        <p>
          <label for="q"><span class="ibm-access">Search</span></label>
          <input type="text" maxlength="100" value="" name="q" id="q"/>
          <input type="hidden" value="18" name="v"/>
          <input type="hidden" value="utf" name="en"/>
          <input type="hidden" value="en" name="lang"/>
          <input type="hidden" value="us" name="cc"/>
          <input type="submit" id="ibm-search" class="ibm-btn-search" value="Submit"/>
        </p>
      </form>
    </div>
  </div>
</div>
<!-- MASTHEAD_END -->



  <div class="ibm-sitenav-menu-container ibm-hide" data-sticky="false">
    <div class="ibm-sitenav-menu-name"><a href="<?php echo $home?>">IBM Developer Advocacy</a></div>
    <div class="ibm-sitenav-menu-list">
      <ul role="menubar">
        <li role="presentation" class="ibm-haschildlist ibm-highlight">
          <span role="menuitem">Services</span>
          <ul role="menu">
            <?php
            $type = 'doc_page';
            $args = array( 'post_parent' => 0, 'post_type' => $type);
            $myposts = get_posts( $args );
            foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
            <li role="presentation"><a role="menuitem" href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
            <?php endforeach;
            wp_reset_postdata();?>
          </ul>
        </li>
        <li role="presentation">
          <a href="<?php echo $home?>/blog/#" role="menuitem" href="#">Blog</a>
        </li>
        <li role="presentation">
          <a  href="<?php echo $home?>/showcases/#" role="menuitem" href="#">Showcases</a>
        </li>

        <li role="presentation">
          <a  href="<?php echo $home?>/how-tos/#" role="menuitem" href="#">Search Resources</a>
        </li>

        <li role="presentation">
          <a href="<?php echo $home?>/events/#" role="menuitem" href="#">Events</a>
        </li>
      </ul>
    </div>
  </div>




  <!-- End of all Masthead works -->


  <div id="container" class="container">

    <header class="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

      <div id="inner-header" class="cf">
        <!-- wrap wrap-tc  -->
        <?php // if you'd like to use the site description you can un-comment it below ?>
        <?php // bloginfo('description'); ?>

        <nav class="tray search-resources service-resources">
          <?php get_template_part('partials/tray', 'services'); ?>
          <?php get_template_part('partials/tray', 'search'); ?>
        </nav>

        <nav role="navigation" class="navigation-main">
            <div class="home">
              <a href="<?php echo $home?>"  class="home-link <?php echo $homeActive?>">
                <span>IBM</span> <span class="bold">Developer Advocacy</span>
                <button class="nav-trigger">Open Menu</button>
              </a>
            </div>
          </a>
          <ul class="main-menu">
            <li class="tablet-logo">
              <a href="<?php echo $home?>">
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/IBM-Logo.svg" alt="logo"/>
                </span>
              </a>
            </li>
            <li>
              <a href="#" class="expanded <?php echo $serviceActive?>" data-target="services" >
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/services-icon.svg" alt="services"/>
                </span>
                <span class="title">Services</span>
                <span class="arrow">
                  <svg id="DESIGN" class="cls-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.11 15.73"><polyline points="0.35 0.37 8.38 7.63 0.35 15.37"/></svg>
                </span>
              </a>

              <ul class="sub-menu">
                <li class="back">
                  <a href="#">
                    <span class="arrow">
                      <svg id="DESIGN" class="cls-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.11 15.73"><polyline points="0.35 0.37 8.38 7.63 0.35 15.37"/></svg>
                    </span>
                    <span class="title">Back to Navigation</span>
                  </a>
                </li>
                <?php
                $type = 'doc_page';
                $args = array( 'post_parent' => 0, 'post_type' => $type);
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                <?php endforeach;
                wp_reset_postdata();?>
              </ul>
            </li>
            <li>
              <a href="<?php echo $home?>/blog/#" <?php echo $blogActive?>>
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/blog-icon.svg" alt="blog"/>
                </span>
                <span class="title">Blog</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $home?>/showcases/#" <?php echo $showcaseActive?>>
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/showcases-icon.svg" alt="showcases"/>
                </span>
                <span class="title">Showcases</span>
              </a>
            </li>
            <li class="search-submenu">
              <a href="#" class="expanded special <?php echo $searchActive?>" data-target="search">
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/search-icon.svg" alt="search resources"/>
                </span>
                <span class="title special">Search resources</span>
                <span class="arrow special">
                  <svg id="DESIGN" class="cls-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.11 15.73"><polyline points="0.35 0.37 8.38 7.63 0.35 15.37"/></svg>
                </span>
              </a>

              <ul class="sub-menu">
                <li class="back">
                  <a href="#">
                    <span class="arrow">
                      <svg id="DESIGN" class="cls-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.11 15.73"><polyline points="0.35 0.37 8.38 7.63 0.35 15.37"/></svg>
                    </span>
                    <span class="title">Back to Navigation</span>
                  </a>
                </li>
              </ul>
            </li>
            </li>
            <li>
              <a href="<?php echo $home?>/events/#" <?php echo $eventActive?>>
                <span>
                  <img src="<?php bloginfo('template_url'); ?>/library/images/events-icon.svg" alt="events"/>
                </span>
                <span class="title">Events</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="logo">
        <img src="<?php bloginfo('template_url'); ?>/library/images/IBM-Logo.svg" alt="logo"/>
      </div>
    </header>
