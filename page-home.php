<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>
	<div id="top-feature">
		<div id="inner-top-feature" class="wrap clearfix">
			<?php if ( is_active_sidebar( 'hero' ) ) : ?>
				<div id="slide-wrap" class="sixcol first">
					<div id="home-slider">
						<?php dynamic_sidebar( 'hero' ); ?>
					</div>
				</div>
			<?php else : ?>
			<?php endif; ?>
		
	
			<?php if ( is_active_sidebar( 'cta' ) ) : ?>
				<div id="home-cta" class="sixcol last">
					<?php dynamic_sidebar( 'cta' ); ?>
				</div>
			<?php else : ?>
			<?php endif; ?>
		</div>	
	</div>
	<div id="content">
	
		<div id="inner-content" class="wrap clearfix">

			<?php if ( is_active_sidebar( 'features' ) ) : ?>
				<div id="home-features" class="twelvecol first clearfix">
					<?php dynamic_sidebar( 'features' ); ?>
				</div>
			<?php else : ?>
			<?php endif; ?>

		    <div id="main" class="eightcol first clearfix" role="main">
			<?php if ( is_active_sidebar( 'home-posts' ) ) : ?>
				<div id="home-posts">
					<?php dynamic_sidebar( 'home-posts' ); ?>
				</div>
			<?php else : ?>
			<?php endif; ?>

	
		    </div> <!-- end #main -->

		    <?php get_sidebar(); ?>
		    
		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
