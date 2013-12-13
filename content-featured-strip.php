<?php
$args = array(
	'post_status' 		=> 'publish',
	'posts_per_page'	=> 1,
);

$featured_query = new WP_Query($args);

while( $featured_query->have_posts() ) : $featured_query->the_post(); 

	$featured_id = get_post_thumbnail_id($post->ID);
	$featured_obj = get_post($featured_id); ?>

	<div id="featured-stripe-container" class="full">
		<div id="featured-stripe">
			<img class="stripe responsive" src="<?php echo $featured_obj->guid; ?>" />
		</div>
	</div>

	<?php //_e('<h1>'.get_the_title().'</h1>');

endwhile; ?>