<?php 
/*
Template Name: Bare Page
*/

get_header();

if (have_posts()) : while (have_posts()) : the_post();

$pagetype = 'page';
	  
get_template_part('partials/content', $pagetype);

endwhile; endif;

get_footer(); ?>