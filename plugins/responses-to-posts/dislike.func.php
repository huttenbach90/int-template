<?php
/* Enqueue scripts for dislike system */
function disliker() {
	wp_enqueue_script( 'idev_unlike_post', plugins_url( 'disliker.ajax.js' , __FILE__ ), array('jquery'), '1.0', 1 );
	wp_localize_script( 'idev_unlike_post', 'ajax_var', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' )
		)
	);
}
add_action( 'init', 'disliker' );

/* Save dislike data */
add_action( 'wp_ajax_nopriv_idev-post-unlike', 'idev_post_unlike' );
add_action( 'wp_ajax_idev-post-unlike', 'idev_post_unlike' );
function idev_post_unlike() {
	$nonce = $_POST['nonce'];
    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Nope!' );
	
	if ( isset( $_POST['idev_post_unlike'] ) ) {
	
		$post_id = $_POST['post_id']; // post id
		$post_unlike_count = get_post_meta( $post_id, "_post_unlike_count", true ); // post like count
		
		if ( function_exists ( 'wp_cache_post_change' ) ) { // invalidate WP Super Cache if exists
			$GLOBALS["super_cache_enabled"]=1;
			wp_cache_post_change( $post_id );
		}
		
		if ( is_user_logged_in() ) { // user is logged in
			$user_id = get_current_user_id(); // current user
			$meta_POSTS = get_user_option( "_unliked_posts", $user_id  ); // post ids from user meta
			$meta_USERS = get_post_meta( $post_id, "_user_unliked" ); // user ids from post meta
			$liked_POSTS = NULL; // setup array variable
			$liked_USERS = NULL; // setup array variable
			
			if ( count( $meta_POSTS ) != 0 ) { // meta exists, set up values
				$liked_POSTS = $meta_POSTS;
			}
			
			if ( !is_array( $liked_POSTS ) ) // make array just in case
				$liked_POSTS = array();
				
			if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
				$liked_USERS = $meta_USERS[0];
			}		

			if ( !is_array( $liked_USERS ) ) // make array just in case
				$liked_USERS = array();
				
			$liked_POSTS['post-'.$post_id] = $post_id; // Add post id to user meta array
			$liked_USERS['user-'.$user_id] = $user_id; // add user id to post meta array
			$user_likes = count( $liked_POSTS ); // count user likes
			
			if ( !AlreadyLikedPost( $post_id ) ) {
				if ( !AlreadyUnLiked( $post_id ) ) { // like the post
					update_post_meta( $post_id, "_user_unliked", $liked_USERS ); // Add user ID to post meta
					update_post_meta( $post_id, "_post_unlike_count", ++$post_unlike_count ); // +1 count post meta
					update_user_option( $user_id, "_unliked_posts", $liked_POSTS ); // Add post ID to user meta
					update_user_option( $user_id, "_user_unlike_count", $user_likes ); // +1 count user meta
					echo $post_unlike_count; // update count on front end

				} else { // unlike the post
					$pid_key = array_search( $post_id, $liked_POSTS ); // find the key
					$uid_key = array_search( $user_id, $liked_USERS ); // find the key
					unset( $liked_POSTS[$pid_key] ); // remove from array
					unset( $liked_USERS[$uid_key] ); // remove from array
					$user_likes = count( $liked_POSTS ); // recount user likes
					update_post_meta( $post_id, "_user_unliked", $liked_USERS ); // Remove user ID from post meta
					update_post_meta($post_id, "_post_unlike_count", --$post_unlike_count ); // -1 count post meta
					update_user_option( $user_id, "_unliked_posts", $liked_POSTS ); // Remove post ID from user meta			
					update_user_option( $user_id, "_user_unlike_count", $user_likes ); // -1 count user meta
					echo $post_unlike_count; // update count on front end
					
				}
			}else{
					echo $post_unlike_count;
			}
			
		} else { // user is not logged in (anonymous)
			$ip = $_SERVER['REMOTE_ADDR']; // user IP address
			$meta_IPS = get_post_meta( $post_id, "_user_unlike_IP" ); // stored IP addresses
			$liked_IPS = NULL; // set up array variable
			
			if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
				$liked_IPS = $meta_IPS[0];
			}
	
			if ( !is_array( $liked_IPS ) ) // make array just in case
				$liked_IPS = array();
				
			if ( !in_array( $ip, $liked_IPS ) ) // if IP not in array
				$liked_IPS['ip-'.$ip] = $ip; // add IP to array
			if ( !AlreadyLikedPost( $post_id ) ) {
				if ( !AlreadyUnLiked( $post_id ) ) { // like the post
					
					update_post_meta( $post_id, "_user_unlike_IP", $liked_IPS ); // Add user IP to post meta
					update_post_meta( $post_id, "_post_unlike_count", ++$post_unlike_count ); // +1 count post meta
					echo $post_unlike_count;// update count on front end
					
				} else { // unlike the post
					$ip_key = array_search( $ip, $liked_IPS ); // find the key
					unset( $liked_IPS[$ip_key] ); // remove from array
					update_post_meta( $post_id, "_user_unlike_IP", $liked_IPS ); // Remove user IP from post meta
					update_post_meta( $post_id, "_post_unlike_count", --$post_unlike_count ); // -1 count post meta
					echo $post_unlike_count; // update count on front end
					
				}
			}else{
					echo $post_unlike_count;
			}
		}
	}
	
	exit;
}

