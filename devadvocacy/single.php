<?php
/*
Template Name: Blog Single Post
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/

?>

<?php get_header('devadv'); ?>

			<div id="content" class="blog-single content">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class ="top-art">
					<div class="wrap">
						<div class="page-title">
				      <h1><?php the_title(); ?></h1>
				      <hr>
				    </div>
					</div>
				</div>
				<div id="inner-content" class="wrap cf">
					<hr class="line">
					<div class="blog-content clearfix">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							<div class="blog-author clearfix">
								<div class="more-info"><?php echo get_avatar( $post->post_author);?></div>
								<div class="more-info"><?php the_author();?></div>
								<div><?php the_time('n/j/y'); ?></div>
							</div>

							<div class="modal author">
								<div class="arrow-up"></div>
								<div class="exit clearfix"><a href="#"><img src="<?php bloginfo('template_url'); ?>/library/images/close-x.png" alt="close"/></a></div>
								<div class="clearfix">
									<p><?php the_author();?></p>
									<p><?php echo wp_trim_words(get_the_author_meta('description'), 50);?></p>
									<a class="project-btn" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ))?>">Learn More</a>
								</div>
								<div class="clearfix">
									<span class="modal-subhead">Recent Posts</span>
									<ul class ="recent-posts">
										<?php
										$id = get_the_author_meta('ID');
										$args = array(
												'author'        =>  $id,
												'orderby'       =>  'post_date',
												'order'         =>  'ASC',
												'posts_per_page' => 3
												);
												$recent_posts = get_posts( $args );
												foreach($recent_posts as $post):setup_postdata($post);
											?>
										<li>
											<a class="recent-title" href="<?php echo get_permalink();?>"><?php echo the_title();?></a>
											<span class="excerpt">
												<?php
													$excerpt = get_the_excerpt();
													echo wp_trim_words($excerpt, '15');
												?>
											</span>
										</li>
										<?php endforeach; wp_reset_postdata();?>
									</ul>
								</div>
							</div>

							<div class="blog-article">
								<p>
									<?php the_content();?>
								</p>
							</div>
						</article>
						<aside class="post-aside">
							<ul>
								<?php $categories = get_the_category();
									foreach($categories as $cat): ?>
									<li class="blog-category"><a href="#"><?php echo $cat->cat_name; ?></a></li>
								<?php endforeach; wp_reset_postdata();?>
							</ul>
						</aside>
					</div>

					<div id="comments" class="pn-post-comments">
						<div id="respond">
						<?php comments_template(); ?>
						</div>
					</div>
					<?php endwhile; ?>
					<?php else : ?>
					<article id="post-not-found" class="hentry cf">
						<header class="article-header">
							<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						</header>
						<section class="entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
						</section>
						<footer class="article-footer">
								<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
						</footer>
					</article>
					<?php endif; ?>
				</div>
			</div>

<?php get_footer(); ?>
