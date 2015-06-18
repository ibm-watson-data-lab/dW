<?php
defined( 'ABSPATH' ) OR exit;

// -----------------------------------------
// Additional meta fields on profile page
// -----------------------------------------

add_action( 'show_user_profile', 'connect_add_developer_user_fields' );
add_action( 'edit_user_profile', 'connect_add_developer_user_fields' );
add_action( 'personal_options_update', 'connect_update_developer_user_fields' );
add_action( 'edit_user_profile_update', 'connect_update_developer_user_fields' );

if ( ! function_exists('connect_add_developer_user_fields') ) {
  function connect_add_developer_user_fields( $user ) {

	  /* 
	   * Unnecessary, says I: you'll only see a profile page 
	   * if you can edit users or yourself 
	   */
	  /*
	  if ( ! current_user_can( 'edit_users' ) )
		  return;
	  */
		
	  wp_nonce_field( 'connect_user_profile_update', 'connect_user_profile_nonce' );
	  ?>
	
	  <h3>&ldquo;Connect page&rdquo; additional information</h3>
	  <table class="form-table">
		<tr>
		  <th><label for="connect_developer_nickname"><?php _e( "Developer nickname"); ?></label></th>
		  <td>
			  <input 
				class="regular-text" 
				type="text" 
				id="connect_developer_nickname" 
				name="connect_developer_nickname" 
				value="<?php echo esc_attr( get_user_meta( $user->ID, 'connect_developer_nickname', true ) ); ?>" />
		  </td>
		</tr>
	  </table>
  <?php
  }
}

if ( ! function_exists( 'connect_update_developer_user_fields' ) ) {
  function connect_update_developer_user_fields( $user_id ) {
	if ( isset( $_POST['connect_developer_nickname'] ) ) {
	  check_admin_referer( 'connect_user_profile_update', 'connect_user_profile_nonce' );
	  update_user_meta( $user_id, 'connect_developer_nickname', ( isset( $_POST['connect_developer_nickname'] ) ? esc_html( $_POST['connect_developer_nickname'] ) : '' ) );
	}
  }
}


