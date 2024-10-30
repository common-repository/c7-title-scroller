<?php

function c7ts_options() {

if($_POST['c7ts_hidden'] == 'Y') {

	$c7ts_initial_delay = $_POST['c7ts_initial_delay'];
	$c7ts_scroll_choice = $_POST['c7ts_scroll_choice'];
	$c7ts_scroll_count = $_POST['c7ts_scroll_count'];
	$c7ts_scroll_speed = $_POST['c7ts_scroll_speed'];
	$c7ts_scroll_direct = $_POST['c7ts_scroll_direct'];

  $c7ts_ps_home=$c7ts_page_options['c7ts_ps_home']=$_POST['c7ts_ps_home'];
  $c7ts_ps_category=$c7ts_page_options['c7ts_ps_category']=$_POST['c7ts_ps_category'];
  $c7ts_ps_tag=$c7ts_page_options['c7ts_ps_tag']=$_POST['c7ts_ps_tag'];
  $c7ts_ps_post=$c7ts_page_options['c7ts_ps_post']=$_POST['c7ts_ps_post'];
  
	update_option('c7ts_initial_delay', $c7ts_initial_delay);
	update_option('c7ts_scroll_choice', $c7ts_scroll_choice);
	update_option('c7ts_scroll_count', $c7ts_scroll_count);
	update_option('c7ts_scroll_speed', $c7ts_scroll_speed);
	update_option('c7ts_scroll_direct', $c7ts_scroll_direct);
  update_option('c7ts_page_options', $c7ts_page_options);
	
?>	
<div class="updated">
<p><strong><?php _e('Settings saved.' ); ?></strong></p>
</div>
<?php
		} else {
			//Normal page display
			$c7ts_initial_delay = get_option('c7ts_initial_delay','1000');
			$c7ts_scroll_choice = get_option('c7ts_scroll_choice','0');
			$c7ts_scroll_count = get_option('c7ts_scroll_count','0');
			$c7ts_scroll_speed = get_option('c7ts_scroll_speed','250');
			$c7ts_scroll_direct = get_option('c7ts_scroll_direct','0');
			$c7ts_page_options = get_option('c7ts_page_options');
			if (empty($c7ts_page_options)) {
			   $c7ts_page_options = array('c7ts_ps_home' => 1,
			                 	            'c7ts_ps_category' => 1, 
				                            'c7ts_ps_tag' => 1, 
				                            'c7ts_ps_post' => 1);
        	update_option('c7ts_page_options', $c7ts_page_options);
    	   }				

      $c7ts_page_options = get_option('c7ts_page_options');
      $c7ts_ps_home = $c7ts_page_options['c7ts_ps_home'];
      $c7ts_ps_category = $c7ts_page_options['c7ts_ps_category'];
      $c7ts_ps_tag = $c7ts_page_options['c7ts_ps_tag'];
      $c7ts_ps_post = $c7ts_page_options['c7ts_ps_post'];
      
		}
?>
<div class="wrap">
<?php echo "<h2>". __( 'c7TitleScroller Setup Options - Scroll Your Page Titles', 'c7titlescroller' ) . "</h2>"; ?>  
<form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="c7ts_hidden" value="Y">
<?php wp_nonce_field('update-options'); ?>
<hr/>
<table class="form-table">
<tr valign="top">
<th scope="row">Initial Delay</th>
<td><input type="text" name="c7ts_initial_delay" value="<?php echo $c7ts_initial_delay; ?>" /> <?php _e("Initial wait time in milliseconds before scrolling" );?></td>
</tr>
<tr valign="top">
<th scope="row">Scroll Choice</th>
<td>
<input type="radio" name="c7ts_scroll_choice" value="-1" <?php if($c7ts_scroll_choice=='-1') echo "checked"?> > Scroll specified times<br>
<input type="radio" name="c7ts_scroll_choice" value="0" <?php if($c7ts_scroll_choice=='0') echo "checked"?> > Scroll Once<br>
<input type="radio" name="c7ts_scroll_choice" value="1" <?php if($c7ts_scroll_choice=='1') echo "checked"?> > Scroll Always<br>
</td>
</tr>
<tr valign="top">
<th scope="row">Scroll Count</th>
<td><input type="text" name="c7ts_scroll_count" value="<?php echo $c7ts_scroll_count; ?>" /><?php _e(" Number of times to scroll, if scroll choice selected is 'scroll specified times'" );?></td>
</tr>
<tr valign="top">
<th scope="row">Scroll Speed</th>
<td><input type="text" name="c7ts_scroll_speed" value="<?php echo $c7ts_scroll_speed; ?>" /><?php _e(" Scroll speed in milliseconds" );?></td>
</tr>
<th scope="row">Scroll Direction</th>
<td>
<input type="radio" name="c7ts_scroll_direct" value="0" <?php if($c7ts_scroll_direct=='0') echo "checked"?> > Left<br>
<input type="radio" name="c7ts_scroll_direct" value="1" <?php if($c7ts_scroll_direct=='1') echo "checked"?> > Right<br>
</td>
</tr>
<tr valign="top">
<th scope="row">Home</th>
<td><input type="checkbox" name="c7ts_ps_home" <?php if ($c7ts_ps_home) echo "checked=\"1\""; ?>/><?php _e(" Enable/Disable in Homepage" );?></td>
</tr>
<tr valign="top">
<th scope="row">Categories</th>
<td><input type="checkbox" name="c7ts_ps_category" <?php if ($c7ts_ps_category) echo "checked=\"1\""; ?>/><?php _e(" Enable/Disable in Category,Archive pages" );?></td>
</tr>
<tr valign="top">
<th scope="row">Tags</th>
<td><input type="checkbox" name="c7ts_ps_tag" <?php if ($c7ts_ps_tag) echo "checked=\"1\""; ?>/><?php _e(" Enable/Disable in Tag pages" );?></td>
</tr>
<tr valign="top">
<th scope="row">Posts</th>
<td><input type="checkbox" name="c7ts_ps_post" <?php if ($c7ts_ps_post) echo "checked=\"1\""; ?>/><?php _e(" Enable/Disable in Posts" );?></td>
</tr>
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="c7ts_initial_delay,c7ts_scroll_choice,c7ts_scroll_count,c7ts_scroll_speed" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Update Settings','c7titlescroller') ?>" />
</p>
</form>
</div>
<?php }
