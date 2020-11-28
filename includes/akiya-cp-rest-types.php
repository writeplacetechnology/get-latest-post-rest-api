<?php
 
/**
 * Exit if accessed directly
*/

if (!defined('ABSPATH')) exit;


/**
 * Fetch The Updated Post From Posts
*/

function get_latest_post_rest_api() {
	    
    /**
        * GET 20 LATEST POST FORM POSTS
    */
    
    $args = array(
		'posts_per_page' => 20, 
		'post_type' => 'post' 
	);

    $data = []; // Initialize Data Array

    $get_latest_post = get_posts($args);
    
    
    /**
        * GET THE POST AND DO SELECT RANDOMLY OUT OF 20  
    */ 

    if( !empty($get_latest_post) ) {
        
        $random_posts = (array)$get_latest_post; // Get Post Value In $random_posts
        
        $get_random_post = $random_posts[array_rand($random_posts, 1)] ;    
    }
    
    
    /**
        * Show POST ID And POST URL Form Post
    */

    if( !empty( $get_random_post ) ) {
        
        $get_post = (array) $get_random_post; // Get random posts in $get_post
        
        $data['status'] = 'Success';
        
        $data['id'] = $get_post['ID'];
        
        $data['post_url'] = get_the_permalink($get_post['ID']); // Retrive the Post URL By Post ID	
        
    } else {
        
        $data['status'] = 'Error - No post availalbe';
    }
    
	return $data; // Return The POST ID AND POST URL IN DATA 
}
       

/**
 * Register The Route and Custom Endpoint Of latest Post
*/

add_action('rest_api_init', function() {
    
	register_rest_route('v1', 'get-latest-post', [ 
		'methods' => 'GET',
		'callback' => 'get_latest_post_rest_api',
	]);
});
