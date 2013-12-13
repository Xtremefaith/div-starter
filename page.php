<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="eightcol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						    <header class="article-header">

							    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						    
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix" itemprop="articleBody">
						    	<?php if (has_post_thumbnail()): ?>
						    		<div id="page-banner">
						    			<?php the_post_thumbnail( 'page' ); ?>
						    		</div>
						    	<?php endif; ?>
							    <?php the_content(); ?>
							</section> <!-- end article section -->
						
						    <footer class="article-footer">
                  <?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?>
							
						    </footer> <!-- end article footer -->
						    
					
					    </article> <!-- end article -->
					
					    <?php endwhile; else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Page Not Found", "bonestheme"); ?></h1>
    					    	</header>
    					    	<section class="entry-content">
    							    <p><?php _e("Please visit our home page.", "bonestheme"); ?></p>
 									<ul>
										<li><a href="/">Home</a></li>
									</ul>
    					    	</section>
    					    	<footer class="article-footer">
    					    	</footer>
    					    </article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
				    <?php get_sidebar(); ?>

					<?php if ( is_active_sidebar( 'cta' ) ) : ?>
						<div id="page-cta" class="twelvecol first clearfix">
							<?php dynamic_sidebar( 'cta' ); ?>
						</div>
					<?php else : ?>
					<?php endif; ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->
<?php get_footer(); ?>
