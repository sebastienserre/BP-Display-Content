<?php

/*
Plugin Name: BP Display Content
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Sébastien SERRE
Author URI: http://www.thivinfo.com
License: GPL2
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('bp_before_directory_members_page','bpdc_the_content_by_id');
add_action('bp_before_member_home_content','bpdc_the_content_by_id');
add_action('bp_before_register_page','bpdc_the_content_by_id');
add_action('bp_before_activation_page','bpdc_the_content_by_id');

function bpdc_the_content_by_id( $post_id=0, $more_link_text = null, $stripteaser = false ){
	global $post;
	$page_array=get_option('bp-pages');

	if (bp_is_members_directory()){
		$post_id = $page_array['members'];
	} elseif (bp_is_activity_directory()){
		$post_id = $page_array['activity'];
	} elseif (bp_is_register_page()){
		$post_id = $page_array['register'];
	} elseif (bp_is_activation_page()){
		$post_id = $page_array['activate'];
	}

	$post = get_post($post_id);

	setup_postdata( $post, $more_link_text, $stripteaser );
	the_content();
	wp_reset_postdata( $post );
}
