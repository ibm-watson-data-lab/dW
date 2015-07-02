<?php 
/* 
 * Default template for single posts 
 */
get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="pn-pcon">		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
			<div class="pn-single-post-header">
				<header>
					<h1 class="pn-page-title"><?php the_title(); ?></h1>
				</header>
				
			    <?php get_template_part('partials/postmeta', get_post_format() ); ?>

			</div>
			
			<div class="pn-columns">
              
                <p class="intro">
                    Tutorials, tips, and perspectives from our advocates.
                </p>

				<?php if ( is_active_sidebar('pnext_blog_post') ) { ?>
					<div class="pn-col-6-4">
				<?php } else { ?>
					<div class="pn-col-6-6">
				<?php } ?>
					
						<div class="pn-copy">
							<?php the_content(); ?>
						</div>
						
						<div class="cf pn-post-tags-and-share">
							<?php if ( has_tag() ) { ?>
								<div class="fl pn-nav-links pn-tags mrm">
									<?php the_tags( __('Tagged: '), ' / ' ); ?>
								</div>
							<?php } ?>
							
              <!-- This is where I deleted sharing links because we are using JetPack Sharing -->
						</div>
						
						<?php wp_link_pages(); ?>
						
						<div id="comments" class="pn-post-comments">
							<div id="respond">
							<?php comments_template(); ?>
							</div>
						</div>
					
					</div>
		
				<?php if ( is_active_sidebar('pnext_blog_post') ) { ?>
					<div class="pn-col-6-2">
							
						<ul class="pn-widgets pn-widgets-post">
							<?php dynamic_sidebar('pnext_blog_post'); ?>
						</ul>

					</div>
				<?php } ?>

			</div>
			
		</article>
		
	</div>
	
<?php endwhile; endif; ?>	
	

<?php get_footer(); ?>