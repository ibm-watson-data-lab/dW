      <footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

        <div id="inner-footer" class="wrap cf">
          <div class="footer-github">
            <h1 class="resource-logo">
              <a target="_blank" href="https://github.com/ibm-cds-labs"><img class="github-logo" src="<?php bloginfo('template_url'); ?>/library/images/github-logo-lt.png" alt="Github"/></a>
            </h1>
            <h2>Recent Updates</h2>
            <ul>
            </ul>
          </div>
          <ul class="footer-blog">
            <?php
              $args = array(
                'posts_per_page'=> 1,
                'orderby'=> 'post_date',
                'order'=> 'DESC',
                'post_type'=>'post'
              );
              query_posts($args);
              while ( have_posts() ) : the_post();
            ?>
            <li class="resource">Blog</li>
            <li>Recent Post</li>
            <li><a href="<?php the_permalink() ?>"><?php echo the_title(); ?></a></li>
            <li><?php the_time('n/j/y'); ?></li>
            <li class="snippet">
              <?php
              $excerpt = get_the_excerpt();
              echo wp_trim_words($excerpt, '15');
              ?>
            </li>
            <li class="snippet">
              <span class="avatar"><?php echo get_avatar( $post->post_author);?></span>
              <span class="name"><?php the_author();?></span>
            </li>
          <?php endwhile; wp_reset_query();?>
          </ul>
        </div>
      </footer>

    <!-- This div is opened in header-devadv.php -->
    </div>

    <?php // all js scripts are loaded in library/bones.php ?>
    <?php wp_footer(); ?>


    <script>
      digitalData = {
          page: {
              category: {
                  primaryCategory: 'Replace'              //formerly IBM.WTMCategory meta tag
              },
              pageInfo: {
                  effectiveDate: 'Replace',       //formerly IBM.Effective meta tag
                  expiryDate: 'Replace',          //formerly IBM.Expires meta tag
                  language: 'en-US',                  //formerly DC.Language meta tag
                  publishDate: 'Replace',         //formerly DC.Date meta tag, same as dcterms.date
                  publisher: 'Replace',       //formerly DC.Publisher meta tag
                  version: 'v18',                     //version part of Source meta tag (e.g. v17)
                  ibm: {
                      contentDelivery: 'Replace', //"delivery" portion of Source meta tag
                      contentProducer: 'Replace', //"authoring" portion of the Source meta tag
                      country: 'US',                  //formerly IBM.Country meta tag, same as geo.country
                      industry: 'ZZ',                 //formerly IBM.Industry meta tag
                      owner: 'Corporate Webmaster/New York/IBM',  //formerly Owner meta tag
                      subject: 'Replace',             //formerly DC.Subject meta tag
                      type: 'Replace'                 //formerly DC.Type meta tag
                  }
              }
          }
      };
      // Page-testing specific:
  </script>

  <script src="//1.www.s81c.com/common/v18/js/www.js"></script>

  <script type="text/javascript">
    IBMCore.common.util.config.set({
      "masthead":{
        "type":"alternate",
        "sticky": {
            "enabled": false
        }
      }
    });
  </script>

  <script type="text/javascript" 
      src="https://ibm-cds-labs.github.io/dW/js/tracker.js" 
      siteid="cds.devcenter" 
      trackerurl="http://simple-logging-service-ms.mybluemix.net/tracker">
  </script>

  </body>
</html> <!-- end of site. what a ride! -->
