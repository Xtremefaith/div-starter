			<footer class="footer" role="contentinfo">
			                        
			    <div id="inner-footer" class="wrap clearfix">
				    <div id="footer-widgets" class="clearfix">
			            <div class="footer-widget threecol first">
			                    <?php if ( is_active_sidebar( 'footer1' ) ) : ?>

			                            <?php dynamic_sidebar( 'footer1' ); ?>

			                    <?php else : ?>

			                            <!-- This content shows up if there are no widgets defined in the backend. -->
			                            
			                            <div class="alert help">
			                                    <p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
			                            </div>

			                    <?php endif; ?>
			            </div>

			            <div class="footer-widget twocol">
			                    <?php if ( is_active_sidebar( 'footer2' ) ) : ?>

			                            <?php dynamic_sidebar( 'footer2' ); ?>

			                    <?php else : ?>

			                            <!-- This content shows up if there are no widgets defined in the backend. -->
			                            
			                            <div class="alert help">
			                                    <p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
			                            </div>

			                    <?php endif; ?>
			            </div>
				            
			            <div class="footer-widget fourcol">
			                    <?php if ( is_active_sidebar( 'footer3' ) ) : ?>

			                            <?php dynamic_sidebar( 'footer3' ); ?>

			                    <?php else : ?>

			                            <!-- This content shows up if there are no widgets defined in the backend. -->
			                            
			                            <div class="alert help">
			                                    <p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
			                            </div>

			                    <?php endif; ?>
			            </div>

			            <div class="footer-widget threecol">
			                <?php if ( is_active_sidebar( 'footer4' ) ) : ?>

			                    <?php dynamic_sidebar( 'footer4' ); ?>

			                <?php else : ?>

			                    <!-- This content shows up if there are no widgets defined in the backend. -->
			                    
			                    <div class="alert help">
			                        <p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
			                    </div>

			                <?php endif; ?>
			            </div>
				    </div>

				    <nav role="navigation">
				    	<?php div_starter_footer_links(); ?>
					</nav>
			            
			        <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved. Site by <a href="http://www.divtruth.com" target="_blank">Div Truth LLC</a>.</p>
			    
			    </div> <!-- end #inner-footer -->
			    
			</footer> <!-- end footer -->

		</div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

    </body>

</html> <!-- end page. what a ride! -->