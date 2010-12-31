<?php
/*
Plugin Name: 2010 Summary
Plugin URI: http://tomasz.topa.pl/2010summary
Description: Get a brief summary of 2010 on your blog
Version: 0.3
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

$y2010summary_translations=array('en','pl');  
	$y2010summary_lang=substr(WPLANG,0,2);
	if(!in_array($y2010summary_lang,$y2010summary_translations))
	{
		$y2010summary_lang='en';
	}

	/* Translation */
	
	$y2010summary_trans=array();
	$y2010summary_trans[1]=array(
		'en'=>'2010 Summary - whole year of blogging summarized',
		'pl'=>'2010 Summary - podsumowanie całego roku blogowania'
	);
  	$y2010summary_trans[2]=array(
		'en'=>'This plugin <strong>generates a brief summary of your blog</strong> for year 2010.',
		'pl'=>'Ten plugin <strong>generuje krótkie podsumowanie blogowania</strong> w roku 2010.'
	);
  	$y2010summary_trans[3]=array(
		'en'=>'See how many posts you wrote durig the ending year,  which were the most popular, who was the most active commenter etc.',
		'pl'=>'Zobacz ile napisałeś postów, które były najczęściej komentowane, kto był najbardziej aktywnym czytelnikiem w mijającym roku itp.'
	);
  	$y2010summary_trans[4]=array(
		'en'=>'And then <strong>share the stats with your readers</strong> - copy the data to a new draft with a single click.',
		'pl'=>'Następnie <strong>podziel się statystykami ze swoimi czytelnikami</strong> - skopiuj statystyki do nowego wpisu przy pomocy jednego kliknięcia.'
	);
  	$y2010summary_trans[5]=array(
		'en'=>'Summary of 2010',
		'pl'=>'Podsumowanie roku 2010'
	);
  	$y2010summary_trans[6]=array(
		'en'=>'<strong>A draft of the new post has been created</strong>. You can now ',
		'pl'=>'<strong>Szkic nowego wpisu został stworzony.</strong>. Możesz go teraz '
	);
  	$y2010summary_trans[7]=array(
		'en'=>'edit it',
		'pl'=>'edytować'
	);
  	$y2010summary_trans[8]=array(
		'en'=>'and then publish.',
		'pl'=>'a następnie opublikować.'
	);
  	$y2010summary_trans[9]=array(
		'en'=>'Regenerate summary',
		'pl'=>'Wygeneruj ponownie'
	);
  	$y2010summary_trans[10]=array(
		'en'=>'Generate summary',
		'pl'=>'Wygeneruj podsumowanie'
	);
  	$y2010summary_trans[11]=array(
		'en'=>'Questions? Suggestions? Mail me: wpsummary@topa.pl or <a href="http://twitter.com/tomasztopa" rel="nofollow">@tomasztopa</a>. You can also check out my blog at <a href="http://tomasz.topa.pl">www.tomasz.topa.pl</a>',
		'pl'=>'Pytania? Sugestie? Napisz na wpsummary@topa.pl lub skontaktuj się na Twitterze <a href="http://twitter.com/tomasztopa" rel="nofollow">@tomasztopa</a>. Zapraszam również na mojego bloga <a href="http://tomasz.topa.pl">www.tomasz.topa.pl</a>'
	);	
  	$y2010summary_trans[12]=array(
		'en'=>'comments',
		'pl'=>'komentarzy'
	);		
  	$y2010summary_trans[13]=array(
		'en'=>'posts',
		'pl'=>'wpisów'
	);	
  	$y2010summary_trans[14]=array(
		'en'=>'In 2010 you wrote <strong>%s</strong> posts and added <strong>%s pages</strong> to this blog, with <strong>%s attachments</strong> in total.',
		'pl'=>'W 2010 napisałeś <strong>%s</strong> wpisów oraz dodałeś <strong>%s podstron</strong> do tego bloga. W sumie zawierały <strong>%s załączników</strong>.'
	);	
  	$y2010summary_trans[15]=array(
		'en'=>'The number of posts in each month',
		'pl'=>'Liczba postów w poszczególnych miesiącach'
	);	
  	$y2010summary_trans[16]=array(
		'en'=>'The number of posts in each day of week',
		'pl'=>'Liczba postów w poszczególnych dniach tygodnia'
	);		
  	$y2010summary_trans[17]=array(
		'en'=>'At what hours you publish new posts',
		'pl'=>'Godziny o których publikowałeś nowe wpisy'
	);		
  	$y2010summary_trans[18]=array(
		'en'=>'In 2010 your posts were commented <strong>%s</strong> times, from which <strong>%s</strong> comments (%s percent) were written by registered users/authors.',
		'pl'=>'W 2010 roku Twoje posty zostały skomentowane <strong>%s</strong> razy, w tym <strong>%s</strong> komentarzy (%s procent) zostało napisanych przez zarejestrowanych użytkowników/autorów.'
	);		
  	$y2010summary_trans[19]=array(
		'en'=>'TOP 10 commenters in 2010',
		'pl'=>'TOP 10 komentujących w 2010'
	);		
  	$y2010summary_trans[20]=array(
		'en'=>'TOP 10 most commented posts in 2010',
		'pl'=>'TOP 10 najczęściej komentowanych wpisów w 2010'
	);		
  	$y2010summary_trans[21]=array(
		'en'=>'The number of comments in each month',
		'pl'=>'Liczba komentarzy w poszczególnych miesiącach'
	);		
  	$y2010summary_trans[22]=array(
		'en'=>'On what days people comment',
		'pl'=>'Dni w które czytelnicy najczęściej komentują'
	);			
  	$y2010summary_trans[23]=array(
		'en'=>'At what hours people comment',
		'pl'=>'O których godzinach czytelnicy komentują'
	);		
  	$y2010summary_trans[24]=array(
		'en'=>'<strong>This blog has many authors.</strong> Here is the number of posts each one wrote:',
		'pl'=>'<strong>Na tym blogu jest wielu autorów.</strong> Oto liczba wpisów opublikowanych przez każdego z nich:'
	);		
  	$y2010summary_trans[25]=array(
		'en'=>'And the number of comments each one wrote:',
		'pl'=>'Liczba komentarzy napisanych przez każdego z autorów:'
	);	
  	$y2010summary_trans[26]=array(
		'en'=>'Summary generated by <a href="http://tomasz.topa.pl/2010summary">2010 Summary plugin by Tomasz Topa</a>',
		'pl'=>'Zestawienie wygenerowane przez <a href="http://tomasz.topa.pl/2010summary">wtyczkę 2010 Summary</a>, którą przygotował Tomasz Topa.'
	);	
  	$y2010summary_trans[27]=array(
		'en'=>'Create a new blog post with this summary',
		'pl'=>'Stwórz nowy wpis z tym podsumowaniem'
	);	
  	$y2010summary_trans[28]=array(
		'en'=>'2010 Summary',
		'pl'=>'Podsumowanie roku 2010'
	);		
  	$y2010summary_trans[29]=array(
		'en'=>array('your','you','<p>&nbsp;</p>'),
		'pl'=>array('napisałeś','dodałeś','publikowałeś','<p>&nbsp;</p>','Twoje')
	);	
  	$y2010summary_trans[30]=array(
		'en'=>array('the','I',''),
		'pl'=>array('napisałem','dodałem','publikowałem','','Moje')
	);	

