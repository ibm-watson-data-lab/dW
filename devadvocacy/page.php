<?php
/*
Template Name: Default Template
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/?>

<?php get_header('devadv'); ?>

<div id="content" class="content">
  <div class ="top-art">
    <div class="wrap">
      <div class="page-title">
        <h1><?php the_title(); ?></h1>
        <hr>
      </div>
    </div>
  </div>

  <div id="inner-content" class="wrap cf">
    <div>
      <?php  the_content();?>
    </div>
    <hr class="line">
    <div id="comments" class="pn-post-comments">
      <div id="respond">
      <?php comments_template(); ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
