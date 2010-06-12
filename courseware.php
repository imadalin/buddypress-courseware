<?php
/*
Plugin Name: BuddyPress ScholarPress Courseware
Plugin URI: http://scholarpress.net/
Description: A LMS for BuddyPress.
Author: Stas Sușcov
Version: 0.1alfa
License: GNU/GPL 2
Requires at least: WordPress 3.0, BuddyPress 1.2.4.1
Tested up to: WordPress 2.9.2 / BuddyPress 1.2.4.1
Author URI: http://stas.nerd.ro/
*/

define( 'BPSP_VERSION', '0.1' );
define( 'BPSP_PLUGIN_DIR', dirname( __FILE__ ) );

/* Load the components */
require_once( BPSP_PLUGIN_DIR . '/roles/bpsp_roles.class.php' );
require_once( BPSP_PLUGIN_DIR . '/courses/bpsp_courses.class.php' );
require_once( BPSP_PLUGIN_DIR . '/groups/bpsp_groups.class.php' );

/**
 * i18n
 */
function bpsp_textdomain() {
    load_plugin_textdomain( 'bpsp', false, BPSP_DIR . '/i18n' );
}
add_action( 'init', 'bpsp_textdomain' );

/**
 * Register post types and taxonomies
 */
function bpsp_registration() {
    BPSP_Courses::register_post_types();
}
add_action( 'init', 'bpsp_registration' );

/**
 * On plugins load
 */
function bpsp_on_plugins_load() {
    BPSP_Groups::activate_component();
}
add_action( 'plugins_loaded', 'bpsp_on_plugins_load', 5 );

/* Initiate the componenets */
function bpsp_init() {
    new BPSP_Roles();
    new BPSP_Courses();
    new BPSP_Groups();
}
add_action( 'bp_init', 'bpsp_init' );

/* Activate the components */
function bpsp_activation() {
    BPSP_Roles::register_profile_fields();
}
register_activation_hook( 'courseware/courseware.php', 'bpsp_activation' );

/** TEMPORARY HELPERS **/
function _d($stuff) {
    wp_die( '<pre>' . var_dump( $stuff ) . '</pre>');
}
?>