/* Test if user already liked post */
function AlreadyUnLiked( $post_id ) { // test if user liked before
	if ( is_user_logged_in() ) { // user is logged in
		$user_id = get_current_user_id(); // current user
		$meta_USERS = get_post_meta( $post_id, "_user_unliked" ); // user ids from post meta
		$liked_USERS = ""; // set up array variable
		
		if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
			$liked_USERS = $meta_USERS[0];
		}
		
		if( !is_array( $liked_USERS ) ) // make array just in case
			$liked_USERS = array();
			
		if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
			return true;
		}
		return false;
		
	} else { // user is anonymous, use IP address for voting
	
		$meta_IPS = get_post_meta( $post_id, "_user_unlike_IP" ); // get previously voted IP address
		$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
		$liked_IPS = ""; // set up array variable
		
		if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
			$liked_IPS = $meta_IPS[0];
		}
		
		if ( !is_array( $liked_IPS ) ) // make array just in case
			$liked_IPS = array();
		
		if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
			return true;
		}
		return false;
	}
	
}

function AlreadyLikedPost( $post_id ) { // test if user liked before
	if ( is_user_logged_in() ) { // user is logged in
		$user_id = get_current_user_id(); // current user
		$meta_USERS = get_post_meta( $post_id, "_user_liked" ); // user ids from post meta
		$liked_USERS = ""; // set up array variable
		
		if ( count( $meta_USERS ) != 0 ) { // meta exists, set up values
			$liked_USERS = $meta_USERS[0];
		}
		
		if( !is_array( $liked_USERS ) ) // make array just in case
			$liked_USERS = array();
			
		if ( in_array( $user_id, $liked_USERS ) ) { // True if User ID in array
			return true;
		}
		return false;
		
	} else { // user is anonymous, use IP address for voting
	
		$meta_IPS = get_post_meta( $post_id, "_user_IP" ); // get previously voted IP address
		$ip = $_SERVER["REMOTE_ADDR"]; // Retrieve current user IP
		$liked_IPS = ""; // set up array variable
		
		if ( count( $meta_IPS ) != 0 ) { // meta exists, set up values
			$liked_IPS = $meta_IPS[0];
		}
		
		if ( !is_array( $liked_IPS ) ) // make array just in case
			$liked_IPS = array();
		
		if ( in_array( $ip, $liked_IPS ) ) { // True is IP in array
			return true;
		}
		return false;
	}
	
}

/* Front end button */
function getPostUnLikeLink( $post_id ) {
	$like_count = get_post_meta( $post_id, "_post_unlike_count", true ); // get post likes
	$count = ( empty( $like_count ) || $like_count == "0" ) ? '0' : esc_attr( $like_count );
	if ( AlreadyUnLiked( $post_id ) ) {
		$class = esc_attr( ' used' );
	} else {
		$class = esc_attr( '' );
	}
	$output = '<a href="#" class="no-decoration fal fa-frown display-5 idev-post-unlike'.$class.'" data-post_id="'.$post_id.'" title="'.$title.'"></a>';
	return $output;
}

/* Retrieve User UnLikes and Show on Profile */
add_action( 'show_user_profile', 'show_user_unlikes' );
add_action( 'edit_user_profile', 'show_user_unlikes' );
function show_user_unlikes( $user ) { ?>        
    <table class="form-table">
        <tr>
			<th><label for="user_likes"><?php _e( 'You Unlike:' ); ?></label></th>
			<td>
            <?php
			$user_likes = get_user_option( "_unliked_posts", $user->ID );
			if ( !empty( $user_likes ) && count( $user_likes ) > 0 ) {
				$the_likes = $user_likes;
			} else {
				$the_likes = '';
			}
			if ( !is_array( $the_likes ) )
			$the_likes = array();
			$count = count( $the_likes ); 
			$i=0;
			if ( $count > 0 ) {
				$like_list = '';
				echo "<p>\n";
				foreach ( $the_likes as $the_like ) {
					$i++;
					$like_list .= "<a href=\"" . esc_url( get_permalink( $the_like ) ) . "\" title=\"" . esc_attr( get_the_title( $the_like ) ) . "\">" . get_the_title( $the_like ) . "</a>\n";
					if ($count != $i) $like_list .= " &middot; ";
					else $like_list .= "</p>\n";
				}
				echo $like_list;
			} else {
				echo "<p>" . _e( 'You don\'t like anything yet.' ) . "</p>\n";
			} ?>
            </td>
		</tr>
    </table>
<?php }

/* Add a shortcode to your posts instead
 * type [idev_disliker] in your post to output the button
 */
function idev_unlike_shortcode() {
	return getPostUnLikeLink( get_the_ID() );
}
add_shortcode('idev_disliker', 'idev_unlike_shortcode');