function y2010summary_menu_add() {
  add_submenu_page('index.php', '2010 Summary', '2010 Summary', 'read', 'y2010summary', 'y2010summary'); 
}

function y2010summary() {
  global $y2010summary_trans,$y2010summary_lang,$y2010summary_translations;
  if (!current_user_can('read'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

	
	
  echo '<div class="wrap">
	
	<style type="text/css">
	.y2010summaryList{font-size:11px;margin-left:3em;list-style:disc;}
	#y2010summaryDonate{width:200px;float:right;text-align:center;padding:30px 0;}
	.y2010summaryTable{margin: 0 0 0 10px;}
	.y2010summaryTable td{font-size:11px;line-height:2em;padding:0.25em;overflow:hidden;}
	.y2010summaryCol1{float:left;width:300px;overflow:hidden;}
	.y2010summaryCol2{float:left;width:260px;overflow:hidden;}
	.y2010summaryClear{clear:both;}
	</style>
	
	<h2>'.$y2010summary_trans[1][$y2010summary_lang].'</h2>
	<div id="y2010summaryDonate">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="XYX6TEWN8ZUVU">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/pl_PL/i/scr/pixel.gif" width="1" height="1">
</form>

	</div>
	<p>'.$y2010summary_trans[2][$y2010summary_lang].'</p>
	<p>'.$y2010summary_trans[3][$y2010summary_lang].'</p>
	<p>'.$y2010summary_trans[4][$y2010summary_lang].'</p>
	
	
	
	';

	

  if($_POST['y2010summary_generate']==TRUE){
	y2010summary_generate();
	
  } elseif($_POST['y2010summary_draft']==TRUE){
   
   $my_post = array(
     'post_title' => $y2010summary_trans[5][$y2010summary_lang],
     'post_content' => base64_decode($_POST['y2010summary_draftcontent']),
     'post_status' => 'draft',
     'post_author' => $user_ID,
  );

// Insert the post into the database
  $postid=wp_insert_post( $my_post );
   
   echo '<p>&nbsp;</p><div class="updated"><p>'.$y2010summary_trans[6][$y2010summary_lang].' <a href="'.get_bloginfo('wpurl').'/wp-admin/post.php?post='.$postid.'&action=edit">'.$y2010summary_trans[7][$y2010summary_lang].'</a> '.$y2010summary_trans[8][$y2010summary_lang].'</p></div>';
   echo'<p>&nbsp;</p><p>&nbsp;</p><form name="y2010summary_generate" method="post" action="">
	<input type="submit" name="generateStats" class="button-primary" value="'.$y2010summary_trans[9][$y2010summary_lang].'" /> 
	<input type="hidden" name="y2010summary_generate" value="TRUE" />
	</form>';
   
  } else {
	echo '<form name="y2010summary_generate" method="post" action="">
	<input type="submit" name="generateStats" class="button-primary" value="'.$y2010summary_trans[10][$y2010summary_lang].'" /> 
	<input type="hidden" name="y2010summary_generate" value="TRUE" />
	</form>';

  }
  
  echo '<p>&nbsp;</p><p>&nbsp;</p><hr><p><small>'.$y2010summary_trans[11][$y2010summary_lang].'</small></p>';
  echo '</div>';
}

function y2010summary_generate(){
	global $wpdb,$y2010summary_trans,$y2010summary_lang,$y2010summary_translations;
	
	
	$y2010summary_noposts = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and post_type='post' and post_status='publish'");
    
	$y2010summary_nopages = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and post_type='page' and post_status='publish'");
	
	$y2010summary_noattach = $wpdb->get_row("SELECT count($wpdb->posts.ID) as howmany FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='attachment'");	
	
	$y2010summary_noauthors = $wpdb->get_row("SELECT count($wpdb->users.ID) as howmany FROM $wpdb->users");
	
	$y2010summary_nocomm = $wpdb->get_row("SELECT count($wpdb->comments.comment_ID) as howmany FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and $wpdb->comments.comment_type!='trackback' and $wpdb->comments.comment_approved=1");	
	
	$y2010summary_commbyauthors = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany, $wpdb->comments.user_id FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and $wpdb->comments.comment_type!='trackback' and $wpdb->comments.comment_approved=1 and $wpdb->comments.user_id>0 group by $wpdb->comments.user_id");	

	$y2010summary_nocommr = $wpdb->get_row("SELECT count($wpdb->comments.comment_ID) as howmany FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.user_id>0 and $wpdb->comments.comment_approved=1");	
	
	$y2010summary_months = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, month($wpdb->posts.post_date) as postmonth FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by postmonth order by postmonth asc");
	
	$y2010summary_hours = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, hour($wpdb->posts.post_date) as posthour FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by posthour order by posthour asc");

	
	$y2010summary_days = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, dayname($wpdb->posts.post_date) as postday, dayofweek($wpdb->posts.post_date) as postday2 FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by postday order by postday2 asc");	

	
	$y2010summary_postsbyauthors = $wpdb->get_results("SELECT count($wpdb->posts.ID) as howmany, $wpdb->posts.post_author FROM $wpdb->posts WHERE year(post_date)=2010 and $wpdb->posts.post_type='post' group by $wpdb->posts.post_author order by howmany desc");
	
	$y2010summary_topcom = $wpdb->get_results("SELECT $wpdb->posts.comment_count, $wpdb->posts.post_title, $wpdb->posts.ID FROM $wpdb->posts WHERE year($wpdb->posts.post_date)=2010 and $wpdb->posts.post_type='post' order by comment_count desc limit 10");
	
	$y2010summary_commenters = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany,$wpdb->comments.comment_author FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.comment_approved=1 and user_id=0 group by $wpdb->comments.comment_author order by howmany desc limit 10");

	$y2010summary_commentsday = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany, dayname($wpdb->comments.comment_date) as commentday, dayofweek($wpdb->comments.comment_date) as commentday2 FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.comment_approved=1 group by commentday order by commentday2 asc");
	
	$y2010summary_commentmonths = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany, month($wpdb->comments.comment_date) as commentmonth FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.comment_approved=1 group by commentmonth order by commentmonth asc");
	
	
	$y2010summary_commenthours = $wpdb->get_results("SELECT count($wpdb->comments.comment_ID) as howmany, hour($wpdb->comments.comment_date) as commenthour FROM $wpdb->comments WHERE year($wpdb->comments.comment_date)=2010 and comment_type!='trackback' and $wpdb->comments.comment_approved=1 group by commenthour order by commenthour asc");
	
    foreach ($y2010summary_commenters as $y2010summary_commenter) {
		$y2010summary_commentdata.='<li>'.$y2010summary_commenter->comment_author.': <strong>'.$y2010summary_commenter->howmany.'</strong> '.$y2010summary_trans[12][$y2010summary_lang].'</li>';
	}
	
	foreach ($y2010summary_months as $y2010summary_month) {
		$y2010summary_monthdata.='<tr><td style="width:110px;text-align:right;font-weight:bold;">'.__(date("F",mktime(0,0,0,$y2010summary_month->postmonth,1,2010))).':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_month->howmany/$y2010summary_noposts->howmany*70).'px"></div> &nbsp; '.$y2010summary_month->howmany.' ('.round($y2010summary_month->howmany/$y2010summary_noposts->howmany*100,2).'%)</td></tr>';
	}
	
	foreach ($y2010summary_commentmonths as $y2010summary_commentmonth) {
		$y2010summary_commentmonthdata.='<tr><td style="width:110px;text-align:right;font-weight:bold;">'.__(date("F",mktime(0,0,0,$y2010summary_commentmonth->commentmonth,1,2010))).':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_commentmonth->howmany/$y2010summary_nocomm->howmany*70).'px"></div> &nbsp; '.$y2010summary_commentmonth->howmany.' ('.round($y2010summary_commentmonth->howmany/$y2010summary_nocomm->howmany*100,2).'%)</td></tr>';
	}
	
	foreach ($y2010summary_hours as $y2010summary_hour) {
	$y2010summary_hourdata.='<tr><td style="width:50px;text-align:right;font-weight:bold;">'.$y2010summary_hour->posthour.':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_hour->howmany/$y2010summary_noposts->howmany*70).'px"></div> &nbsp; '.$y2010summary_hour->howmany.' ('.round($y2010summary_hour->howmany/$y2010summary_noposts->howmany*100,2).'%)</td></tr>';
	}
	
	foreach ($y2010summary_commenthours as $y2010summary_commenthour) {
	$y2010summary_commenthourdata.='<tr><td style="width:50px;text-align:right;font-weight:bold;">'.$y2010summary_commenthour->commenthour.':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_commenthour->howmany/$y2010summary_nocomm->howmany*70).'px"></div> &nbsp; '.$y2010summary_commenthour->howmany.' ('.round($y2010summary_commenthour->howmany/$y2010summary_nocomm->howmany*100,2).'%)</td></tr>';
	}
	
	foreach ($y2010summary_days as $y2010summary_day) {
		
		$y2010summary_daydata.='<tr><td style="width:110px;text-align:right;font-weight:bold;">'.__($y2010summary_day->postday).':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_day->howmany/$y2010summary_noposts->howmany*70).'px"></div> &nbsp; '.$y2010summary_day->howmany.' ('.round($y2010summary_day->howmany/$y2010summary_noposts->howmany*100,2).'%)</td></tr>';
		
	}
	
	foreach ($y2010summary_commentsday as $y2010summary_commentday) {
		
		$y2010summary_commentdaydata.='<tr><td style="width:110px;text-align:right;font-weight:bold;">'.__($y2010summary_commentday->commentday).':</td><td><div class="y2010summaryChartBar" style="width:'.round($y2010summary_commentday->howmany/$y2010summary_nocomm->howmany*70).'px"></div> &nbsp; '.$y2010summary_commentday->howmany.' ('.round($y2010summary_commentday->howmany/$y2010summary_nocomm->howmany*100,2).'%)</td></tr>';
		
	}
	
	foreach ($y2010summary_topcom as $y2010summary_post) {
		$y2010summary_postdata.='<li><a href="'.get_permalink($y2010summary_post->ID).'">'.$y2010summary_post->post_title.'</a>: <strong>'.$y2010summary_post->comment_count.'</strong> '.$y2010summary_trans[12][$y2010summary_lang].'</li>';
	}
	
	
	foreach ($y2010summary_postsbyauthors as $y2010summary_author) {
		$y2010summary_authorprofile=get_userdata($y2010summary_author->post_author);
		$y2010summary_authordata.='<li>'.$y2010summary_authorprofile->display_name.': <strong>'.$y2010summary_author->howmany.'</strong> '.$y2010summary_trans[13][$y2010summary_lang].'</li>';
	}
	
	foreach ($y2010summary_commbyauthors as $y2010summary_commauthor) {
		$y2010summary_authorprofile2=get_userdata($y2010summary_commauthor->user_id);
		$y2010summary_commauthordata.='<li>'.$y2010summary_authorprofile2->display_name.': <strong>'.$y2010summary_commauthor->howmany.'</strong> '.$y2010summary_trans[12][$y2010summary_lang].'</li>';
	}

	
	$y2010summary_text.='
	<style type="text/css">.y2010summaryChartBar{height:15px;background:#1A87D5;display:inline-block;}</style>
	<p>'.sprintf($y2010summary_trans[14][$y2010summary_lang],$y2010summary_noposts->howmany,$y2010summary_nopages->howmany,$y2010summary_noattach->howmany).'</p>
	<p>&nbsp;</p>
	<div class="y2010summaryCol1">
	<p><strong>'.$y2010summary_trans[15][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_monthdata.'</table>
	
	<p>&nbsp;</p>
	
	<p><strong>'.$y2010summary_trans[16][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_daydata.'</table>
	
	</div>
	<div class="y2010summaryCol2">
	<p><strong>'.$y2010summary_trans[17][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_hourdata.'</table>
	</div>
	<div class="y2010summaryClear"></div>
	<p>&nbsp;</p>
	<p>'.sprintf($y2010summary_trans[18][$y2010summary_lang],$y2010summary_nocomm->howmany,$y2010summary_nocommr->howmany,round($y2010summary_nocommr->howmany/$y2010summary_nocomm->howmany*100,2)).'</p>
	<p>&nbsp;</p>
	<p><strong>'.$y2010summary_trans[19][$y2010summary_lang].':</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_commentdata.'</ul>
	<p>&nbsp;</p>
	<p><strong>'.$y2010summary_trans[20][$y2010summary_lang].':</strong></p>
	<ul class="y2010summaryList">'.$y2010summary_postdata.'</ul>
	<p>&nbsp;</p>
	<div class="y2010summaryCol1">
	<p><strong>'.$y2010summary_trans[21][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_commentmonthdata.'</table>
	<p>&nbsp;</p>
	<p><strong>'.$y2010summary_trans[22][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_commentdaydata.'</table>
	</div>
	<div class="y2010summaryCol2">
	<p><strong>'.$y2010summary_trans[23][$y2010summary_lang].':</strong></p>
	<table class="y2010summaryTable">'.$y2010summary_commenthourdata.'</table>
	</div>
	<div class="y2010summaryClear"></div>
	';
	
	if($y2010summary_noauthors->howmany>1){
		$y2010summary_text.='<p>'.$y2010summary_trans[24][$y2010summary_lang].'</p>
		<ul class="y2010summaryList">'.$y2010summary_authordata.'</ul>
		<p>&nbsp;</p>
		<p>'.$y2010summary_trans[25][$y2010summary_lang].'</p>
		<ul class="y2010summaryList">'.$y2010summary_commauthordata.'</ul>
		<p>&nbsp;</p>
		';
		
	}
	
	
	$y2010summary_draft=base64_encode(str_replace($y2010summary_trans[29][$y2010summary_lang],$y2010summary_trans[30][$y2010summary_lang],$y2010summary_text).'<p>'.$y2010summary_trans[26][$y2010summary_lang].'</p>');

	echo '<p>&nbsp;</p><form name="y2010summary_draft" method="post" action=""><input type="submit" name="generateDraft" class="button-primary" value="'.$y2010summary_trans[27][$y2010summary_lang].'" /> 
  <input type="hidden" name="y2010summary_draft" value="TRUE" />
  <input type="hidden" name="y2010summary_draftcontent" value="'.$y2010summary_draft.'" />
  </form>&nbsp;
	<div id="poststuff"><div class="postbox"><h3 class="hndle"><span>'.$y2010summary_trans[28][$y2010summary_lang].'</span></h3><div class="inside"><p>&nbsp;</p>';
	echo $y2010summary_text;

	echo '</div></div></div>';
	
	echo '<form name="y2010summary_draft" method="post" action="">
  <input type="submit" name="generateDraft" class="button-primary" value="'.$y2010summary_trans[27][$y2010summary_lang].'" /> 
  <input type="hidden" name="y2010summary_draft" value="TRUE" />
  <input type="hidden" name="y2010summary_draftcontent" value="'.$y2010summary_draft.'" />
  </form>
  <p>&nbsp;</p>';
	
}

?>