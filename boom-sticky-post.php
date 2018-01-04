<?php
/**
* Plugin Name: 	Boombastis - Sticky Post
* Plugin URI: 	https://www.boombastis.com
* Description: 	Boombastis sticky post addition to posts. Create double article post useful to push up an article pageviews. 
* Version: 		1.0.1
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

function boom_add_sticky_post($viewtype){
	$options = get_option('boom_sp_options');

	if ( isset($options['boom_sp_postid']) ):
		$idnow = get_the_ID();
		if ( $idnow!=$options['boom_sp_postid'] ):
			$GLOBALS['StickyID'] = $options['boom_sp_postid'];
			boom_get_sticky_template($viewtype);
		endif;
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

/**
* Init setting menu
*/

function boom_sp_setting_init() {
	register_setting('general_boom_sp', 'boom_sp_options');

	add_settings_section('boom_sp_first_section', 'Post Options', 'boom_sp_post_callback', 'general_boom_sp');

	add_settings_field('boom_sp_postid', 'Post ID', 'boom_sp_postid_callback', 'general_boom_sp', 'boom_sp_first_section');
}
add_action( 'admin_init', 'boom_sp_setting_init' );

function create_boom_sp_settings_page() {
	$page_title = 'Boombastis - Sticky Post Setting';
	$menu_title = 'Boom - Sticky Post';
	$capability = 'manage_options';
	$slug = 'boom_sp';
	$callback = 'boom_sp_setting_page_content';

	add_submenu_page('options-general.php', $page_title, $menu_title, $capability, $slug, $callback);
}
add_action( 'admin_menu', 'create_boom_sp_settings_page' );

function boom_sp_setting_page_content() { 

	if ( !current_user_can('manage_options') ) :
		return;
	endif;

	if ( isset( $_GET['setting-updated'] ) ) :
		add_settings_error( 'boom_sp_messages', 'boom_sp_messages', __( 'Setting Saved', 'general_boom_sp'), 'updated' );
	endif;

	settings_errors( 'boom_sp_messages' );
	?>
	<div class="wrap">
		<h2>Boombastis - Sticky Post</h2>
		<p>Append one article to another article with chosen id.</p>
		<form action="options.php" method="post">
			<?php 
				settings_fields('general_boom_sp');
				do_settings_sections('general_boom_sp');
				submit_button('Save Settings');
			?>
		</form>
	</div>
<?php
}

/**
* Callback for desktop section
*/

function boom_sp_post_callback($args) {
	switch ($args['id']) {
		case 'boom_sp_first_section':
			echo 'Custom post option.';
			break;
	}
}

function boom_sp_postid_callback($args) {
	$options = get_option('boom_sp_options');
	?>
	<input name="boom_sp_options[boom_sp_postid]" id="boom_sp_postid" text="text" value="<?php echo isset( $options['boom_sp_postid'] ) ? esc_attr($options['boom_sp_postid']) : '';?>"/>
	<?php 
}

/*EOF*/