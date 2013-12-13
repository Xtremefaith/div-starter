<?php
/*
Plugin Name: SearchRelevance
Plugin URI: http://www.sabletopia.co.uk/search-relevance/
Description: Adjust WordPress search results to order by relevance, not by date.
Version: 2.0.0
Author: Darren Douglas
Author URI: http://www.sabletopia.co.uk/
License: GPL3
*/

/*
 * SearchRelevance
 * Copyright (C) 2013 Sable Designs - darren.douglas@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('ABSPATH') or die("Cannot access pages directly.");

class ssrch_class {
    private $options;
	private $defaults = array(
		'relevance-text' => 'Relevance',
		'hide-rel' => 0,
		'hideadmin-rel' => 0,
		'style-rel' => 0,
		'highlight' => 1,
		'custom-excerpt' => 1,
		'excerpt-length' => 300,
	);

	function ssrch_class() {
        $this->ssrch_initCode();
        if ( is_admin() ){
            add_action('admin_menu', array( $this, 'add_ssrch_menu' ));
            add_action('admin_init', array( $this, 'register_settings' ));
        }
    }

    /* add filters to amend serch sql */
    function ssrch_initCode() {
       	$plugin = plugin_basename(__FILE__);
		$this->options = wp_parse_args(get_option('ssrch_options'), $this->defaults);

        add_filter('posts_orderby', array( $this, 'ssrch_posts_orderby' ));
        add_filter('posts_fields', array( $this, 'ssrch_posts_fields' ));
		add_filter("plugin_action_links_$plugin", array( $this, 'settings_link' ));
        add_filter('plugin_row_meta', array( $this, 'plugin_meta_links' ), 10, 2 );

        if ($this->options['highlight']) {
            add_filter('the_title', array( $this, 'ssrch_filter_the_title' ));
        }
        if ($this->options['custom-excerpt']) {
            add_filter('get_the_excerpt', array($this, 'ssrch_filter_the_excerpt'));
        }
    }

    /* add menu */
	function add_ssrch_menu () {
        add_options_page( 'Search Relevance Settings', 'Search Relevance', 'manage_options', 'ssrch', array( $this, 'ssrch_page' ));
	}

    /* add menu page */
	function ssrch_page () {
        //include 'search_options.php';
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Search Settings</h2>
            <form method="post" action="options.php">
            <?php
                // Print out all hidden setting fields
                settings_fields( 'ssrch_option_group' );
                do_settings_sections( 'ssrch' );
                submit_button();
            ?>
            </form>
        </div>
        <?php
	}

    function register_settings(){
        register_setting(
            'ssrch_option_group', // Option group
            'ssrch_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
        add_settings_section(
            'ssrch_setting_display', // ID
            'Display Settings', // Title
            array( $this, 'ssrch_setting_display' ), // Callback
            'ssrch' // Page
        );
        add_settings_field(
            'relevance-text', // ID
            'Relevance Text', // Title
            array( $this, 'relevance_text_callback' ), // Callback
            'ssrch', // Page
            'ssrch_setting_display' // Section
        );
        add_settings_field(
            'hide-rel',
            'Hide Relevance',
            array( $this, 'hide_rel_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
        add_settings_field(
            'hideadmin-rel',
            'Hide Admin Relevance',
            array( $this, 'hideadmin_rel_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
        add_settings_field(
            'style-rel',
            'Style Relevance',
            array( $this, 'style_rel_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
        add_settings_field(
            'highlight',
            'Highlight',
            array( $this, 'highlight_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
        add_settings_field(
            'custom-excerpt',
            'Custom Excerpt',
            array( $this, 'custom_excerpt_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
        add_settings_field(
            'excerpt-length',
            'Excerpt Length',
            array( $this, 'excerpt_length_callback' ),
            'ssrch',
            'ssrch_setting_display'
        );
    }

     /* Sanitize each setting field */
    public function sanitize( $input ) {
        if( !is_numeric( $input['excerpt-length'] ) ) {
			$input['excerpt-length'] = '';
		}
        if( !empty( $input['relevance-text'] ) ) {
            $input['relevance-text'] = sanitize_text_field( $input['relevance-text'] );
        }
        if( !empty( $input['hide-rel'] ) ) {
            $input['hide-rel'] = 1;
        } else {
            $input['hide-rel'] = 0;
        }
        if( !empty( $input['hideadmin-rel'] ) ) {
            $input['hideadmin-rel'] = 1;
        } else {
            $input['hideadmin-rel'] = 0;
        }
        if( !empty( $input['style-rel'] ) ) {
            $input['style-rel'] = 1;
        } else {
            $input['style-rel'] = 0;
        }
        if( !empty( $input['hide-rel'] ) ) {
            $input['hide-rel'] = 1;
        } else {
            $input['hide-rel'] = 0;
        }
        if( !empty( $input['highlight'] ) ) {
            $input['highlight'] = 1;
        } else {
            $input['highlight'] = 0;
        }
        if( !empty( $input['custom-excerpt'] ) ) {
            $input['custom-excerpt'] = 1;
        } else {
            $input['custom-excerpt'] = 0;
        }
        return $input;
    }

    /* Section text */
    public function ssrch_setting_display() {
        print 'Configure settings that control your search display:';
    }

    function relevance_text_callback(){
        printf(
            '<input type="text" id="relevance-text" name="ssrch_options[relevance-text]" value="%s" />',
            esc_attr( $this->options['relevance-text'])
        );
    }
    function hide_rel_callback() {
        echo '<input name="ssrch_options[hide-rel]" id="hide-rel" type="checkbox" value="1" class="code" ' . checked( 1, $this->options['hide-rel'], false ) . ' /> ';
        echo 'Hide relavence score in result titles';
    }
    function hideadmin_rel_callback() {
        echo '<input name="ssrch_options[hideadmin-rel]" id="hideadmin-rel" type="checkbox" value="1" class="code" ' . checked( 1, $this->options['hideadmin-rel'], false ) . ' /> ';
        echo 'Hide relavence score in admin result titles';
    }
    function style_rel_callback() {
        echo '<input name="ssrch_options[style-rel]" id="style-rel" type="checkbox" value="1" class="code" ' . checked( 1, $this->options['style-rel'], false ) . ' /> ';
        echo 'Attempt to add inline style to relavence scores {float: right;}';
    }
    function highlight_callback() {
        echo '<input name="ssrch_options[highlight]" id="highlight" type="checkbox" value="1" class="code" ' . checked( 1, $this->options['highlight'], false ) . ' /> ';
        echo 'Highlight search terms in results.';
    }
    function custom_excerpt_callback() {
        echo '<input name="ssrch_options[custom-excerpt]" id="custom-excerpt" type="checkbox" value="1" class="code" ' . checked( 1, $this->options['custom-excerpt'], false ) . ' /> ';
        echo 'Use custom excerpts centered on search term matches.';
    }
    function excerpt_length_callback() {
        printf(
            '<input type="text" id="excerpt-length" name="ssrch_options[excerpt-length]" value="%s" />',
            esc_attr( $this->options['excerpt-length'])
        );
    }
 /* Add settings link on plugin page */
	function settings_link($links) {
		$settings_link = '<a href="options-general.php?page=ssrch">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
    function plugin_meta_links( $links, $file ) {
        $plugin = plugin_basename(__FILE__);
        if ( $file == $plugin ) {
            $links[] = '<a href="http://www.sabletopia.co.uk/" target="_blank">Visit Sabletopia</a>';
            $links[] = '<a href="mailto:darren.douglas@gmail.com?subject=[SearchRelevance]">Email Author</a>';
        }
        return $links;
    }

    //  function extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...') {
    function ssrch_filter_the_excerpt($excerpt) {
        global $post;
        if (is_search() && in_the_loop() && !is_admin()) {
            // is this a relavence modified search?
            if (isset($post->ssrch_relevance_percent)){
                $srch = get_search_query(false);
                $srch_array = $this->ssrch_splitSearch($srch);
                $srch_text = implode(' ',$srch_array);
                $excerpt = wp_kses($post->post_content,array());
                $excerpt = $this->extractRelevant($srch_array, $excerpt, $this->options['excerpt-length'], ($this->options['excerpt-length'] / 6), '...');
                if ($this->options['highlight']) {
                    $excerpt = $this->highlight($excerpt, $srch_text);
                }
                $remove = array("\r\n", "\n", "\r");
                $excerpt = str_replace($remove, ' ', $excerpt);
            }
        }
        return $excerpt;
    }

    /* add relavence percentage to titles */
    function ssrch_filter_the_title( $title ) {
        global $post;
        if (is_search() && in_the_loop()) {
            if (isset($post->ssrch_relevance_percent)){
                if (is_admin()){
					if (!$this->options['hideadmin-rel']) {
	                    return $title . " (" . number_format(($post->ssrch_relevance_percent*100),0) ."%)";
					}
                } else {
                    $newtitle = $title;
					if (!$this->options['hide-rel']) {
	                    $newtitle .=" <span class='ssrch_relevance' ";
						if ($this->options['style-rel']) {
							$newtitle .= " style='float:right;' ";
						}
						$newtitle .= ">(" . number_format(($post->ssrch_relevance_percent*100),0) ."% ".$this->options['relevance-text'].")</span>";
					}
					if ($this->options['highlight']) {
						$srch = get_search_query(false);
			            $srch_array = $this->ssrch_splitSearch($srch);
						$newtitle = $this->highlight($newtitle,implode(' ',$srch_array));
					}
					return $newtitle;
                }
            }
        }
        return $title;
    }

    /* sort by new search relavence feild */
    function ssrch_posts_orderby($orderby) {
        if(is_search()) {
            $orderby = " ssrch_relevance DESC";
        }
        return $orderby;
    }

    /* add relavene and score feilds to search results */
    function ssrch_posts_fields($fields){
        if(is_search()) {
            $srch = get_search_query(false);
            $srch_array = $this->ssrch_splitSearch($srch);
            $size = count($srch_array);
            $maxscore = ($size * 100) + ($size * 10) + ($size * 1);
            $sql = $this->ssrch_makerelevanceSql($srch_array);
            $fields .= ", (  " . $sql . "  ) as ssrch_relevance, (" . $sql . "/".$maxscore.") as ssrch_relevance_percent";
        }
        return ($fields);
    }

    /* build sql for search algorithm */
    function ssrch_makerelevanceSql($lookfor) {
        global $wpdb;
        $tmpsql="(";
        $tmpsql2="(";
        $tmpsql3="(";
        for($i = 0, $size = count($lookfor); $i < $size; ++$i) {
            $tmpsql.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_title),1,0))";
            $tmpsql2.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_excerpt),1,0))";
            $tmpsql3.="(if(locate('".$lookfor[$i]."',".$wpdb->posts.".post_content),1,0))";
            if ($i+1<$size) {
                $tmpsql.="+";
                $tmpsql2.="+";
                $tmpsql3.="+";
            }
        }
        $tmpsql.=")";
        $tmpsql2.=")";
        $tmpsql3.=")";
        $result = "((".$tmpsql."*100)+(".$tmpsql2."*10)+(".$tmpsql3."*1))";
        return $result;
    }

    /* split search terms into words */
     function ssrch_splitSearch($srch) {
        $ary = array();
        if (empty($srch)) { return $ary; }
        $needles = array(",", "+", ".", "-", "_", "/", "\\", '"', "'", "<",">",";","  ");
        $srchcleaned = esc_sql(str_replace($needles, " ", $srch));
        return explode(" ",$srchcleaned);
    }

	function highlight($text, $words) {
	    preg_match_all('~\w+~', $words, $m);
	    if(!$m)
	        return $text;
	    $re = '~\\b(' . implode('|', $m[0]) . ')\\b~i';
	    return preg_replace($re, '<b class="ssrch_highlight">$0</b>', $text);
	}

    /*
        Excerpt code based on  https://github.com/boyter/php-excerpt
    */

    // find the locations of each of the words
    function _extractLocations($words, $fulltext) {
        $locations = array();
        foreach($words as $word) {
            $wordlen = strlen($word);
            $loc = stripos($fulltext, $word);
            while($loc !== FALSE) {
                $locations[] = $loc;
                $loc = stripos($fulltext, $word, $loc + $wordlen);
            }
        }
        $locations = array_unique($locations);
        sort($locations);
        return $locations;
    }

    // Work out which is the most relevant portion to display
    function _determineSnipLocation($locations, $prevcount) {
        // If we only have 1 match we dont actually do the for loop so set to the first
        $startpos = $locations[0];
        $loccount = count($locations);
        $smallestdiff = PHP_INT_MAX;
        // If we only have 2 skip as its probably equally relevant
        if(count($locations) > 2) {
            // skip the first as we check 1 behind
            for($i=1; $i < $loccount; $i++) {
                if($i == $loccount-1) { // at the end
                    $diff = $locations[$i] - $locations[$i-1];
                }
                else {
                    $diff = $locations[$i+1] - $locations[$i];
                }
                if($smallestdiff > $diff) {
                    $smallestdiff = $diff;
                    $startpos = $locations[$i];
                }
            }
        }
        $startpos = $startpos > $prevcount ? $startpos - $prevcount : 0;
        return $startpos;
    }

    // 1/6 ratio on prevcount tends to work pretty well and puts the terms in the middle of the extract
    function extractRelevant($words, $fulltext, $rellength=300, $prevcount=50, $indicator='...') {
        $textlength = strlen($fulltext);
        if($textlength <= $rellength) {
            return $fulltext;
        }
        $locations = $this->_extractLocations($words, $fulltext);
        $startpos  = $this->_determineSnipLocation($locations,$prevcount);
        // if we are going to snip too much...
        if($textlength-$startpos < $rellength) {
            $startpos = $startpos - ($textlength-$startpos)/2;
        }
        $reltext = substr($fulltext, $startpos, $rellength);
        // check to ensure we dont snip the last word if thats the match
        if( $startpos + $rellength < $textlength) {
            $reltext = substr($reltext, 0, strrpos($reltext, " ")).$indicator; // remove last word
        }
        // If we trimmed from the front add ...
        if($startpos != 0) {
            $reltext = $indicator.substr($reltext, strpos($reltext, " ") + 1); // remove first word
        }
        return $reltext;
    }
}