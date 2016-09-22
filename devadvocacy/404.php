<?php
/*
Template Name: 404 Page
*
*
* For more info: http://codex.wordpress.org/Page_Templates
*/

?>

<?php get_header('devadv'); ?>

<div id="content" class="content">
  <div class ="top-art">
    <div class="wrap">
      <div class="page-title">
        <h1>404</h1>
        <hr>
      </div>
    </div>
    <div></div>
  </div>
  <div id="inner-content" class="wrap cf">
    <article id="post-not-found" class="hentry cf">
 	    <header class="article-header">
        <h1><?php _e( 'Epic 404 - Article Not Found', 'bonestheme' ); ?></h1>
      </header>
      <section class="entry-content">
        <p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'bonestheme' ); ?></p>
      </section>
    </article>
  </div>

</div>
<?php get_footer(); ?>
