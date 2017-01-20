<?php

/*
Plugin Name: BP Display Content
Description: By default, BuddyPress is making 4 pages and the content of pages are not displayed. BP Display Content  allow BP to display it.
Version: 1.0.1
Author: Sébastien SERRE
Author URI: http://www.thivinfo.com
License: GPL2
Text Domain: bp-display-content
Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_notices', 'bpdc_check_dependancy' );

function bpdc_check_dependancy() {
	if ( ! class_exists( 'BuddyPress' ) ) { ?>
        <div class="notice notice-error">
            <p><?php _e( 'BuddyPress is needed to activate BP Display Content', 'bp-display-content' ) ?></p></div>
		<?php
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
}


add_action( 'bp_before_directory_members_page', 'bpdc_the_content_by_id' );
add_action( 'bp_before_member_home_content', 'bpdc_the_content_by_id' );
add_action( 'bp_before_register_page', 'bpdc_the_content_by_id' );
add_action( 'bp_before_activation_page', 'bpdc_the_content_by_id' );

function bpdc_the_content_by_id( $post_id = 0, $more_link_text = null, $stripteaser = false ) {
	global $post;
	$result = bp_current_component();

	$page_array = get_option( 'bp-pages' );

	$post_id = $page_array[ $result ];

	$post = get_post( $post_id );

	setup_postdata( $post, $more_link_text, $stripteaser );
	the_content();
	wp_reset_postdata( $post );
}
