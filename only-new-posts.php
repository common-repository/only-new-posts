<?php
/*
Plugin Name: Only New Posts
Version: 1.0.0
Description: Shows only posts older than the creation date of the current logged in user.
Author: nestwiderhaken
Author URI: http://nestwiderhaken.de
License: GPL2
*/

/*****************************************************************************\
		EXCLUDE POSTS
\*****************************************************************************/

add_filter( 'posts_where', 'onp_exclude_posts' );
add_filter( 'getarchives_where', 'onp_exclude_posts' );

function onp_exclude_posts( $where ) {
    
    if( !is_admin() ) {
	
	global $current_user;
	get_currentuserinfo(); 
	$user_data = get_userdata($current_user->ID);
	$registered_date = $user_data->user_registered;
        
       	$where .= " AND post_date > '".date( 'Y-m-d', strtotime($registered_date) )."' ";
    }
    return $where;
}
?>
