<?php 
/*
Template Name: Connect page
*/


get_header(); ?>

<section class="pn-pcon">
<header class="pn-page-header">
	<h1 class="pn-page-title"><?php the_title(); ?></h1>
</header>
<div class="pn-copy container">
  <div class="row">
    <div class="col-md-9">
      <?php dynamic_sidebar('connect_sidebar'); ?>
    </div>
    <div class="col-md-3">
      <?php                
      if (have_posts()) : 
        while (have_posts()) : the_post();
          the_content();
      endwhile; endif;
      ?>
    </div>
  </div>
</div>
</section>

<?php get_footer(); ?>