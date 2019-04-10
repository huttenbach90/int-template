<?php defined( 'ABSPATH' ) or die( 'No direct access allowed' );
/*
Plugin Name: Submit a Solution
Plugin URI: https://help.integromat.com/
Description: Post a community-given solutions via frontend.
Author: Integromat
Version: 1.0
Author URI: https://integromat.com/
*/

function submit_sol($content = null) {
	global $post;

	ob_start();
	?>
	<div id="cg-solution-postbox" class="<?php if(is_user_logged_in()) echo 'closed'; else echo 'loggedout'?>">
		<?php do_action( 'cg-solution-notice' ); ?>
		<div class="cg-solution-inputarea">
			<?php if(is_user_logged_in()) { ?>
				<form id="solution" name="new_post" method="post" action="<?php the_permalink(); ?>">
					<div class="form-group">
						<label for="title">Post title:</label>
						<input class="form-control" type="text" id ="title" name="post_title" />
					</div>
					<div class="form-group">
						<label for="url">Facebook Permalink to the post:</label>
						<input class="form-control" type="url" id="url" name="permalink">
					</div>
					<div class="form-group">
						<label for="tag">Tags:</label>
						<input class="form-control" id="tag" name="tag" type="text" tabindex="2" autocomplete="on" />
					</div>
					<input class="btn btn-primary" id="submit" type="submit" tabindex="3" value="<?php esc_attr_e( 'Submit', 'cg-solution' ); ?>" />
					<input type="hidden" name="action" value="post" />
					<input type="hidden" name="empty-description" id="empty-description" value="1"/>
					<?php wp_nonce_field( 'new-post' ); ?>
				</form>
			<?php } else { ?>
				<p>Please Log-in To Submit a Post</p>
			<?php } ?>
		</div>

	</div>


	<?php
	$output = ob_get_contents();
	ob_end_clean();
	if (is_page()) return  $output;
}
add_shortcode('cg-solution', 'submit_sol');

function submit_sol_errors(){
	global $error_array;
	foreach($error_array as $error){
		echo '<div class="alert alert-danger">' . $error . '</div>';
	}
}
function submit_sol_notices(){
	global $notice_array;
	foreach($notice_array as $notice){
		echo '<div class="alert alert-success">' . $notice . '</div>';
	}
}

function submit_sol_add_post(){
	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'post' ){
		if ( !is_user_logged_in() )
			return;
		global $current_user;

		$user_id		= $current_user->ID;
		$post_title     = $_POST['post_title'];
		$permalink		= $_POST['permalink'];
		$tag			= $_POST['tag'];

		global $error_array;
		$error_array = array();

		if (empty($post_title)) $error_array[]='Please add a title.';
		if (empty($permalink)) $error_array[]='Please add a permalink.';
		if (empty($tag)) $error_array[]='Please add at least one tag.';

		if (count($error_array) == 0) {

			$dataToSave = array(
				'post_author'	=> $user_id,
				'post_title'	=> $post_title,
				'post_type'     => 'external',
				'meta_input'	=> array(
					'l_url'			=> $permalink
				),
				'tags_input'	=> $tag,
				'post_status'	=> 'draft'
			);

			// Submit data to integromat
			$curlResult = (new IMT_Helper_Http)->makeRequest('https://hook.integromat.com/2jlnfovqmzb3k4h9b91lq3j28w6oqwys', '', [], $dataToSave, true);

			global $notice_array;
			$notice_array = array();
			$notice_array[] = "Done.";
			add_action('cg-solution-notice', 'submit_sol_notices');
		} else {
			add_action('cg-solution-notice', 'submit_sol_errors');
		}
	}
}
add_action('init','submit_sol_add_post');





// Bylo by vhodne presunout nekam jinam
Class IMT_Helper_Http
{

	/**
	 * @param $url string
	 * @param string $httpAuthData Pro pripadnou HTTP autentizaci na cili. Ve formatu username:password.
	 * @param array $cookies
	 * @param array $postFields array containt data to POST
	 * @param bool $ssl - Bude dotazovana SSL verze stranky?
	 * @param bool $followRedirects - Nasledovat hlavicku Location?
	 * @return array
	 */
	public function makeRequest($url, $httpAuthData = '', $cookies = [], $postFields = [], $ssl = false, $followRedirects = false)
	{
		$options = [
			CURLOPT_RETURNTRANSFER => true,     	 	// return web page
			CURLOPT_HEADER => false,                 	// don't return headers
			CURLOPT_FOLLOWLOCATION => $followRedirects, // follow redirects
			CURLOPT_ENCODING => "",                  	// handle all encodings
			CURLOPT_USERAGENT => "allstar.cz",  		// who am i
			CURLOPT_AUTOREFERER => true,         		// set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,       		// timeout on connect
			CURLOPT_TIMEOUT => 120,                  	// timeout on response
			CURLOPT_MAXREDIRS => 10,                 	// stop after 10 redirects

		];

		if (!empty($postFields)) {
			$options[CURLOPT_POSTFIELDS] = http_build_query($postFields);
		}

		if ($ssl) {
			$options[CURLOPT_SSL_VERIFYPEER] = false;// Disabled SSL Cert checks
			$options[CURLOPT_SSL_VERIFYHOST] = false;
		}

		if (!empty($cookies)) {
			$options[CURLOPT_HTTPHEADER] = $cookies;
		}


		if (!empty($httpAuth)) {
			$options[CURLOPT_USERPWD] = $httpAuthData;
		}

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);


		$out = [
			'content' => curl_exec($ch),
			'error' => curl_errno($ch),
			'errmsg' => curl_error($ch),
			'header' => curl_getinfo($ch)
		];

		curl_close($ch);
		return $out;
	}

}