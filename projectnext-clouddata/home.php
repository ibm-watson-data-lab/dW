<?php
/**
 * Home template
 * 
 * When you set a static home page (Customize > Static Front Page > Front Page), THAT one uses front-page.php
 * The page that you set as the Customize > Static Front Page > Posts Page uses *this* file
 */

get_header(); 
?>

<section class="pn-pcon">

	<header class="pn-page-header">
		<h1 class="pn-page-title">
			<?php 
			// Display page title of static blog home outside the Loop
			// You would not believe how hard this was to figure out
			// http://www.orderofbusiness.net/blog/get-title-for-posts-page-in-wordpress/
			single_post_title(); ?>
		</h1>
	</header>
	
	<p class="intro">
        Tutorials, tips, and perspectives from our advocates.
    </p>

	<div class="pn-columns">

		<div class="pn-col-6-4">
	
			<?php if (have_posts()) : ?>

				<div class="pn-post-list">

					<?php 
						/* Start the loop */
						while (have_posts()) : the_post(); ?>
	
						<?php 
							/* 
							 * Include the post format-specific template for the content.
							 */
							get_template_part( 'partials/listing', get_post_format() ); ?>
		
					<?php 
						/* End the Loop */
						endwhile; ?>				

				</div>
				
				<div id="page-nav" class="pn-pagination cf">
					<div class="fl"><?php previous_posts_link();?></span></div>
					<div class="fr"><?php next_posts_link(); ?></div>
				</div>
			<?php endif; ?>

	
		</div>
	
		<div class="pn-col-6-2">
	
			<?php if ( is_active_sidebar('pnext_blog_roll') ) { ?>
		
				<ul class="pn-widgets pn-widgets-blog-roll">
					<?php dynamic_sidebar('pnext_blog_roll'); ?>
				</ul>
		
			<?php } ?>

	
		</div>
	
	</div>


</section>

<?php get_footer(); ?>