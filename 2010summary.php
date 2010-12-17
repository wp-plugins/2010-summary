<?php
/*
Plugin Name: 2010 Summary
Plugin URI: http://tomasz.topa.pl/2010summary
Description: Get a brief summary of 2010 on your blog
Version: 0.1
Author: Tomasz Topa
Author URI: http://tomasz.topa.pl
License: GPL2

	Copyright 2010  Tomasz Topa  (email : wpsummary [at] topa.pl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_action('admin_menu', 'y2010summary_menu_add');

function y2010summary_menu_add() {
  add_submenu_page('index.php', '2010 Summary', '2010 Summary', 'read', 'y2010summary', 'y2010summary'); 
}

function y2010summary() {

  if (!current_user_can('read'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

  echo '<div class="wrap">
	
	<style type="text/css">
	.y2010summaryList{font-size:11px;margin-left:3em;list-style:disc;}
	#y2010summaryDonate{width:200px;float:right;text-align:center;padding:30px 0;}
	</style>
	
	<h2>2010 Summary - whole year of blogging summarized</h2>
	<div id="y2010summaryDonate">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XYX6TEWN8ZUVU">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
</form>

	</div>
	<p>This plugin <strong>generates a brief summary of your blog</strong> for year 2010.</p>
<p>See how many posts you wrote durig the ending year,  which were the most popular, who was the most active commenter etc. </p>
<p>And then <strong>share the stats with your readers</strong> - copy the data to a new draft with a single click.</p>
	
	
	
	';

	

  if($_POST['y2010summary_generate']==TRUE){
	y2010summary_generate();
	
  } elseif($_POST['y2010summary_draft']==TRUE){
   
   $my_post = array(
     'post_title' => 'Summary of 2010',
     'post_content' => base64_decode($_POST['y2010summary_draftcontent']),
     'post_status' => 'draft',
     'post_author' => $user_ID,
  );

// Insert the post into the database
  $postid=wp_insert_post( $my_post );
   
   echo '<div class="updated"><p><strong>A draft of the new post has been created</strong>. You can now <a href="'.get_bloginfo('wpurl').'/wp-admin/post.php?post='.$postid.'&action=edit">edit it</a> and then publish.</p></div>';
   
  } else {
	echo '<form name="y2010summary_generate" method="post" action="">
	<input type="submit" name="generateStats" class="button-primary" value="Generate Summary" /> 
	<input type="hidden" name="y2010summary_generate" value="TRUE" />
	</form>';
  }
  
  echo '<p>&nbsp;</p><p>&nbsp;</p><hr><p><small>Questions? Suggestions? Mail me: wpsummary@topa.pl or <a href="http://twitter.com/tomasztopa" rel="nofollow">@tomasztopa</a>. You can also check out my blog at <a href="http://tomasz.topa.pl">www.tomasz.topa.pl</a></small></p>';
  echo '</div>';
}

function y2010summary_generate(){
	global $wpdb;
	
	
	$y2010summary_noposts = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and post_type='post'");
    
	$y2010summary_nopages = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and post_type='page'");
	
	$y2010summary_noattach = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='attachment'");	
	
	$y2010summary_noauthors = $wpdb->get_row("SELECT count($wpdb->users.ID) as howmany FROM $wpdb->users");
	
	$y2010summary_nocomm = $wpdb->get_row("SELECT count($wpdb->comments.comment_ID) as howmany FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and $wpdb->comments.comment_type!='trackback' and $wpdb->comments.comment_approved=1");	
	
	$y2010summary_commbyauthors = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany, $wpdb->comments.user_id FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and $wpdb->comments.comment_type!='trackback' and $wpdb->comments.comment_approved=1 and $wpdb->comments.user_id>0 group by $wpdb->comments.user_id");	

	$y2010summary_nocommr = $wpdb->get_row("SELECT count($wpdb->comments.comment_ID) as howmany FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.user_id>0 and $wpdb->comments.comment_approved=1");	
	
	$y2010summary_months = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, month($wpdb->posts.post_date) as postmonth FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by postmonth order by postmonth asc");

	$y2010summary_days = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, dayname($wpdb->posts.post_date) as postday, dayofweek($wpdb->posts.post_date) as postday2 FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by postday order by postday2 asc");	
	
	echo mysql_error();
	
	$y2010summary_postsbyauthors = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, $wpdb->posts.post_author FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by $wpdb->posts.post_author order by howmany desc");
	
	$y2010summary_topcom = $wpdb->get_results("SELECT $wpdb->posts.comment_count, $wpdb->posts.post_title, $wpdb->posts.ID FROM $wpdb->posts WHERE year($wpdb->posts.post_date)=2010 and $wpdb->posts.post_type='post' order by comment_count desc limit 10");
	
	$y2010summary_commenters = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany,$wpdb->comments.comment_author FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.comment_approved=1 and user_id=0 group by $wpdb->comments.comment_author order by howmany desc limit 10");

	
    foreach ($y2010summary_commenters as $y2010summary_commenter) {
		$y2010summary_commentdata.='<li>'.$y2010summary_commenter->comment_author.': <strong>'.$y2010summary_commenter->howmany.'</strong> comments</li>';
	}
	
	foreach ($y2010summary_months as $y2010summary_month) {
		$y2010summary_monthdata.='<li>'.date("F",mktime(0,0,0,$y2010summary_month->postmonth,1,2010)).': <strong>'.$y2010summary_month->howmany.'</strong> posts</li>';
	}
	
	foreach ($y2010summary_days as $y2010summary_day) {
		$y2010summary_daydata.='<li>'.$y2010summary_day->postday.': <strong>'.$y2010summary_day->howmany.'</strong> posts</li>';
	}
	
	foreach ($y2010summary_topcom as $y2010summary_post) {
		$y2010summary_postdata.='<li><a href="'.get_permalink($y2010summary_post->ID).'">'.$y2010summary_post->post_title.'</a>: <strong>'.$y2010summary_post->comment_count.'</strong> comments</li>';
	}
	
	
	foreach ($y2010summary_postsbyauthors as $y2010summary_author) {
		$y2010summary_authorprofile=get_userdata($y2010summary_author->post_author);
		$y2010summary_authordata.='<li>'.$y2010summary_authorprofile->display_name.': <strong>'.$y2010summary_author->howmany.'</strong> posts</li>';
	}
	
	foreach ($y2010summary_commbyauthors as $y2010summary_commauthor) {
		$y2010summary_authorprofile2=get_userdata($y2010summary_commauthor->user_id);
		$y2010summary_commauthordata.='<li>'.$y2010summary_authorprofile2->display_name.': <strong>'.$y2010summary_commauthor->howmany.'</strong> comments</li>';
	}

	
	$y2010summary_text.='
	
	<p>In 2010 you wrote <strong>'.$y2010summary_noposts->howmany.'</strong> posts and added <strong>'.$y2010summary_nopages->howmany.' pages</strong> to this blog, with <strong>'.$y2010summary_noattach->howmany.' attachments</strong> in total.</p>
	<p>&nbsp;</p>
	<p><strong>The number of posts in each month:</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_monthdata.'</ul>
	<p>&nbsp;</p>
	<p><strong>The number of posts in each day of week:</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_daydata.'</ul>
	<p>&nbsp;</p>
	<p>In 2010 your posts were commented <strong>'.$y2010summary_nocomm->howmany.'</strong> times, from which <strong>'.$y2010summary_nocommr->howmany.'</strong> comments ('.round($y2010summary_nocommr->howmany/$y2010summary_nocomm->howmany*100,2).'%) were written by registered users/authors.</p>
	<p>&nbsp;</p>
	<p><strong>TOP 10 commenters in 2010:</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_commentdata.'</ul>
	<p>&nbsp;</p>
	<p><strong>TOP 10 most commented posts in 2010:</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_postdata.'</ul>
	<p>&nbsp;</p>
	
	';
	
	if($y2010summary_noauthors->howmany>1){
		$y2010summary_text.='<p><strong>This blog has many authors.</strong> Below you can find the number of posts each one wrote:</p>
		<ul class="y2010summaryList">'.$y2010summary_authordata.'</ul>
		<p>&nbsp;</p>
		<p>And the number of comments each one wrote:</p>
		<ul class="y2010summaryList">'.$y2010summary_commauthordata.'</ul>
		<p>&nbsp;</p>
		';
		
	}
	

	
	$y2010summary_draft=base64_encode(str_replace(array('your','you','<p>&nbsp;</p>'), array('the','I',''), $y2010summary_text).'<p>Summary generated by <a href="http://tomasz.topa.pl/2010summary">2010 Summary plugin by Tomasz Topa</a>.</p>');

	echo '<p>&nbsp;</p><form name="y2010summary_draft" method="post" action="">
  <input type="submit" name="generateDraft" class="button-primary" value="Create a new blog post with this summary" /> 
  <input type="hidden" name="y2010summary_draft" value="TRUE" />
  <input type="hidden" name="y2010summary_draftcontent" value="'.$y2010summary_draft.'" />
  </form>&nbsp;
	<div id="poststuff"><div class="postbox"><h3 class="hndle"><span>2010 Summary</span></h3><div class="inside"><p>&nbsp;</p>';
	echo $y2010summary_text;

	echo '</div></div></div>';
	
	echo '<form name="y2010summary_draft" method="post" action="">
  <input type="submit" name="generateDraft" class="button-primary" value="Create a new blog post with this summary" /> 
  <input type="hidden" name="y2010summary_draft" value="TRUE" />
  <input type="hidden" name="y2010summary_draftcontent" value="'.$y2010summary_draft.'" />
  </form>
  <p>&nbsp;</p>';
	
}

?>