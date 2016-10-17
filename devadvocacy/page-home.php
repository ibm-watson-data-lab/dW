<?php
  /*
  ** Template Name: Home Page
  **
  ** For more info: http://codex.wordpress.org/Page_Templates
  */
  $home = get_home_url();
?>



<?php get_header('devadv');?>

<div id="content" class="content home-page">

  <div id="inner-content" class="cf hero">
    <div class="wrap">
      <h1>Resources for Developers to <span>Get</span>, <span>Build</span>, and <span>Analyze</span> Data in the IBM Cloud.</h1>

      <div class="hero-btns">
        <a href="<?php echo $home?>/showcases/#" class="project-btn">View Showcases</a>
        <a href="<?php echo $home?>/how-tos/#" class="project-btn">Search Resources</a>
      </div>
    </div>
  </div>

  <div id="inner-content" class="wrap cf home-showcase">
    <section class="showcase-container">
      <div class="dev-intro">
        <div class="intro-text">
          <span>Featured Showcase</span>
        </div>
      </div>
      <hr class="line">

      <?php
        $args = array(
          'order' => 'ASC',
          'post_type'=> 'page',
          'posts_per_page' => 1,
          'tax_query' => array(
            array(
              'taxonomy'=>'custom_cat',
              'field'=>'showcase',
              'terms'=>"229"
            )
          )
        );
        $showcases = get_posts($args);
      ?>

      <?php foreach($showcases as $post):setup_postdata($post); ?>

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
      					<?php endforeach; ?>
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
            <div class="info right">
              <?php the_post_thumbnail('full'); ?>
            </div>
          </div>
        <?php } else { ?>
          <div class="showcase-item">
            <div class="info no-image">
              <a href="<?php echo get_permalink();?>"><h2><?php the_title();?></h2></a>

              <ul class="contribution github-info" data-github="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>">
                <li class="showcase-author"><?php echo get_avatar( $post->post_author);?></li>
                <li class="adv-name"><?php the_author();?></li>
                <li><span>Updated:</span>&nbsp;<span class="featured-updated"></span></li>
                <li><span>Deploys</span>&nbsp;<span class="featured-deploys"></span></li>
                <li><span>Forks:</span>&nbsp;<span class="featured-forks"></span></li>
              </ul>

              <p class ="snippet"><?php echo wp_trim_words(get_the_content(), 75, '...');?></p>

              <ul class="category">
                <?php $categories = get_the_category();
                  foreach($categories as $cat): ?>
                  <li class="blog-category"><a href="#"><?php echo $cat->cat_name; ?></a></li>
                <?php endforeach; ?>
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

      <?php endforeach ?>

    </section>
  </div>


  <div id="inner-content" class="wrap cf resources">
    <div class="dev-intro">
      <div class="intro-text">
        <span>Quick Resources</span>
      </div>
    </div>
    <hr class="line">

    <div class="resource-links">
      <ul class="topic-links">
        <li class="resource-title">Topics</li>
      </ul>
      <ul class="technology-links">
        <li class="resource-title">Technologies</li>
      </ul>
      <ul class="language-links">
        <li class="resource-title">Languages</li>
      </ul>
    </div>

  </div>

  <div class ="bottom-art red slider-container">
    <div id="inner-content" class="wrap cf">
      <div class="bottom-title">
        <h1>Use Cases</h1>
        <hr>
      </div>
      <section class="carousel-container">
        <div class="showcase-carousel">
          <?php
            $use_cases = get_field('use_case');
            foreach($use_cases as $post): setup_postdata($post);
          ?>
          <div class="carousel-item">
            <a href="<?php echo get_permalink();?>"><h2><?php echo wp_trim_words(get_the_title(), 5);?></h2></a>
            <span class="date"><?php the_time('n/j/y');?></span>
            <ul class="contribution">
              <li><?php echo get_avatar($post->post_author);?></li>
              <li class="adv-name"><p><?php the_author();?></p></li>
            </ul>
          </div>
          <?php endforeach;?>

        </div>
      </section>

    </div>
  </div>

  <div id="inner-content" class="cf subscribe wrap" style="display:none">
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
