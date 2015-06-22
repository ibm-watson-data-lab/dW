<?php
/**
 * The template is used for displaying standard content in a page
 * Pretty much identical to content.php but there's no meta bar (no author info) and no category links
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                 

	<header class="pn-page-header">
		<h1 class="pn-page-title"><?php the_title(); ?></h1>
	</header>
	
	<div class="pn-copy container">

		<?php the_content(); ?>
		
	</div>
	
	
	
	<?php
	// Check if has cats or tags
	if ( has_category() || has_tag() ) :
		get_template_part('partials/taxonomy', 'page');
	endif; 
	?>
	
	<?php 
	// remove these. pages shouldn't have comments.
	// temporary fix for comments showing up on wrong sites #95852
	/*
	<div id="comments">
		<div id="respond">
		<?php comments_template(); ?>
		</div>
	</div>
	*/ ?>


</article>