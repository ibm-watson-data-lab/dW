
<?php get_header('devadv'); ?>

	<div id="content" class="content">
		<div class ="top-art">
			<div class="wrap">
				<div class="page-title">
		      <h1>Welcome to the Blog</h1>
		      <hr>
		    </div>
			</div>
		</div>
		<div id="inner-content" class="wrap cf blog-dev-advocates">
			<div class="dev-intro">
				<div class= "intro-text">
					<span>Tutorials, tips, and perspectives from our Developer Advocates</span>

					<div class="dev-images">
						<?php
							$avatar = array(
								'role'=> 'Administrator',
								'number'=> 12,
								'orderby'=>'display_name'
							);
							$user_query = new WP_User_Query($avatar);
							$authors = $user_query->get_results();
							foreach($authors as $author):
								$id=$author->ID;?>
							<div class="adv-lineup"><span class="more-info"><?php echo get_avatar($id);?></span></div>
						<?php endforeach; wp_reset_postdata(); ?>

							<div class="modal advocates">
								<div class="arrow-up"></div>
								<div class="exit clearfix"><a href="#"><img src="<?php bloginfo('template_url'); ?>/library/images/close-x.png" alt="close"/></a></div>
								<div class="intro-text">Our <span>Developer</span> Advocates</div>
								<div class="sub-text">Here to help you realize your most ambitious projects. Reach out.</div>

							<?php
							$args = array(
								'role'=> 'Administrator',
								'orderby'=>'display_name'
							);
							$user_query = new WP_User_Query($args);
							$authors = $user_query->get_results();
								foreach($authors as $author):
									$id=$author->ID;
								?>
								<div class="adv-snippet">
									<div><a href="<?php echo get_author_posts_url($id);?>"><?php echo get_avatar($id);?></a></div>
									<div class="adv-name"><?php echo $author->display_name; ?></php></div>
									<div class="adv-expertise"><?php echo wp_trim_words($author->description, 20);?></div>
								</div>
							<?php endforeach; wp_reset_postdata();?>

							</div>
						</div>

				</div>
				<?php echo do_shortcode( '[jetpack_subscription_form title="Subscribe to Blog Updates" subscribe_text="Enter your email address to get notified of new posts." subscribe_button="Subscribe"]' ); ?>
<!--
<div class="jetpack_subscription_widget"><h2 class="widgettitle">Subscribe to Blog Updates</h2>
	<form id="subscribe-blog-519" accept-charset="utf-8" method="post" action="#">
		<div id="subscribe-text">
			<p>Enter your email address to get notified of new posts.</p>
		</div>
		<p id="subscribe-email">
			<label for="subscribe-field-519" id="jetpack-subscribe-label" style="clip: rect(1px, 1px, 1px, 1px); position: absolute; height: 1px; width: 1px; overflow: hidden;">
				Email Address
			</label>
			<input type="email" placeholder="Email Address" id="subscribe-field-519" value="" class="required" required="required" name="email">
		</p>
		<p id="subscribe-submit">
			<input type="hidden" value="subscribe" name="action">
			<input type="hidden" value="https://developer.ibm.com/clouddataservices2/" name="source">
			<input type="hidden" value="widget" name="sub-type">
			<input type="hidden" value="519" name="redirect_fragment">
			<input type="submit" name="jetpack_subscriptions_widget" value="Subscribe">
		</p>
	</form>

	<div class="success">
		<p>Success! An email was just sent to confirm your subscription. Please find the email now and click activate to start subscribing.</p>
	</div>
</div>
-->
				</div>
			<hr class="line">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="blog-content clearfix">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
					<div class= "blog-title">
						<span><a href="<?php the_permalink() ?>"><?php the_title();?></a></span>
					</div>
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
							<?php
              // $content = get_the_content();
               // echo wp_trim_words($content, '100');
               echo get_the_excerpt();
							?>
						</p>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">Read more &raquo;</a>
					</div>
				</article>
				<aside class="clearfix">
					<ul>
						<?php $categories = get_the_category();
							foreach($categories as $cat): ?>
							<li class="blog-category"><a href="#"><?php echo $cat->cat_name; ?></a></li>
						<?php endforeach; wp_reset_postdata(); ?>
					</ul>
				</aside>
			</div>
		<?php endwhile; else: ?>

			<article id="post-not-found" class="hentry cf">
					<header class="article-header">
						<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
				</header>
					<section class="entry-content">
						<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
				</section>
				<footer class="article-footer">
						<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
				</footer>
			</article>
		<?php endif; ?>
		<?php bones_page_navi(); ?>
		</div>
	</div>

<?php get_footer(); ?>