function connect_developers( $users = '', $layout = 'strip', $strip_header = 'Brought to you by developers' ) {

  // input could be a comma-separated string
  $users = ( gettype($users) === 'string' ) ? explode( ',', $users ) : $users;
  
  if ( empty($users) || empty($users[0]) )
	return;

  // build associative array of users
  $devs = array();
  
  $total_users = count($users);
  
  // have to do it this way to maintain chosen order
  foreach( $users as $id ) {

    $dev = get_user_by( 'id', $id );
    $meta = get_user_meta( $id );
    $twitter = ! empty( $meta['author_twitter'][0] ) ? $meta['author_twitter'][0] : '';
    $twitter = str_replace('@', '', $twitter); // strip @, just in case
    $nickname = ! empty( $meta['connect_developer_nickname'][0] ) ? $meta['connect_developer_nickname'][0] : '';
    $title = ! empty ( $meta['author_title'][0] ) ? $meta['author_title'][0] : '';
    $website = ! empty ( $meta['author_website'][0] ) ? $meta['author_website'][0] : '';
    $github = ! empty ( $meta['author_github'][0] ) ? $meta['author_github'][0] : '';
    $linkedin = ! empty ( $meta['author_linkedin'][0] ) ? $meta['author_linkedin'][0] : '';
    $pres_sharing = ! empty ( $meta['author_pres_sharing'][0] ) ? $meta['author_pres_sharing'][0] : '';
    $stackoverflow = ! empty ( $meta['author_stackoverflow'][0] ) ? $meta['author_stackoverflow'][0] : '';
    $description = ! empty ( $meta['description'][0] ) ? $meta['description'][0] : '';
        
    $devs[] = array(
      'display_name' => $dev->display_name,
      'user_id' => $id,
      'twitter' => $twitter,
      'twitter_url' => 'https://twitter.com/' . $twitter,
      'nickname' => $nickname,
      'title' => $title,
      'website' => $website,
      'github' => $github,
      'linkedin' => $linkedin,
      'pres_sharing' => $pres_sharing,
      'stackoverflow' => $stackoverflow,
      'bio' => $description,
      'avatar_large' => get_avatar( $id, 150, '', $dev->display_name ),
      'avatar_small' => get_avatar( $id, 48, '', $dev->display_name ),
      'posts_url' => get_author_posts_url($id),
    );
  }
  
    if ( 'strip' === $layout ) { ?>          
            
        <h3 class="our-developer-advocates"><?php _e($strip_header); ?></h3>
    
        <?php
        foreach ($devs as $dev):
      
        extract($dev);
        ?>
        
	    <div class="row advocate-row advocate-<?php echo $total_users; ?>">
		    <div class="col-md-3">
    		    <div class="advocate-photo">
        		    <?php echo $avatar_large; ?>
                </div>
		    </div>
		    
		    <div class="col-md-9">
    		    <div class="advocate-name">
                    <h3><a href="<?php echo $posts_url; ?>"><?php echo $display_name; ?></a></h3>
                </div>
                <div class="advocate-position">
                    <h4><?php echo $title; ?></h4>
                </div>
                <div class="advocate-bio">
                    <p><?php echo $bio; ?></p>
                </div>
    		    
    		    <ul class="advocate-social">
                    <?php if ( $website ) { ?>
                        <li class="advocate-social-website"><a href="<?php echo $website; ?>" target="_blank">
                          <span class="icon-website"><img src="//rawgit.com/ibm-cds-labs/dW/master/images/rss-icon.png"/>
                          </span></a></li>
                    <?php }
                        
                    if ( $github ) { ?>
                        <li class="advocate-social-github"><a href="//www.github.com/<?php echo $github; ?>" target="_blank">
                          <span class="icon-github"><img src="//rawgit.com/ibm-cds-labs/dW/master/images/GitHub-Mark-32px.png"/>
                          </span></a></li>
                    <?php }
                        
                    if ( $twitter ) { ?>
                        <li class="advocate-social-twitter"><a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank">
                          <span class="icon-twitter"><img src="//rawgit.com/ibm-cds-labs/dW/master/images/twitter.png"/>
                          </span></a></li>
                    <?php }
                    
                    if ( $linkedin ) { ?>
                         <li class="advocate-social-linkedin"><a href="<?php echo $linkedin; ?>" target="_blank">
                           <span class="icon-linkedin">
                             <img src="//rawgit.com/ibm-cds-labs/dW/master/images/In-2C-48px-R.png"/>
                           </span></a></li>
                    <?php }
                    
                    if ( $pres_sharing ) { ?>
                        <li class="advocate-social-pres-sharing"><a href="<?php echo $pres_sharing; ?>" target="_blank">
                          <span class="icon-pres-sharing">
                            <img src="//rawgit.com/ibm-cds-labs/dW/master/images/speakerdeck.png"/>
                          </span></a></li>
                    <?php }
                    
                    if ( $stackoverflow ) { ?>
                        <li class="advocate-social-stackoverflow"><a href="<?php echo $stackoverflow; ?>" target="_blank">
                          <span class="icon-stackoverflow">
                            <img src="//rawgit.com/ibm-cds-labs/dW/master/images/stack-exchange.png"/>
                          </span></a></li>
                    <?php } ?>
    		    </ul>
                
		    </div>
        </div>

        <?php endforeach; ?>
  
  <?php
  }
  
  if ( 'sidebar' === $layout ) {
    ?>
    <ul class="pn-il">
    
      <?php
      foreach ($devs as $dev) :
      
        extract($dev); 
        ?>
        
        <li class="pn-il-item mrs mbs">
          <a href="<?php echo $posts_url;?>" title="<?php echo $display_name; ?>">
          <?php echo $avatar_small; ?>
          </a>
        </li>
      
      <?php
      endforeach; ?>
    
    </ul>
  <?php
  }

}

/*
	The rest of this is handled as theme options. See ../admin/admin-menu.php
*/
