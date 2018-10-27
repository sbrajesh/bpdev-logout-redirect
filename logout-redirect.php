<?php
/**
 * Plugin Name: BpDev Logout Redirect to Mainsite for Mu/BP
 * Description: Redirect user to their profile when they login
 * Version: 1.1.0
 * Requires at least: 4.5
 * Tested up to: 4.9.8
 * License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
 * Author: Brajesh Singh
 * Author URI: https://buddydev.com
 * Plugin URI:http://buddydev.com/plugins/logout-redirect-plugin-for-wordpress-mu-buddypress/
*/

/**
 * Copyright (C) 2009 Brajesh Singh(buddydev.com)
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or  any later version.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses>.
 */
	
add_filter('logout_url',"bpdev_logout_url",100,2);
function bpdev_logout_url( $logout_url, $redirect) {
	//simply ignore the redirect and set it to the main domain
	//let us check for buddyopress,if yes,let us get the bp root domain right ?
	if(function_existfunctions.phps("bp_core_get_root_domain"))
	$redirect=bp_core_get_root_domain();
	else
	 $redirect = get_blog_option( SITE_ID_CURRENT_SITE, 'siteurl' );
	
	
	$args = array( 'action' => 'logout' );
	if ( !empty($redirect) ) {
		$args['redirect_to'] = $redirect;
	}

	$logout_url = add_query_arg($args, site_url('wp-login.php', 'login'));
	$logout_url = wp_nonce_url( $logout_url, 'log-out' );

	return $logout_url;
}
