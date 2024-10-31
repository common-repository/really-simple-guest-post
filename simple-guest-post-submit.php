<?php
/*
An Important part of Really Simple Guest Post Plugin for WordPress.
*/
if(!defined('ABSPATH')) die('!');
//Get Really Simple Guest Post submitted form
ob_start();
 
$title = $_POST["title"];
$description = $_POST["description"];
$tags = $_POST["tags"];
$author = $_POST["author"];
$site = $_POST["site"];
$authorid = $_POST["authorid"];
$category = $_POST["category"];
$redirecturl = $_POST["redirect"];
 
$nonce=$_POST["_wpnonce"];

//Load WordPress
//require($path);

//Verify the form fields
if (! wp_verify_nonce($nonce) ) die('Security check'); 
    $user = get_the_author_meta("login",$authorid);
    $authorid = isset( $authordata->ID ) ? $authordata->ID : 0;
   //Post Properties
    $new_post = array(
            'post_title'    => $title,
            'post_content'  => $description,
            'post_category' => array($_POST['cat']),  // Usable for custom taxonomies too
            'tags_input'    => $tags,
            'post_status'   => 'pending',           // Choose: publish, preview, future, draft, etc.
            'post_type' => 'post',  //'post',page' or use a custom post type if you want to
            'post_author' => $authorid //Author ID
    );
    //save the new post
    $pid = wp_insert_post($new_post);
     
    /* Insert Form data into Custom Fields */
    add_post_meta($pid, 'author', $author, true);
    add_post_meta($pid, 'author-website', $site, true);

header("Location: $redirecturl");
?>
