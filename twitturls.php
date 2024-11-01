<?php
/*
Plugin Name: Top Twitter Links by Twitturls
Plugin URI: http://twitturls.com/wordpress
Description: Today's most popular twitter links, powered by Twitturls
Author: Justin Palmer
Version: 0.2
Author URI: http://twitturls.com/
*/

/*  Copyright 2008  Justin Palmer  (email : justin@palmerville.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('MAGPIE_CACHE_ON', 0);
//define('MAGPIE_CACHE_AGE', 60*5); // 5 minutes

function twitturls_links()
{
  include_once(ABSPATH . WPINC . '/rss.php');
  $toptweets = fetch_rss('http://feeds2.feedburner.com/twitturls-popular-today');
  
  echo '<ul>';
  if ( $toptweets <> "") {
	foreach ( $toptweets->items as $tweet ) {
          
    $title = $tweet['title'];
		$link = $tweet['link'];
        
    echo '<li><a href="'.$link.'">'.$title.'</a></li>';
		
		$i++;
		if ( $i >= 5 ) break;
	}
	}
	echo '</ul>';	
	echo '<br>Powered by <a href="http://twitturls.com">Twitturls</a>';
	
}

function widget_twitturls_links($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>Top Twitter Links<?php echo $after_title;
  twitturls_links();
  echo $after_widget;
}

function twitturls_links_init()
{
  register_sidebar_widget(__('Top Twitter Links'), 'widget_twitturls_links');
}
add_action("plugins_loaded", "twitturls_links_init");
?>
