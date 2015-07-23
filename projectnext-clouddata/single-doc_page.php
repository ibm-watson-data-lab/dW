<?php
/**
 * Single Doc (Hierarchical) view
 * 
 */

get_header(); 

get_template_part('partials/docs_leadspace');
?>

<section class="pn-pcon ptl">

<div class="pn-columns row">
  <div class="col-sm-3">
	<?php 
	// check if there are any posts at all matching a category query
	if (have_posts()) : 
	?>
	  <nav class="">
		
    <h3 class="visuallyhidden" id="pn-nav-tree-title">Contents</h3>
		<ul class="pn-nav-tree" role="tree" aria-labelledby="pn-nav-tree-title">

		<?php 
		// init custom Walker that outputs nicer Tree markup
		$walker = new Pnext_Walker();
		
		wp_list_pages( array(
		  'post_type' => get_query_var('post_type'),
		  'depth' => 3,
		  'show_date' => '',
		  'title_li' => '', // removes top <li>
		  'walker' => $walker,
		) ); 
		?>
		</ul>		  
	  </nav>
	<?php 
	endif; 
	?>
	
	<?php 
	if ( is_active_sidebar('pnext_docs_listing_sidebar') ) :
	?>

	  <ul class="pn-widgets pn-widgets-docs-roll mtxl">
		<?php dynamic_sidebar('pnext_docs_listing_sidebar'); ?>
	  </ul>

	<?php 
	endif; 
	?>
  
  </div>
	<div class="col-sm-9">
		<?php 
		if (have_posts()) : 
		
		  while (have_posts()) : 
		    the_post();
		    
			get_template_part('/partials/content','doc_page');
		  
		  endwhile;

		else: 
		
		  // No results? Show 'em the "sorry!" content ?>
		  <div class="ptxl">
		  <?php get_template_part( 'partials/content', 'none' ); ?>
		  </div>
		
		<?php
		endif; // end if have posts ?>
	</div>
</div>

</section>


<?php
get_footer();
