<?php 
/*
 * Plugin Name: AKIYA - Get Latest Post API
 * Description: This plugin allow to get latest post using REST API
 * Version: 1.0.0
 * Author: AKIYA DAVE
 * Text Domain: wwt-restapi
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Basic Plugin Definitions 
 * 
 * @package WP AJAX
 * @since 1.0.0
 */
if( !defined ('WWT_CP_REST_DIR')){
    define('WWT_CP_REST_DIR', dirname(__FILE__));
}

if( !defined( 'WWT_CP_REST_PLUGIN_BASENAME' ) ) {
	define( 'WWT_CP_REST_PLUGIN_BASENAME', basename( WWT_CP_REST_DIR ) ); 
}

//Language Textdomain Loading
function wwt_restapi_load_textdomain() {
	
	$wwp_restapi_lang_dir	= dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$wwp_restapi_lang_dir	= apply_filters( 'wwt_restapi_languages_directory', $wwp_restapi_lang_dir );
	
	
	$locale	= apply_filters( 'plugin_locale',  get_locale(), 'wwt-restapi' );
	$mofile	= sprintf( '%1$s-%2$s.mo', 'wwt-restapi', $locale );
	
	
	$mofile_local	= $wwp_restapi_lang_dir . $mofile;
	$mofile_global	= WP_LANG_DIR . '/' . WWT_CP_REST_PLUGIN_BASENAME . '/' . $mofile;
	
	if ( file_exists( $mofile_global ) ) { 
		load_textdomain( 'wwt-restapi', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) { 
		load_textdomain( 'wwt-restapi', $mofile_local );
	} else { 
		load_plugin_textdomain( 'wwt-restapi', false, $wwp_restapi_lang_dir );
	}
}
    
//Plugins Loading
function wwt_restapi_plugin_loaded(){
    wwt_restapi_load_textdomain();
}

add_action('plugins_loaded', 'wwt_restapi_plugin_loaded');

//Includes the rest api file
include_once( WWT_CP_REST_DIR . '/includes/wwt-cp-rest-types.php');


