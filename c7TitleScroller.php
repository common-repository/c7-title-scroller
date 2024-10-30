<?
/*
 * Plugin Name: C7 Title Scroller
 * Plugin URI: http://www.reputedjobs.com/
 * Description: Does your blog or website has long page titles as part of SEO and you would like your users to read all of them ? or simply want to grab attention for your blog window in the users computer, with an animated page title..?  Then you might want to consider this plugin. This plugin  makes the web page title scroll, based on the options you setup in the wordpress administrator.
 * Version: 1.1
 * Author: Josh Prakash, Cybercrat Systems
 * Author URI: http://www.cybercratsystems.com/
 * Copyright 2009-2010  Cybercrat Systems  (email : wordpress@cybercratsystems.com)
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

include("c7Options.php");

function c7titlescroller(){

 // scroll
$scrollchoice = (int) get_option('c7ts_scroll_choice','0');
$scrollcount  = (int) get_option('c7ts_scroll_count','0');
$scrolldirect = (int) get_option('c7ts_scroll_direct','0');
 //timers
$initialdelay = (int) get_option('c7ts_initial_delay','1000');
$scrollspeed  = (int) get_option('c7ts_scroll_speed','250');

//page settings
$c7ts_page_options = get_option('c7ts_page_options');

$c7ts_ps_home = $c7ts_page_options['c7ts_ps_home'];
$c7ts_ps_category = $c7ts_page_options['c7ts_ps_category'];
$c7ts_ps_tag = $c7ts_page_options['c7ts_ps_tag'];
$c7ts_ps_post = $c7ts_page_options['c7ts_ps_post'];

if ((is_home() && ($c7ts_ps_home)) || (is_archive() && ($c7ts_ps_category)) || (is_tag() && ($c7ts_ps_tag)) || (is_single() && ($c7ts_ps_post)) ){

    echo '<script type="text/javascript">
		/*
		(c) C7TitleScroller - Scrolls the page titles , http://www.cybercratsystems.com - 2009
		*/		
    <!--
    var r='.$scrollchoice.'; 
    var t=document.title+" ";
    var l=t.length;';
    if ($scrolldirect==0){ echo 'var s=0;';}else{ echo 'var m=l;';}
    echo 'var c='.$scrollcount.';
    function c7scroller() {';
      if ($scrolldirect==0){ 
      echo 'title=t.substring(s, l) + t.substring(0, s);
      document.title=title;
      s=s+1;
      if (s==l+1) {
        s=0;'; }
      else{
      echo 'title=t.substring(m, l) + t.substring(0, m);
      document.title=title;
      m=m-1;
      if (m==-1) {
        m=l;';
      }
         echo 'if (r==-1 && c>0) c=c-1;
        if ((r==0) ||( r==-1 && c==0)) return;
        }
      setTimeout("c7scroller()", '.$scrollspeed.' );
     }
     if (document.title)
      setTimeout("c7scroller()",'.$initialdelay.');
     //--> 
     </script>';
    }
}

add_action('wp_footer', 'c7titlescroller');

function c7ts_menu() {
  add_options_page('C7 Title Scroller', 'C7 Title Scroller', 'manage_options', basename(__FILE__), 'c7ts_options');
}
add_action('admin_menu', 'c7ts_menu');
