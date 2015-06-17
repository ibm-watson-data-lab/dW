<?php 
/*
Template Name: Connect page
*/


get_header();
?>

<h1>Connect with us</h1>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?php dynamic_sidebar('connect_sidebar'); ?>
        </div>
        <div class="col-md-3 right-column">
            <?php                
                if (have_posts()) : while (have_posts()) : the_post();

                the_content();

                endwhile; endif;
            ?>
        </div>
    </div>
</div>