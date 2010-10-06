<?php



/*
Plugin Name: Inline Quote Tag
Description: Insert HTML inline quote tags.
Author: husobj
Version: 1.1
*/


class Q_Tag
{
	
	
	
	/**
	 * @method       Constructor
	 * @description  Initialise the class.
	 */
	
	function Q_Tag()
	{
	}
	
	function admin_init()
	{
		$this->add_buttons();
	}
	
	
	
	/**
	 * @method       Add Buttons
	 * @description  This function add buttons to the Rich Editor.
	 */
	
	function add_buttons()
	{
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) )
			return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_buttons', array( $this, 'register_map_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'add_map_plugin' ) );
		}
	
	}
	
	
	
	/**
	 * @method       Register Map Button
	 * @description  This function add the WP Geo map button to the editor.
	 * @parameter    $buttons = Array of editor buttons
	 * @return       $buttons array
	 */
	
	function register_map_button( $buttons )
	{
	
		array_push( $buttons, 'separator', 'qtag' );
		return $buttons;
	
	}
	
	
	
	/**
	 * @method       Load TinyMCE WP Geo Plugin
	 * @description  This function add the WP Geo map button to the editor.
	 * @parameter    $plugin_array = Array of TinyMCE plugins
	 * @return       $plugin_array array
	 */
	
	function add_map_plugin( $plugin_array )
	{
	
		$plugin_array['qtag'] = WP_PLUGIN_URL . '/inline-quote-tag/js/tinymce/plugins/qtag/editor_plugin.js';
		return $plugin_array;
	
	}
	
	

}

$q_tag = new Q_Tag();

add_action('admin_init', array($q_tag, 'admin_init'));



?>