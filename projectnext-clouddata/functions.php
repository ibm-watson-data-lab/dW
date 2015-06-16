<?php 

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

<h3>"Connect page" extra user info</h3>

    <table class="form-table">
    
        <!-- Title -->
        <tr>
            <th><label for="author_title">Your title and location</label></th>
            <td>
                <input type="text" name="author_title" id="author_title" value="<?php echo esc_attr( get_the_author_meta( 'author_title', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">e.g.: Developer Advocate, UK</span>
            </td>
        </tr>
        
       
        <!-- website -->
        <tr>
            <th><label for="author_website">Website</label></th>
            <td>
                <input type="text" name="author_website" id="author_website" value="<?php echo esc_attr( get_the_author_meta( 'author_website', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">e.g.: http://www.happyfuntimes.com, including http/https.</span>
            </td>
        </tr>
        
        
        <!-- github -->
        <tr>
            <th><label for="author_github">Github username</label></th>
            <td>
                <input type="text" name="author_github" id="author_github" value="<?php echo esc_attr( get_the_author_meta( 'author_github', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">e.g.: ocelotpotpie</span>
            </td>
        </tr>
        
        
        <!-- twitter -->
        <tr>
            <th><label for="author_twitter">Twitter</label></th>
            <td>
                <input type="text" name="author_twitter" id="author_twitter" value="<?php echo esc_attr( get_the_author_meta( 'author_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">e.g.: ocelotpotpie (no @)</span>
            </td>
        </tr>
        
        
        <!-- linkedin -->
        <tr>
            <th><label for="author_linkedin">Linkedin</label></th>
            <td>
                <input type="text" name="author_linkedin" id="author_linkedin" value="<?php echo esc_attr( get_the_author_meta( 'author_linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Full URL, including http/https.</span>
            </td>
        </tr>
        
        
        <!-- presentation sharing -->
        <tr>
            <th><label for="author_pres_sharing">Presentation sharing</label></th>
            <td>
                <input type="text" name="author_pres_sharing" id="author_pres_sharing" value="<?php echo esc_attr( get_the_author_meta( 'author_pres_sharing', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Full URL, including http/https.</span>
            </td>
        </tr>
        
        
        <!-- stackoverflow -->
        <tr>
            <th><label for="author_stackoverflow">Stack Overflow</label></th>
            <td>
                <input type="text" name="author_stackoverflow" id="author_stackoverflow" value="<?php echo esc_attr( get_the_author_meta( 'author_stackoverflow', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Full URL, including http/https.</span>
            </td>
        </tr>
            
    </table>


<?php }
    
    
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    update_usermeta( $user_id, 'author_title', $_POST['author_title'] );
    update_usermeta( $user_id, 'author_website', $_POST['author_website'] );
    update_usermeta( $user_id, 'author_github', $_POST['author_github'] );
    update_usermeta( $user_id, 'author_twitter', $_POST['author_twitter'] );
    update_usermeta( $user_id, 'author_linkedin', $_POST['author_linkedin'] );
    update_usermeta( $user_id, 'author_pres_sharing', $_POST['author_pres_sharing'] );
    update_usermeta( $user_id, 'author_stackoverflow', $_POST['author_stackoverflow'] );
}

?>