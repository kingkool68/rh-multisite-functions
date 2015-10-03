<?php
/*
Plugin Name: RH Multisite Functions
Description: Special functions available to all of the sites hosted on root.russellheimlich.com
Author: Russell Heimlich
Version: 0.1
*/

// Disable Mercators SSO functionality which slows down page loads via an AJAX request
add_filters( 'mercator.sso.enabled', '__return_false' );
