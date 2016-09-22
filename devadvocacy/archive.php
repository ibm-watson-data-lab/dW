
<?php get_header('devadv'); ?>

			<div id="content" class="content">
				<div class ="top-art">
			    <div class="wrap">
			      <div class="page-title">
							<main id="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
			        <hr>
			      </div>
			    </div>
			  </div>
				<div id="inner-content" class="wrap cf">



							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article class="blog-content" id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header>
									<span class="blog-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
									<div class="byline entry-meta vcard pub-info">
										<span><a href="#"><?php echo get_avatar( $post->post_author);?></a></span>
										<span><?php the_author(); ?></span>
										<span><?php the_time('n/j/y');?></span>
									</div>
								</header>

								<section class="entry-content cf">
									<?php the_excerpt(); ?>
								</section>

								<footer class="article-footer"></footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

				</div>

			</div>

<?php get_footer(); ?>
