<?php
/**
 * Category template
 * 
 * Used to display archive-type pages for posts in a category.
 */

get_header(); 
?>

<section class="pn-pcon">

	<?php 
	// check if there are any posts at all matching a category query
	if (have_posts()) : ?>
		<header class="pn-page-header">
			<h1 class="pn-page-title">
				<?php printf( __( 'Category Archives: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
			</h1>
		</header>
	<?php endif; ?>

  <div class="pn-copy container">
    <div class="row">

		<div class="col-sm-9">
	
			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="pn-archive-meta"><?php echo category_description(); ?></div>
      <?php else : ?>
        <p class="spacemeforbanner"></p>
			<?php endif; ?>
		
			<div class="pn-post-list">
		
				<?php 
				if (have_posts()) : 
					/* Start the loop */
					while (have_posts()) : the_post(); 

						/* 
						 * Include the post format-specific template for the content.
						 */
						get_template_part( 'partials/listing', get_post_format() ); 

					/* End the Loop */
					endwhile; ?>
					
					<div id="page-nav" class="pn-pagination cf">
						<div class="fl"><?php previous_posts_link();?></span></div>
						<div class="fr"><?php next_posts_link(); ?></div>
					</div>
				
				<?php
				else: 
					// No results? Show 'em the "sorry!" content ?>
					<div class="ptxl">
					<?php get_template_part( 'partials/content', 'none' ); ?>
					</div>

				<?php	
				endif; ?>
			</div>
	
		</div>
	
		<div class="col-sm-3 sidebar">
	
			<?php if ( ! have_posts() ) : ?>
			<div class="ptxl">
			<?php endif; ?>
			
				<?php if ( is_active_sidebar('pnext_blog_roll') ) { ?>
		
					<ul class="pn-widgets pn-widgets-blog-roll">
						<?php dynamic_sidebar('pnext_blog_roll'); ?>
					</ul>
		
				<?php } ?>

			<?php if ( ! have_posts() ) : ?>
			<div class="ptxl">
			<?php endif; ?>

	
		</div>
	
	</div>
  </div><!-- end div class=pn-copy container -->
</section>

<?php get_footer(); ?>