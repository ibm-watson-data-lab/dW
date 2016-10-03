<?php
/*
Template Name: Single Showcase Page
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
  </div>
  <div class="showcase-single">
    <div id="inner-content" class="wrap cf">
      <div class="project-updated">
        <span>Updated:</span>&nbsp;<span class="git-updated"></span>
      </div>
      <div class="project-access">
        <span>
          <a target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>"><img class="github-logo-dk" src="<?php bloginfo('template_url'); ?>/library/images/github-logo-dk.png" alt="Github"/></a>
        </span>
        <a href="#">
          <iframe class="fork-num" frameborder="0" scrolling="0" width="158px" height="30px"></iframe>
        </a>
        <?php
          $gh_hash = md5(get_post_meta(get_the_ID(), 'github_repo', TRUE));
          $bluemix_btn = get_post_meta(get_the_ID(), 'bluemix_url', TRUE);
          if ($bluemix_btn=='')
          {?>
        <?php } else { ?>
          <a href="<?php echo get_post_meta(get_the_ID(), 'bluemix_url', TRUE);?>">
          <img class="bluemix-btn" src="https://deployment-tracker.mybluemix.net/stats/<?php echo $gh_hash; ?>/button.svg" alt="deploy"/>
          </a>
        <?php } ?>
      </div>
      <div class="github-info" data-github="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>">
        <ul class="categories-list">
          <li class="key">Categories</li>
          <?php echo get_the_category_list();?>
        </ul>
        <ul>
          <li class="key">Language</li>
          <li class="git-language"></li>
          <li class="key">Updated</li>
          <li class="git-updated"></li>
        </ul>
        <ul>
          <li class="key">Watchers</li>
          <li class="git-watch"></li>
          <li class="key">Stars</li>
          <li class="git-stargazers"></li>
        </ul>
        <ul>
          <li class="key">Contributors</li>
          <li class="git-contributors"></li>
          <li class="key">Issues</li>
          <li class="git-issues"></li>
        </ul>
        <ul>
          <li class="key">Pull requests</li>
          <li class="git-requests"></li>
          <li class="key">Forks</li>
          <li class="git-forks"></li>
        </ul>
      </div>
      <article>
        <?php  the_content();?>
        <div class="showcase-single-cta">
          <?php
            $bluemix_btn = get_post_meta(get_the_ID(), 'bluemix_url', TRUE);
            if ($bluemix_btn=='')
            {?>
          <?php } else { ?>
            <a target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'bluemix_url', TRUE);?>">
              <img src="https://deployment-tracker.mybluemix.net/stats/<?php echo $gh_hash; ?>/button.svg" alt="deploy"/>
            </a>
          <?php } ?>
          <a target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'github_repo', TRUE);?>" class="project-btn">View on Github</a>
        </div>
      </article>
    </div>
  </div>
  <div class ="bottom-art blue slider-container">
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
              <li><?php echo get_avatar( $post->post_author);?></li>
              <li class="adv-name"><p><?php the_author();?></p></li>
            </ul>
          </div>
          <?php endforeach;?>
        </div>
      </section>
    </div>
  </div>
  <div id="inner-content" class="cf wrap comments">
    <hr class="line">
    <div id="comments" class="pn-post-comments">
      <div id="respond">
      <?php comments_template(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
