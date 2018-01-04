<?php
/**
* Plugin Name: 	Boombastis - Sticky Post
* Plugin URI: 	https://www.boombastis.com
* Description: 	Boombastis sticky post addition to posts. Create double article post useful to push up an article pageviews. 
* Version: 		1.0.0
* Author: 		Refa Andhika
* Author URI: 	https://www.boombastis.com
* License: 		Private
* License URI: 	https://www.boombastis.com
*
*/

/** 
* Sticky Post Main Creator 
*
* @see boom_get_sticky_template()
*
* @param 	int 	$postid 				Post ID for sticky post.
* @param 	string 	$viewtype 				View device variable. 
*
*/

function boom_add_sticky_post($postid,$viewtype){
	$idnow = get_the_ID();
	if ( $idnow!=$postid ):
		$GLOBALS['StickyID'] = $postid;
		boom_get_sticky_template($viewtype);
	endif;
}

/**
*
* Getting template by view type.
*
* @since 1.0.0
*
* @param 	string 	$viewtype				View device variable.
* @return 	string 							Path to template file
*
*/

function boom_get_sticky_template($viewtype){
	$template_file = plugin_dir_path( __FILE__ ) . 'templates/post-' . $viewtype . '.php'; // Path to the template folder

	if ( !file_exists($template_file) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	include $template_file;
}

/*EOF*/