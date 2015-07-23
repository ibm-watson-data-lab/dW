<?php
/**
 * The template is used for displaying standard content in a Doc (hierarchy version)
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                 

	<header class="pn-post-header">
		<h1 class="pn-page-title"><?php the_title(); ?></h1>
	</header>
	
  <?php get_template_part('partials/postmeta', get_post_format() ); ?>

	<div class="pn-copy pn-main-content">
		<?php the_content(); ?>
	</div>
	
	<?php
	// Check if has cats or tags
	if ( has_category() || has_tag() ) :
		get_template_part('partials/taxonomy', get_post_format());
	endif; 
	?>
		
	<!-- this area was deleted to prevent listing child pages -->
  <!-- see version of this file in projectnext to get them back -- RRS -->

	<div id="comments" class="ptl">
	  <div id="respond">
		<?php comments_template(); ?>
	  </div>
	</div>


</article>