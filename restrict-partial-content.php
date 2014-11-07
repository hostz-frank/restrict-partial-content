<?php
/**
 * Plugin Name: Restrict Partial Content
 * Plugin URI: http://wordpress.org/plugins/restrict-partial-content/
 * Description: This plugin helps to protect specific portion of the content
 * Version: 1.1
 * Author: Waqas Ahmed
 * Author URI: http://speedsoftsol.com
 * License: GPL2
 */




/** Rendering the output when the shortcode is placed **/
function render_restrict( $atts, $content = null ) {
	$parameter = extract( shortcode_atts( array(
		'allow_role' => 'all',
		'allow_user' => 'all',
		'message' => ' [This content is restricted. Either login with the correct access or wait till the content is available for everyone.] ',
		'open_time' => 'No Time'
	), $atts ) );

	$restrict = 1; //Restrict everyone but allow the role and user specified


	//Find the server date
	$server_date = strtotime(current_time('Y-m-d H:i:s')); // use current_time
	//Calculate diff
	$interval = 0;
	if ($open_time != 'No Time') {
		$content_opening_date = strtotime($open_time);
		$interval = $content_opening_date - $server_date;
		if ($interval <0 ) {
			$restrict = 0;
		}
	}
	
	
	// Find current user role and ID
	$user_info = wp_get_current_user();
	$user_role = $user_info->roles[0];
	$user_id = $user_info->ID;

	$user_list = explode (",", $allow_user);
	$user_list_trimmed = array_map('trim', $user_list);
	if ($user_id != NULL && in_array($user_id, $user_list_trimmed)) {
		$restrict = 0;
	}

	$allow_role = strtolower ($allow_role);
	$role_list = explode (",", $allow_role);
	$role_list_trimmed = array_map('trim', $role_list);	
	if ($user_id != NULL && in_array ($user_role, $role_list_trimmed)) {
		$restrict = 0;
	}
	
	if ($restrict == 1) {
		wp_enqueue_style( 'restrict-content', plugins_url().'/restrict-partial-content/restrict-partial.css');
		$output = '<div class="restricted-content">'.$message.'</div>';
		if ($interval >0) {
			$output .= '<div id="timer">
			<div id="timer-days"></div><div id="timer-hours"></div><div id="timer-minutes"></div><div id="timer-seconds"></div>
		</div>
			<div id="timer-message"></div>
		';
		$output .= "<script>

	function counter(total_time) {
		var d = Math.floor(total_time/86400);
		var remaining_time = total_time - (d*86400);
		
		var h = Math.floor(remaining_time/3600);
		var remaining_time = remaining_time - (h*3600);

		var m = Math.floor(remaining_time/60);
		var remaining_time = remaining_time - (m*60);
		var s = remaining_time;
		
		document.getElementById('timer-days').innerHTML = d + ' days';
		document.getElementById('timer-hours').innerHTML = h + ' hours';
		document.getElementById('timer-minutes').innerHTML = m + ' minutes';
		document.getElementById('timer-seconds').innerHTML = s + ' seconds';
		
		total_time--;
		if (total_time <0 ) { 
			document.getElementById('timer-message').innerHTML = 'Refresh the page to view the content';
			document.getElementById('timer').style.display='none';
			document.getElementById('timer-message').style.display='inline-block';
			return;
		}
		setTimeout(function () {counter (total_time)}, 1000);

	}
	
	counter(".$interval.");
	</script>";
		}
	}
	else {
		$output = do_shortcode( $content );
	}
	return $output;
}
add_shortcode( 'restrict', 'render_restrict' );

