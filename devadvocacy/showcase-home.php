<?php
/*
Template Name: Showcase Home Page
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
        <h1><?php the_title(); ?></h1>
        <hr>
      </div>
    </div>
    <div></div>
  </div>
  <div id="inner-content" class="wrap cf">

    <section class="showcase-container">
    <?php
      $args = array(
        'orderby' => 'menu_order', 
        'order' => 'ASC',
        'post_type'=> 'page',
        'tax_query' => array(
          array(
            'taxonomy'=>'custom_cat',
            'field'=>'showcase',
            'terms'=>"229"
          )
        )
      );
      $showcases = get_posts($args);
        foreach($showcases as $post):setup_postdata($post);
      ?>
      <?php if ( has_post_thumbnail() ) { ?>
      <div class="showcase-item">
        <div class="info left">
          <a href="<?php echo get_permalink();?>"><h2><?php the_title();?></h2></a>
          <ul class="contribution github-info" data-github="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>">
            <li class="showcase-author"><?php echo get_avatar( $post->post_author);?></li>
            <li class="adv-name"><?php the_author();?></li>
            <li><span>Updated:</span>&nbsp;<span class="featured-updated"></span></li>
            <li><span>Deploys</span>&nbsp;<span class="featured-deploys"></span></li>
            <li><span>Forks:</span>&nbsp;<span class="featured-forks"></span></li>
          </ul>
          <p class ="snippet"><?php echo wp_trim_words(get_the_content(), 50, '...');?></p>
          <ul class="category">
            <?php $categories = get_the_category();
              foreach($categories as $cat): ?>
              <li class="blog-category"><a href="#"><?php echo $cat->cat_name; ?></a></li>
            <?php endforeach;?>
          </ul>
          <div class="showcase-cta">
            <a href="<?php the_permalink(); ?>" class="project-btn">Details</a>
            <?php
              $bluemix_btn = get_post_meta(get_the_ID(), 'bluemix_url', TRUE);
              if ($bluemix_btn=='')
            {?>
            <?php } else { ?>
              <a href="<?php echo get_post_meta(get_the_ID(), 'bluemix_url', TRUE);?>" class="bluemix"><img src="<?php bloginfo('template_url'); ?>/library/images/bluemix.png" alt="deploy"/></a>
            <?php } ?>
          </div>
        </div>
        <div class="info right">
          <?php the_post_thumbnail('full'); ?>
        </div>
      </div>
      <?php } else { ?>
      <div class="showcase-item" data-github="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>">
        <div class="info no-image">
          <a href="<?php echo get_permalink();?>"><h2><?php the_title();?></h2></a>
          <ul class="contribution">
            <li class="showcase-author"><?php echo get_avatar( $post->post_author);?></li>
            <li class="adv-name"><?php the_author();?></li>
            <li><span>Updated:</span><span></span></li>
            <li>Deploys</li>
            <li>Forks</li>
          </ul>
          <p class ="snippet"><?php echo wp_trim_words(get_the_content(), 75, '...');?></p>
          <ul class="category">
            <?php $categories = get_the_category();
              foreach($categories as $cat): ?>
              <li class="blog-category"><a href="#"><?php echo $cat->cat_name; ?></a></li>
            <?php endforeach;?>
          </ul>
          <div class="showcase-cta">
            <a href="<?php the_permalink(); ?>" class="project-btn">Details</a>
            <?php
              $bluemix_btn = get_post_meta(get_the_ID(), 'bluemix_url', TRUE);
              if ($bluemix_btn=='')
            {?>
            <?php } else { ?>
              <a target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'bluemix_url', TRUE);?>" class="bluemix"><img src="<?php bloginfo('template_url'); ?>/library/images/bluemix.png" alt="deploy"/></a>
            <?php } ?>
          </div>
        </div>
      </div>
        <?php } ?>
      <?php endforeach;?>

    </section>
  </div>
  <div id="inner-content" class="cf subscribe wrap">
    <hr class="line">
    <h2>Email Subscription</h2>
    <p class="subscribe-text">Sign up and receive quarterly updates on the latest services for IBM Developer Service</p>
    <div class="sign-up">
      <?php
        if ( function_exists( 'ninja_forms_display_form' ) ) {
          ninja_forms_display_form( 1 );
        }
        ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
