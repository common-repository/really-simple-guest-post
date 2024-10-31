<?php
/*
Plugin Name: Really Simple Guest Post Plugin
Plugin URI: https://usefulblogging.com/really-simple-guest-post-wordpress/
Description: Really Simple Guest Post Plugin allow your visitors to submit posts without registration from anywhere on your site.
Version: 1.9
Author: Ataul Ghani
Author URI: https://usefulblogging.com
Requires at least: 4.0
Tested Up to: 4.5
Stable Tag: trunk
License: GPL v2
*/



function reallysimpleguestpost_shortcode( $atts ) {
    extract ( shortcode_atts (array(
        'cat' => '1',
        'author' => '1',
        'redirect' => get_bloginfo('home'),
    ), $atts ) );

    return '<form class="fbt-simple-guest-post" action="" method="post">
	<input type="hidden" name="gptask" value="savepost" />
<p>The (*) marked fields are mandatory.</p>

<strong>' . __('Your Name:*', 'fbt-simple-guest-post') . '</strong><br>
            <input type="text" name="author" size="60" required="required" placeholder="' . __('Put your name', 'fbt-simple-guest-post') . '"><br><br>
        <strong>' . __('Email Address:*', 'fbt-simple-guest-post') . '</strong><br>
            <input type="email" name="email" size="60" required="required" placeholder="' . __('Enter your email', 'fbt-simple-guest-post') . '"><br><br>
        <strong>' . __('Website url:', 'fbt-simple-guest-post') . '</strong><br>
            <input type="text" name="site" size="60" placeholder="' . __('Your website url', 'fbt-simple-guest-post') . '"><br><br>
        <strong>' . __('Post Title</strong> (120 Characters maximum)<strong>:*', 'fbt-simple-guest-post') . '</strong><br>
            <input type="text" name="title" size="60" maxlength="120" required="required" placeholder="' . __('Enter title here', 'fbt-simple-guest-post') . '"><br><br>

        <strong>' . __('Description:*', 'fbt-simple-guest-post') . '</strong>
        '. wp_nonce_field() .'
            <textarea rows="15" cols="72" required="required" name="description" placeholder="' . __('Start writing from here', 'fbt-simple-guest-post') . '"></textarea><br><br>
        <strong>' . __('Categories:*  ', 'fbt-simple-guest-post') . '</strong>

	'. wp_dropdown_categories('show_option_none=Select a category...&tab_index=4&taxonomy=category&hide_empty=0&echo=0') .'
	 <input type="hidden" required="required" value="0'. $cat .'" name="category">
<br><br>
        <strong>' . __('Keyword Tags:', 'fbt-simple-guest-post') . '</strong><br>
            <input type="text" name="tags" size="60" placeholder="' . __('Separate tags with commas', 'fbt-simple-guest-post') . '">

<br><br><br>
	<input type="hidden" value="'. $author .'" name="authorid">
        <input type="hidden" value="'. $redirect .'" name="redirect">
        
<button style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0; border: 0 none !important; height: 53px !important;" type="submit"> <img src="images/submit.png" border="0" alt="Submit" /> </button> <button style="background: rgba(0, 0, 0, 0) none repeat scroll 0 0; border: 0 none !important; height: 53px !important;" type="reset"> <img src="images/reset.png" border="0" alt="Submit" /> </button> <br>
        </form>
        ';
    }
	
	
	function gp_save_post(){

	if(isset($_POST['gptask']) && $_POST['gptask'] == 'savepost'){
		require_once("simple-guest-post-submit.php");
	}
	
	
	
	}
	
add_action("wp", "gp_save_post");	
add_shortcode( 'mag-simple-guest-post', 'reallysimpleguestpost_shortcode' );

?>