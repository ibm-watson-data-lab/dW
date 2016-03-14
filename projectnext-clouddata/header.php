<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes();?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes();?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes();?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes();?> class="pn-sticky-footer no-js"> <!--<![endif]-->
<head>
<meta name="google-site-verification" content="ZOQeHRygaaWj2MxEwU36AgbPigyRTIM9RmNd6jwoNUk" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />

<meta name="IBM.WTMSite" content="DWNEXT"/>

<meta name=viewport content="width=device-width, initial-scale=1">

<!-- 
Force IE8+ into Standards mode by default (now done with http header)
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
 -->

<title><?php wp_title (' ', true); ?></title>

<?php 
get_template_part('partials/header-before-wp-head'); 

wp_head(); 

get_template_part('partials/header-after-wp-head'); 
?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/css/favicon.ico" /> 
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="//rawgit.com/ibm-cds-labs/dW/master/css/styles.css"> -->
<!-- <link rel="stylesheet/less" type="text/css" href="//rawgit.com/ibm-cds-labs/dW/master/css/styles.less"> -->
<link rel="stylesheet" type="text/css" href="//rawgit.com/ibm-cds-labs/dW/master/css/styles_less.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//metrics-collector.mybluemix.net/tracker.js" siteid="cds.search.engine"></script>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!-- This is the CSE for a topical site. It must be loaded in head, before google search Form -->
<?php  
	$google_cse_id = get_theme_option('google_cse_id');
	$google_cse_filter_id = get_theme_option('google_cse_filter_id');
	
	if ( $google_cse_id ) : ?>

	<script>//<![CDATA[ 

		(function() {

			var cx = '<?php echo $google_cse_id; ?>';
			var hq = '<?php echo $google_cse_filter_id; ?>';

			var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
			gcse.type = 'text/javascript';
			gcse.async = true;

			gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +

			'//www.google.com/cse/cse.js?cx=' + cx + ( hq ? '&hq=more:' + hq : '');

			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);

		})();//]]> 

	</script>
<?php endif; ?>
</head>

<body <?php body_class(); ?> >

	<?php 
	// ---------------------------------
	// Skip links
	// ---------------------------------
	get_template_part('partials/skip-links'); 

	// ---------------------------------
	// Devworks Federation Global Top Nav Bar 
	// ---------------------------------
	get_template_part('partials/devworks-federation-bar'); 

	// ---------------------------------
	// Microsite main menu + search
	// ---------------------------------	
	get_template_part('partials/top-menu-bar');
	?>

    <div id="pnext-main" class="mbxl pn-sticky-footer-body<?php if(!is_front_page()){ ?> container<?php } ?>" role="main">
