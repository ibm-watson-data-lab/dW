<?php 
/* 
Primary top menu bar 
Includes: 
  - logo/site name
  - "main" nav menu
  - search (set google CSE ID in Project Next Theme Options)
  - Customized CSS for the above
*/
?>

<?php
// Output Theme modifications  ?>
<style>
.links-top-menu a,
.links-top-menu a:visited,
.navbar-inner .nav-links > li > a { 
  color: <?php echo get_theme_mod('main_menu_linkcolor'); ?>; 
}

.links-top-menu a:hover,
.links-top-menu a:focus,
.navbar-inner .nav-links > li > a:hover,
.navbar-inner .nav-links > li > a:focus { 
  color: <?php echo get_theme_mod('main_menu_linkcolor_hover'); ?>;
}

.link-home a,
.link-home a:visited { color: <?php echo get_theme_mod('main_menu_homecolor'); ?>; }

.link-home a:hover,
.link-home a:focus { 
  color: <?php echo get_theme_mod('main_menu_homecolor_hover'); ?>; 
}


.pn-top-menu {
	font-family: "HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial, sans-serif;
  font-weight: 200;
  border-top-color: <?php echo get_theme_mod('main_menu_bordertop'); ?>;
  <?php 
  $direction = get_theme_mod('main_menu_gradient_direction');
  $webkit_direction = $direction === 'vertical' ? 'top' : 'left';
  $w3c_direction = $direction === 'vertical' ? 'to bottom' : 'to right';
  $top = get_theme_mod('main_menu_gradienttop');
  $bottom = get_theme_mod('main_menu_gradientbottom');
  echo "background: $bottom; /* Old browsers */
  background: -webkit-linear-gradient($webkit_direction, $top 0%,$bottom 100%); /* Chrome10+,Safari5.1+ */
  background: linear-gradient($w3c_direction, $top 0%, $bottom 100%); /* W3C */
  "; ?>
  border-bottom-color: <?php echo get_theme_mod('main_menu_borderbottom'); ?>;
}

.pn-nav-search-input {
  border-color: <?php echo get_theme_mod('main_menu_searchborder'); ?>;
  <?php
  $top = get_theme_mod('main_menu_searchgradienttop');
  $bottom = get_theme_mod('main_menu_searchgradientbottom');
  $transition = get_theme_mod('main_menu_searchfocustransition');
  $final = get_theme_mod('main_menu_searchfocusfinal');
  echo "
  background: $bottom; /* Old browsers */
  background: transparent -webkit-linear-gradient(top, $top 0,$bottom 35px, $transition 150px, $final 185px); /* Chrome10+,Safari5.1+ */
  background: transparent linear-gradient(to bottom,  $top 0,$bottom 35px, $transition 150px, $final 185px); /* W3C */
  background-position: left top;
  background-size: 100% 185px;	
  "; ?>
}

<?php 
// Firefox adds a red glow around [required] inputs if you leave it blank after entering something 
?>
.pn-nav-search-input[required] {
  box-shadow: none;
}

.pn-nav-home,
.pn-top-menu .menu-item {
  line-height: 2;
  white-space: nowrap;
}

.pn-nav-home {
	display: block;
	font-size: 1em;
	text-transform: uppercase;
	letter-spacing: 1.5px;
	font-weight: bold;
	text-shadow: 0 1px #333333;
	margin-right: 2.75em;
	margin-left: 2.2em;
}

.pn-logo-image {
	margin: 0;
	padding: 0;
	display: block;
	max-width: none !important;
	height: auto !important;
}

.pn-top-menu .menu-item {
  float:left; /* use float, not inlines, to avoid line-breaks between words */
	margin-right: 2em;
	<?php
	$link_margin_top = get_theme_mod('main_menu_link_margin_top');
	if ($link_margin_top)
	  echo "margin-top: $link_margin_top;";
	?>
}

.pn-search {
<?php 
$search_margin_top = get_theme_mod('main_menu_search_margin_top');
if ($search_margin_top)
  echo "margin-top: $search_margin_top;";
?>
}

.pn-btn {
  color: #fff !important;
}

.pn-btn,
.pn-btn-primary {
  background-color: <?php echo get_theme_mod('button_primary'); ?>;
}

.pn-btn:hover,
.pn-btn:focus,
.pn-btn-primary:hover,
.pn-btn-primary:focus {
  background-color: <?php echo get_theme_mod('button_primary_hover'); ?>;
}

.pn-btn-secondary { 
  background-color: <?php echo get_theme_mod('button_secondary'); ?>;
}

