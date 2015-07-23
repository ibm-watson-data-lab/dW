<?php
/**
 * Default footer/meta information for post listings
 * Includes an avatar of the author.
 */

// There's a theme option for showing authors on Docs
$post_type = get_post_type();
$is_doc = $post_type === "doc" || $post_type === "doc_page";
$show_author = (! $is_doc) || get_theme_option('docs_have_authors');
?>

<footer class="pn-post-meta pn-post-data-with-avatar">

	<div class="flag links-std">
		<?php 
		if ($show_author): ?>
		<div class="flag-img pn-meta-avatar">
			<span class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 42); ?>
			</span>
		</div>
		<?php
		endif; ?>

		<div class="flag-bd">
			<?php 
			if ($show_author): ?>
        <span class="pn-meta-author">
        <?php the_author_posts_link(); ?> 
        </span>
        <span class="pn-meta-divider">/</span> 
      <?php
      endif; ?>

			<span class="pn-meta-date">
			<?php the_time(get_option('date_format')); ?>
			</span>
			<?php 
		</div>

	</div>

</footer>