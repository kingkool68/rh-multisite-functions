<?php
/*
Plugin Name: RH Multisite Functions
Description: Special functions available to all of the sites hosted on root.russellheimlich.com
Author: Russell Heimlich
Version: 0.1
*/

// Disable Mercators SSO functionality which slows down page loads via an AJAX request
add_filter( 'mercator.sso.enabled', '__return_false' );
add_filter( 'mercator.sso.multinetwork.enabled', '__return_false' );

/**
 * Helper conditionals to run code in certain environments.
 */

if ( ! defined( 'RH_ENV' ) ) {
	$hostname = $_SERVER['HTTP_HOST'];
	if ( isset( $_SERVER['HTTP_X_FORWARDED_HOST'] ) && ! empty( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ) {
	    $hostname = $_SERVER['HTTP_X_FORWARDED_HOST'];
	}
	if ( strstr( $hostname, '.dev' ) ) {
		define( 'RH_ENV', 'dev' );
	} else {
		define( 'RH_ENV', 'production' );
	}
}

/**
 * Is the enviornment production?
 * @return boolean
 */
function rh_is_production() {
	if ( 'production' === RH_ENV ) {
		return true;
	}
	return false;
}

/**
 * Alias of rh_is_production().
 * @return boolean
 */
function rh_is_prod() {
	return rh_is_production();
}

/**
 * Is the environment staging?
 * @return boolean
 */
function rh_is_staging() {
	if ( 'staging' === RH_ENV ) {
		return true;
	}
	return false;
}

/**
 * Alias of rh_is_staging().
 * @return boolean
 */
function rh_is_stage() {
	return rh_is_staging();
}

/**
 * Is the environment dev?
 * @return boolean
 */
function rh_is_dev() {
	if ( 'dev' === RH_ENV ) {
		return true;
	}
	return false;
}

/* Custom WP Mail Sending */
function rh_wp_mail_from() {
	return 'wordpress@russellheimlich.com';
}
add_filter( 'wp_mail_from', 'rh_wp_mail_from' );

function rh_wp_mail_from_name() {
	$parts = parse_url( get_site_url() );
	return 'WordPress (' . $parts['host'] . ')';
}
add_filter( 'wp_mail_from_name', 'rh_wp_mail_from_name' );
