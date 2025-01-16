<?php


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die();
}


// Method 1


//$books = get_posts( array(
//    'numberposts' => -1,
//    'post_type'      => 'book',
//));
//
//foreach ($books as $book) {
//    wp_delete_post($book->ID, true);
//}


// Method 2
// Delete via SQL

global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type  = 'book' " );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELCT id FROM wp_posts) " );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELCT id FROM wp_posts) " );
