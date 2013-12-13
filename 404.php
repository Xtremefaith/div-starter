<?php get_header(); ?>
			
			<div id="content">

				<div id="inner-content" class="wrap clearfix">
			
					<div id="main" class="eightcol first clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix">
						
							<header class="article-header">
							
								<h1><?php _e("404 - Post or Page Not Found", "bonestheme"); ?></h1>
						
							</header> <!-- end article header -->
					
							<section class="entry-content">
							
								<p><?php _e("Please visit our home page.", "bonestheme"); ?></p>
 								<ul>
									<li><a href="/">Home</a></li>
								</ul>
					
							</section> <!-- end article section -->

							<section class="search">
				
							    <p><?php get_search_form(); ?></p>
				
							</section> <!-- end search section -->
						
							<footer class="article-footer">
							
							</footer> <!-- end article footer -->
					
						</article> <!-- end article -->
			
					</div> <!-- end #main -->

				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
