<?php
/*
Template Name: Landing Page
*/

get_header(); ?>

<section class="pn-pcon">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="pn-columns">

	<div class="pn-col-6-6">

	  <div class="mbxl">
				
		<?php 
        $pagetype = 'page';
		get_template_part('partials/content', $pagetype); ?> 

	  </div>
	</div>
			
  </div>
		
<?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>