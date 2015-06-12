<!DOCTYPE html>
<!--[if lt IE 7]>      <html <?php language_attributes();?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes();?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes();?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes();?> class="pn-sticky-footer no-js"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />

<meta name="IBM.WTMSite" content="DWNEXT"/>

<meta name=viewport content="width=device-width, initial-scale=1">

<!-- 
Force IE8+ into Standards mode by default (now done with http header)
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
 -->

<title><?php wp_title ('|', true); ?></title>

<?php 
get_template_part('partials/header-before-wp-head'); 

wp_head(); 

get_template_part('partials/header-after-wp-head'); 
?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/css/favicon.ico" /> 
<link rel="stylesheet" href="https://rawgit.com/ibm-cds-labs/dW/master/css/styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>


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
	<script type="text/javascript">
		var qparams='';
	    if (document.URL.indexOf("?") > -1) {
		    var qparams = document.URL.split('?')[1];
	    }
		$(document).ready(function(){
			$('a').each(function() {
				var href = this.href;
				if (qparams != '') {
					if (href.indexOf("?") > -1) {
						href = href + '&' + qparams;
					} else {
						href = href + '?' + qparams;
					}
					$(this).attr('href', href);
				}
			});
		});
	</script>
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

    <div id="pnext-main" class="mbxl pn-sticky-footer-body" role="main">