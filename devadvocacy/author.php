<?php
/**
 * Author archive template
 *
 */
 $home = get_home_url();
?>

<?php get_header('devadv'); ?>



<div id="content" class="content">
  <div class ="top-art">
    <div class="wrap">
      <div class="page-title">
        <h1>Developer Advocate:&nbsp;</h1><h1><?php echo get_the_author();?></h1>
        <hr>
      </div>
    </div>
    <div></div>
  </div>
  <div id="inner-content" class="wrap cf developer-advovate">

    <div class="advocate-details clearfix">
      <div class="dev-intro">
        <div class="summary">
          <div class="advocate-image"><?php echo get_avatar($post->post_author);?></div>
          <div class="advocate">
            <h2><?php echo get_the_author();?></h2>
            <p class="city"><?php echo the_author_meta('home_base'); ?></p>
          </div>
        </div>
      </div>
      <div class="advocate-info">
        <p class="bio"><?php the_author_meta("description"); ?></p>
      </div>
    </div>


    <div class="main-section clearfix">
      <div class="section-title">
        <h2>All Posts</h2>
      </div>
      <div class="advocate-posts">
        <?php query_posts($query_string . '&showposts=20'); ?>
        <?php if (have_posts()) : while (have_posts()):the_post(); ?>
        <article class="single-post">
          <div class="post-title">
            <span><a href="<?php the_permalink()?>"><?php the_title(); ?></a></span>
          </div>
          <div class="post-date">
            <span><?php the_time('m/d/y'); ?></span>
          </div>
          <div class="post-summary">
            <p>
              <?php
							 $content = get_the_content();
							 echo wp_trim_words($content, '100');
							?>
            </p>
          </div>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <div class="more-posts"><span>See More</span></div>


    </div>

    <aside class="dev-sidebar clearfix">
      <div class="social">
        <?php if(the_author_meta('website')); ?>
          <a href="<?php echo the_author_meta('website'); ?>" class="site"><?php echo the_author_meta('url'); ?></a>
        <?php ?>
        <?php if(get_the_author_meta('twitter')): ?>
          <a href="http://twitter.com/<?php echo the_author_meta('twitter'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/library/images/twitter.jpg" alt="twitter"/></a>
        <?php endif; ?>
        <?php if(get_the_author_meta('authors_github')): ?>
          <a href="<?php echo the_author_meta('authors_github'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/library/images/github.jpg" alt="github"/></a>
        <?php endif; ?>
        <?php if(get_the_author_meta('linkedin')): ?>
          <a href="<?php echo the_author_meta('linkedin'); ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/library/images/linkedin.jpg" alt="linkedin"/></a>
        <?php endif; ?>
      </div>
      <div class="resource-links">
        <span class="resource-title">Popular Tags</span>
        <ul>
          <?php
            $cats_array = array();
            $args = array(
              'author'=> get_the_author_meta('ID'),
              'showposts'=> -1,
              'caller_get_post'=> 1
            );

            $author_posts = get_posts($args);
            if ($author_posts){
              foreach ($author_posts as $author_post) {
                foreach (get_the_category($author_post->ID) as $category) {
                  $cats_array[$category->term_id] = $category->term_id;
                }
              }
            }
            $cat_ids = implode(',', $cats_array);
            $cat_args = array(
              'title_li'=> '',
              'number'=>10
            );
            wp_list_categories($cat_args);
          ?>
        </ul>
      </div>

      <div class="post-section">
        <div class="section-title">
          <h2>Upcoming Events</h2>
        </div>
        <?php $events = EM_Events::get( array('scope' => 'future', 'limit' => 2) );
          foreach($events as $EM_Event):setup_postdata($EM_Event);
            $name = $EM_Event->event_name;
            $location = $EM_Event->get_location()->location_name;
            $town = $EM_Event->get_location()->location_town;
            $country = $EM_Event->get_location()->location_country;
            $date = $EM_Event->event_start_date;
            $scope_date = strtotime($date);
            $format_date = date("n/j/y", strtotime($date));
        ?>
        <div class="advocate-posts sidebar-posts">
          <article>
            <div class= "post-title">
              <a href="<?php echo $home?>/events"><?php echo $name; ?></a>
              <div class="location"><?php echo $location;?><span>,</span>&nbsp;<?php echo $town;?></div>
            </div>
            <div class="post-date">
              <div><?php echo $format_date; ?></div></div>
            </div>
          </article>
        </div>
          <?php endforeach;?>
      </aside>
    </div>
  </div>
</div>


<?php get_footer(); ?>
