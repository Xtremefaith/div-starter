<?php get_header(); ?>

			<div id="content">
							
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="eightcol first clearfix" role="main">
						
						<?php $pagename = get_query_var('pagename'); ?>						
						<h1 class="page-title title-margin" itemprop="headline"><?php echo $pagename; ?></h1>

						<?php $counter = 0; ?>
					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>						
						<?php $counter++; ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							<?php if ($counter > 1): ?>
						    	<?php if (has_post_thumbnail()): ?>
									<div class="entry-content"><?php the_post_thumbnail( 'blog' ); ?></div>
								<?php endif; ?>
							<?php endif; ?>

						    <header class="article-header">
					
							    <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<p class="byline vcard"><?php
									printf(__('<time class="updated" datetime="%1$s" pubdate>%2$s @ %3$s </time>', 'divtruth'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_time('g:iA'));
									printf(__('<span class="tags">%1$s</span', 'divtruth'), get_the_category_list(', '));
								?></p>
						
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix">
								<?php if ($counter > 1): ?>
									<?php if (has_post_thumbnail()): ?>
										<div class="pad-left-200"><?php the_excerpt(); ?></div>
									<?php else : ?>
										<?php the_excerpt(); ?>
									<?php endif; ?>
								<?php elseif ($counter == 1): ?>
							    	<?php the_content(); ?>
							    	<hr>
								<?php endif; ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
    							<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>

						    </footer> <!-- end article footer -->
						    
						    <?php // comments_template(); // uncomment if you want to use them ?>
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
					
					        <?php if (function_exists('bones_page_navi')) { ?>
					            <?php bones_page_navi(); ?>
					        <?php } else { ?>
					            <nav class="wp-prev-next">
					                <ul class="clearfix">
					        	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
					        	        <li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
					                </ul>
					            </nav>
					        <?php } ?>		
					
					    <?php else : ?>
					    
					        <article id="post-not-found" class="hentry clearfix">
					            <header class="article-header">
					        	    <h1><?php _e("Post Not Found", "bonestheme"); ?></h1>
					        	</header>
					            <section class="entry-content">
					        	    <p><?php _e("Please visit our homepage.", "bonestheme"); ?></p>
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
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
