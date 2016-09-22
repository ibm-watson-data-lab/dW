<?php
/*
Template Name: Blog Single Post
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/

?>

<?php get_header('devadv'); ?>

			<div id="content" class="content">
				<?php
					if (have_posts()) : while (have_posts()) : the_post();
						function get_top_ancestor_id(){
							global $post;
							if ($post->post_parent){
								$ancestors = array_reverse(get_post_ancestors($post->ID));
								return $ancestors[0];
							}
							return $post->ID;
						}

						$parent_ID = get_top_ancestor_id();
						$subparent = $post->post_parent;
						function get_kids($id) {
	  					get_children('post_parent='.$id.'&order=ASC&orderby=menu_order&post_status=publish');
						}
					?>
				<div class ="top-art">
					<div class="wrap">
						<div class="page-title">
				      <h1><a href="<?php echo get_permalink($parent_ID); ?>"><?php echo get_the_title($parent_ID);?></a></h1>
				      <hr>
				    </div>
					</div>
				</div>
				<div id="inner-content" class="wrap cf">
          <hr class="line">
          <div class="service-navigation">
            <ul class="navigation-items">
							<?php
							$children = array(
								'child_of'=> get_top_ancestor_id(),
								'post_type'=> 'doc_page',
								'depth'=> "1",
								'title_li'=>""
							);
							$grandchildren= wp_list_pages($children);
							 ?>
            </ul>
					</div>
					<div class="service-content clearfix">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
							<?php if(($subparent != 0) && ($subparent != $parent_ID)):?>
								<h2 class="subparent-title"><?php echo the_title()?></h2>
							<?php endif;?>
							<div class="service-article">
								<?php the_content();?>
							</div>
						</article>
						<div class="related-content">
							<?php
								$subchild = $post->ID;
								$grandparent_get = get_post($subparent);
								$grandparent = $grandparent_get->post_parent;
								if(($grandparent != 0)){
									$sub_family = array(
										'child_of'=> $subparent,
										'post_type'=>"doc_page",
										'depth'=> "",
										'title_li'=> __(get_the_title($subparent)), 'echo'=> 1
									);
									$list_sub_family = wp_list_pages($sub_family);
								} elseif ($subparent != 0){
									$sub_children = array(
										'child_of'=> $post->ID,
										'post_type'=>"doc_page",
										'depth'=> "2",
										'title_li'=> __(get_the_title($subchild)), 'echo' => 1
									);
									$list_sub_children = wp_list_pages($sub_children);
								}
							 ?>
						</div>
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
