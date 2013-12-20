<div id="mobile-menu" class="mobile">
	<div id="inner-mobile-menu" class="wrap">
		<div id="mobile-menu-header">
			<ul class="icons">
				<li id="menu-icon" class="menu-icon"><span></span></li>
				<a href="<?php bloginfo('url') ?>"><li class="mobile-logo"><span></span></li></a>
				<li id="search-icon" class="search-icon"><span></span></li>
			</ul>
		</div>
		<div id="mobile-menu-content">
			<div id="mobile-search-container">
				<div id="mobile-search" class="wrap">
					<form method="get" id="mobile-searchform" action="<?php home_url(); ?>/">
						<div id="mobile-search-submit">
							<input type="submit" id="searchsubmit" value="Search" class="btn" />
						</div>
						<div id="mobile-search-input">
							<input type="text" size="18" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" placeholder="" />
						</div>
					</form>
				</div>
			</div>
			<nav id="mobile" role="navigation">
				<?php div_starter_mobile_nav(); ?>
			</nav>
		</div>
	</div>
</div>