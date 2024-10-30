<?php
/*
 * Plugin Name: Blog_tools
 * Plugin URI: http://www.wordpress.org/plugins/blog_tools
 * Description: A Comprehensive Tool for Blogs.
 * Version: 1.0
 * Author: Deven Bansod
 * Author URI: http://www.facebook.com/bansoddeven
 * License: GPL2
 */
function Blog_tools($text) {
        $a=get_post_meta(get_the_id(),'Page_views');//Gets the Meta Data for the Post.
	$c=get_post_meta(get_the_id(),'Last_view');
	$ip_new=$_SERVER['REMOTE_ADDR'];
        if($a==NULL) {
            add_post_meta(get_the_id(),'Page_views',1,TRUE);//Checks if there exists Some data for the post/page and adds if not.
            $a=get_post_meta(get_the_id(),'Page_views');//Gets the newly added Meta data for the post/page.
        }
	if($c==NULL) {
	    $b=date('Y/m/d H:i:s');
	    add_post_meta(get_the_id(),'Last_view',$b,TRUE);//Checks if there exists Some data for the post/page and adds if not.
	    $c=get_post_meta(get_the_id(),'Last_view');//Gets the newly added Meta data for the post/page. 
	}
        //$o=explode('/', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);$o[count($o)-1]=='?p='.get_the_id()
        if(is_singular()){
            $a[0]=$a[0]+1;
            update_post_meta(get_the_id(),'Page_views',$a[0]);//Increases the Count of the views
	    $b=date('Y/m/d H:i:s');
	    $ip_new=$_SERVER['REMOTE_ADDR'];
	    update_post_meta(get_the_id(),'Last_view',$b);
	    update_post_meta(get_the_id(),'Last_ip',$ip_new);
        }//Checks if page is specifically one post/page . If Yes, Updates the new Post/page Views and The new Last views
      	
	echo "<a  href='".get_site_url()."/wp-admin/options-general.php?page=Blog_Tools'
            class='entry-meta' style='text-align:center'>Post Views</a> = <b>".($a[0])."</b>&emsp;
	<a  href='".get_site_url()."/wp-admin/options-general.php?page=Blog_Tools'
            class='entry-meta' style='text-align:center'>Last viewed on</a> = <b>".($c[0])."</b></br>";//Echoes Last Seen of the Post/page.
        echo "</br>".$text;   //Echoes the rest of the Content of the Post/page
        
}
function add_options4() {
	    add_options_page("Blog_Tools", "Blog_Tools", 1, "Blog_Tools", "Blog_tools_admin");
	}
function Blog_tools_admin() {
    include 'Blog_tools_admin.php';
	}
add_action('the_content','Blog_tools');//Calls the plugin function.
add_action('admin_menu','add_options4');//Adds options page	
?>