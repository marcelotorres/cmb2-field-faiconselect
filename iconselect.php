<?php
/*
Plugin Name: CMB2 Field Type : iconselect-fa
Plugin URI: #
GitHub Plugin URI: #
Description: iconselector for CMB2 (Font Awesome)
Version: 1.0
Author: Serkan Algur
Author URI: https://wpadami.com/
License: GPLv2+
*/

/**
 * Class IConSelectFA
*/

class IConSelectFA 
{
	
	const VERSION = '1.0';

	public function __construct()
	{
		add_filter( 'cmb2_render_faiconselect', array( $this, 'render_faiconselect' ), 10, 5 );
	}

	public function render_faiconselect($field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object){
		$this->setup_my_cssjs();

		if ( version_compare( CMB2_VERSION, '2.2.2', '>=' ) ) {
			$field_type_object->type = new CMB2_Type_Select( $field_type_object );
		}

		echo $field_type_object->select( array(
			'class'            => 'iconselectfa',
			'desc'             => $field_type_object->_desc( true ),
			'options'          => '<option></option>' . $field_type_object->concat_items(),
		) );

	}

	public function setup_my_cssjs(){
		$file = __DIR__; 
		$asset_path = str_replace( WP_CONTENT_DIR, WP_CONTENT_URL, $file );

		wp_enqueue_style( 'fontawesome', $asset_path.'/css/faws/css/font-awesome.min.css', array('jqueryfontselector'), self::VERSION );
		wp_enqueue_style( 'jqueryfontselectormain', $asset_path.'/css/jquery.fonticonpicker.min.css', array(), self::VERSION );
		wp_enqueue_style( 'jqueryfontselector', $asset_path.'/css/jquery.fonticonpicker.grey.min.css', array(), self::VERSION );
		wp_enqueue_script('jqueryfontselector', $asset_path.'/js/jquery.fonticonpicker.min.js', array('jquery'), self::VERSION, true);
		wp_enqueue_script('mainjs', $asset_path.'/js/main.js', array('jquery'), self::VERSION, true);
	}
}

	function returnFaPre(){
		include('predefined-array-fontawesome.php');
		return $fontAwesome;
	}

$iconSelectF = new IConSelectFA();