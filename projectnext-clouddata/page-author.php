<?php 
/*
Template Name: Default Author
*/

get_header(); ?>

<section class="pn-pcon">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="pn-columns">

	<div class="pn-col-6-6">

	  <div class="mbxl">
				
		<?php 
	  
		if ( function_exists('em_is_events_page') && em_is_events_page() ) {
			$pagetype = 'events';
		} elseif ( function_exists('is_any_event_manager_page') && is_any_event_manager_page() ) {
			$pagetype = 'event';
		} else {
			$pagetype = 'page';
		}
	  
		get_template_part('partials/content-page-author', $pagetype); ?> 

	  </div>
	</div>
			
  </div>
		
<?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>