.pn-btn-secondary:hover,
.pn-btn-secondary:focus {
  background-color: <?php echo get_theme_mod('button_secondary_hover'); ?>;
}

<?php 
if (get_theme_mod('button_3d')) : ?>

.pn-btn {
  text-shadow: rgba(0,0,0,.25) 0 -1px 0;
  border: 1px solid #eee;
  border-color: rgba(255, 255, 255, 0.25) rgba(255, 255, 255, 0.2) rgba(255, 255, 255, 0.10);
  <?php if (get_theme_mod('button_3d_dark_border')) : ?>
    border-color: #666;
    border-color: rgba(0,0,0,.25);
  <?php endif; ?>

  box-shadow: inset 0 -1px 3px rgba(255,255,255,.2),
        0 1px 5px rgba(0,0,0,.33);

  background-image: -webkit-linear-gradient(top, rgba(255,255,255,.20) 0%, rgba(255,255,255,0) 100%);
  background-image: linear-gradient(to bottom, rgba(255,255,255,.20) 0%, rgba(255,255,255,0) 100%);
}
<?php 
endif; ?>

.pn-btn-nav-menu {
  vertical-align: middle;
  padding-left: 1.428571429em;
  padding-right: 1.428571429em;
}
</style>

<div id="<?php if(is_front_page()){ ?>pnext-top-menu-home<?php } else { ?>pnext-top-menu<?php } ?>" class="pn-top-menu links-top-menu" role="navigation" aria-label="<?php _e('Main navigation'); ?>">    
  <div class="flag">
    <span class="cds-logo"></span>
    <span class="link-home flag-img">
      <a rel="home" class="pn-nav-home" href="<?php echo home_url(); ?>"><?php 				
        if ( get_theme_option('logo') ) {
          echo '<img class="pn-logo-image" src='. str_replace( array('http://','https://'), '//', get_theme_option('logo') ) .' alt="'. get_bloginfo( 'name' ) .'" />';
        } else {
          echo get_bloginfo( 'name' ); 
        }
      ?></a>
    </span>

    <?php
    if ( has_nav_menu( 'main' ) ) : ?>

      <?php 
      $main_menu = wp_nav_menu( array( 
        'theme_location' => 'main',
        'container_class' => 'pn-top-menu-container flag-bd flag-expand',
        'depth' => defined('DOING_AJAX') ? 1 : 0, // limit depth to 1 level with remote requests,
        'echo' => false, // store it, don't output
        ) 
      );
      
      if ( has_nav_menu('main_button') ):
      
        // build the nav menu for the button
        $try_it_menu = wp_nav_menu( array(
          'theme_location' => 'main_button',
          'depth' => 1,
          'container' => 'false', // remove <div> wrap
          'items_wrap' => '%3$s', // remove <ul> wrap
          'echo' => false,
          )
        );
        
        // tack classes onto the link
        // hacky, but easy enough
        $try_it_menu = str_replace( '<a href', '<a data-analytics-category="Menu interaction" data-analytics-action="Clicked action button" data-analytics-label="'.get_bloginfo( 'name' ).'" class="pn-btn pn-btn-secondary pn-size-small pn-btn-nav-menu" href', $try_it_menu );
        
        // tack the list item onto the main menu
        // Kind of fragile: depends on </ul></div> to close the menu
        $main_menu = str_replace( '</ul></div>', $try_it_menu . '</ul></div>', $main_menu);
      
      endif;
      
      echo $main_menu;

      /* 
       * Events (event, location, etc) are NOT WP Pages, so they don't trigger ancestor classes in the navigation.
       * See #80356
       */
       if ( is_any_event_manager_page() ) : ?>
        <script>
          // Event Manager adds EM_URI global variable that points to top-level Events pg
          var events_page_url = '<?php echo EM_URI; ?>';
  
          $('#pnext-menu-container') // scope the query 
            .find('a[href="'+events_page_url+'"]') // find the link with that URL
            .first() // only one!
            .parent() // find its LI 
            .addClass('current-page-ancestor');
        </script>
      <?php endif ; ?>

    <?php
    endif; ?>

    <!--<div class="flag-bd">
      <?php get_template_part('partials/search-form'); ?>
    </div>-->

  </div>
  
  
  <?php if(is_front_page()){ ?>
  
    <div class="hero-text">
      <h2>Resources for developers to</h2>
      <h2><a href="">get</a>, <a href="">build</a>, and <a href="">analyze</a> data on the IBM Cloud.</h2>
      
      <div class="get-started-btn"><a href=""><span>Get Started</span></a></div>
    </div>
  
  <?php } ?>
  
</div>