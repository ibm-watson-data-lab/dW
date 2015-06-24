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

<nav id="<?php if(is_front_page()){ ?>pnext-top-menu-home<?php } else { ?>pnext-top-menu<?php } ?>" class="navbar navbar-inverse">    
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#CDSnav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <span class="navbar-brand">
                <a rel="home" href="<?php echo home_url(); ?>">
                    <span><?php echo get_bloginfo( 'name' ); ?></span>
                </a>
            </span>
        </div>
        
    <?php
    if ( has_nav_menu( 'main' ) ) : ?>

      <?php 
      $main_menu = wp_nav_menu( array( 
        'theme_location' => 'main',
        'container_class' => 'collapse navbar-collapse',
        'container_id' => 'CDSnav',
        'menu_class' => 'nav navbar-nav navbar-right',
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
    
    </div>
  
</nav>  
<?php if(is_front_page()){ ?>

<div id="hero-text" class="hidden-xs">
    <div class="hero-text-container">
        <p>Resources for developers to</p>
        <p><span>get</span>, <span>build</span>, and <span>analyze</span> data on the IBM Cloud.</p>
      
        <div class="get-started-btn"><a href="./get-started"><span>Get Started</span></a></div>
    </div>
</div>

<?php } ?>
