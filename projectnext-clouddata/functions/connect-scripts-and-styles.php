<?php


// ----------------
// load project next scripts 
// ----------------
if ( ! function_exists( 'pnext_scripts' ) ) {
function pnext_scripts() {

	// figure out current site location
	$url = ( isset($_SERVER["HTTPS"]) && "on" === strtolower($_SERVER["HTTPS"]) ) ? 'https' : 'http';
	$url .= '://' . $_SERVER["SERVER_NAME"];
	
	// PNext common
	wp_enqueue_style('pnext_common', $url . '/c/css/common.css', FALSE, '0.5.2', 'screen');	

	// PNext parent theme styles
	wp_enqueue_style( 'pnext', get_template_directory_uri().'/style.css', array('pnext_common'), '2.1.1', 'screen');
	
	// Child theme styles
	// Child style.css will come after the parent theme's style.css
	// This method is more performant than WP's recommended "@include" in the child style.css
	if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/style.css' ) )
		wp_enqueue_style( 'pnext-child', (get_stylesheet_directory_uri() . '/style.css'), array('pnext'), '2.1', 'screen' );
	
	// Coremetrics - version number is fake
  wp_enqueue_script('coremetrics', ("//www.ibm.com/common/stats/ida_production.js"), false, '1.1', false);  
  // NetInsight includes
	// DISABLED 26 June 2014; these introduce an unreasonable delay on clicks
  //wp_enqueue_script('netinsight', ("//www.ibm.com/common/stats/stats.js"), false, '1.0', true);

	// replace stock jquery with Google CDN latest jquery
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',false,'1.11.1');
	
	// Modernizr
	wp_enqueue_script('modernizr', $url . '/c/js/modernizr-production.js', false, '2.7.2');
	
	wp_register_script('pnext_dropdown', $url .'/c/js/dropdowns.js', array('jquery'), '1.1', true);
	
	wp_enqueue_script('jquery');
	wp_enqueue_script('pnext_utilities', ( get_template_directory_uri() . '/js/util.js' ), array('jquery'), '0.0.5', true);
	wp_enqueue_script('google-analytics', ( get_template_directory_uri() . '/js/google-analytics.js' ), false, '1.1', true );
	
	// child theme Google Analytics
	// just put a /js/google-analytics.js file there and it'll auto-enqueue
	// see the /projectnext-wasdev/ example for the minimal JS required
	if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/js/google-analytics.js' ) )
		wp_enqueue_script( 'child-google-analytics', ( get_stylesheet_directory_uri() . '/js/google-analytics.js' ), array('google-analytics') , '1.0', true);
	
	
	// register (not enqueue) some scripts for WASdev
	wp_register_script('download-overlay', ( get_template_directory_uri() . '/js/download-overlay.js' ), array('jquery'), '1.1', true);
	wp_register_script('count-down', ( get_template_directory_uri() . '/js/count-down.js' ), array('jquery'), '1.0');
	
	wp_enqueue_script('pnext-nav-tree', (get_template_directory_uri() . '/js/pnext.jquery.nav-tree.js'), array('jquery'), '1.0.1', true );
}
}
add_action('wp_enqueue_scripts','pnext_scripts');


// ------------------------------
// Queue up CSS if there's a custom option
// Priority is such that it *should* come after parent + child style.css
// 
// @priority 30
//  - pnext parent styles are @ 10
//  - child theme styles are (usually) @ 20
// ------------------------------
	
if ( ! function_exists('pnext_enqueue_uploaded_css') ) {
function pnext_enqueue_uploaded_css() {

  $css = get_theme_option('custom_css_file');
  
  // link is protocol relative 
  // (as it might not have been saved with the correct scheme before we were all-SSL)
  
  if ( $css ) 
	wp_enqueue_style('pnext_custom', str_replace( array('http://','https://'), '//', $css ), FALSE, '', 'screen');
}
}
add_action('wp_enqueue_scripts', 'pnext_enqueue_uploaded_css', 30);

// -------------------------------
// Admin scripts
// -------------------------------

function pnext_connect_admin_enqueue_scripts() {
	
	$screen_id = get_current_screen()->id;
	
	// Select2 multi-select widget
	// http://ivaynberg.github.io/select2/
	wp_register_style( 'select2', (get_template_directory_uri() . '/admin/select2.css'), '', '3.4.3', 'screen' );
	wp_register_script( 'select2', (get_template_directory_uri() . '/admin/select2.min.js'), array('jquery','jquery-ui-autocomplete', 'jquery-ui-sortable'), '3.4.3' );
	
	// Mostly these are for the pnext theme options page
	wp_register_style('pnext_options_page', get_template_directory_uri() . '/admin/options_page.css');
	wp_register_script('pnext_options_page', get_template_directory_uri() . '/admin/options_page.js', array('select2'), '1.1', true );
	
	// featured developers widgets
	wp_register_script( 'connect_featured_developers_widget', get_template_directory_uri() . '/js/connect-featured-developers-widget.js', array('select2'), '1.0', true );

	// Check that this is an admin page, or else enqueue functions are risky	
	if ( 'appearance_page_pnext_theme_options' === $screen_id  ) {

		// WP 3.5+ new media dialog
		wp_enqueue_media();
		
		// additional script/style requirements
		// for Meet The Team / Featured Developers selection
		wp_enqueue_script( array( 'select2', 'pnext_options_page' ) );
		wp_enqueue_style( array( 'select2', 'pnext_options_page' ) );

	}
	
	// scripts/styles for Featured Developers widget
	if ( 'widgets' === $screen_id ) {
		wp_enqueue_script( 'connect_featured_developers_widget' );
		wp_enqueue_style( array( 'select2', 'pnext_options_page' ) );
	}
}
add_action('admin_enqueue_scripts', 'pnext_connect_admin_enqueue_scripts');
