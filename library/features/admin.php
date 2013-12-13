<?php
/*
This file handles the admin area and functions.
You can use this file to make changes to the
dashboard.
*/

/************* DASHBOARD WIDGETS *****************/

# disable default dashboard widgets
function disable_default_dashboard_widgets() {
	# remove_meta_box('dashboard_right_now', 'dashboard', 'core');     # Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); # Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  # Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         # Plugins Widget

	# remove_meta_box('dashboard_quick_press', 'dashboard', 'core');   # Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   # Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         #
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       #

	# removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         # Yoast's SEO Plugin Widget
}

/*
Now let's talk about adding your own custom Dashboard widget.
Sometimes you want to show clients feeds relative to their
site's content. For example, the NBA.com feed for a sports
site. Here is an example Dashboard Widget that displays recent
entries from an RSS Feed.

For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

#TODO: Need to relocate widget to its own file

# RSS Dashboard Widget
function div_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');               // include the required file
		$feed = fetch_feed('http://themble.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity(7);                      // specify number of items
		$items = $feed->get_items(0, $limit);                      // create an array of items
	}
	if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date(__('j F Y @ g:i a', 'divtruth'), $item->get_date('Y-m-d H:i:s')); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php }
}

# removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');

/************* CUSTOM LOGIN/ADMIN PAGE *****************/

// calling your own login css so you can style it

//Updated to proper 'enqueue' method
//http://codex.wordpress.org/Plugin_API/Action_Reference/login_enqueue_scripts
function div_login_css() {
	wp_enqueue_style( 'div_login_css', get_template_directory_uri() . '/library/css/login.css', false );
	wp_enqueue_style( 'theme_login_css', get_stylesheet_directory_uri() . '/library/css/login.css', false );
}

function div_admin_css() {
	if ( WP_VERSION >= 3.8 ){
		wp_enqueue_style( 'div_admin_css', get_template_directory_uri() . '/library/css/admin.css', false );
	} else {
		wp_enqueue_style( 'div_admin_css', get_template_directory_uri() . '/library/css/admin_fallback.css', false );
	}
	wp_enqueue_style( 'theme_admin_css', get_stylesheet_directory_uri() . '/library/css/admin.css', false );
}

# calling it only on the login page
add_action( 'login_enqueue_scripts', 'div_login_css', 10 );

# calling it only admin
add_action( 'admin_enqueue_scripts', 'div_admin_css', 15 );


# Custom Backend Footer
add_filter('admin_footer_text', 'div_custom_admin_footer');
function div_custom_admin_footer() {
	_e('<span id="footer-thankyou">Theme Developed by <a href="http://www.divtruth.com" target="_blank">Div Truth LLC</a></span>.', 'divtruth');
}

?>
