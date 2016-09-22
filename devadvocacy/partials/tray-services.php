<?php
/**
 *
 *
 *
 */

?>

<div class="tray-container services">
  <div class="top-content clearfix">
    <div class="intro-text clearfix">
      Services to <span>get</span>, <span>build</span>, and <span>analyze</span> data on the ibm cloud
    </div>
    <div class="close clearfix"><a href="#"><img src="<?php bloginfo('template_url'); ?>/library/images/close-x.png" alt="close"/></a></div>
  </div>

  <div class="service-list">
    <?php
    $type = 'doc_page';
    $args = array(
      'post_parent' => 0,
      'post_type' => $type,
      'numberposts'=>30
    );
    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
    <div class ="service-item clearfix">
      <a href="<?php the_permalink() ?>">
        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="service-icon"><img src="<?php echo $url ?>" alt="thumbnail"/></div><div class="service-title"><?php the_title(); ?></div>
      </a>
      <p>
        <?php
        $excerpt = get_the_excerpt();
        echo wp_trim_words($excerpt, '25');
        ?>
      </p>
    </div>
    <?php endforeach; wp_reset_postdata();?>
  </div>
</div>
