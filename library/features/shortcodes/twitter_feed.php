<?php 
/*
Feature Name:   Twitter Feed
Developer URI:  http://www.DivTruth.com
Author:         Div Truth
Description:    Using the new 1.1 Twitter API, you can now fetch your tweeter feed either as an array or formated output
*/

 /**
 * TWITTER FEED SHORTCODE
 * @example SHORTCODE: [get_tweets screen_name="divtruth" count="5" skip_status="1" include_rts="1"]
 * @example FUNCTION: get_tweets($settings=array('format'=>'array')) #Format must be array
 * 
 * @param <string> $screen_name
 * @param <string> $count
 * @param <number> $skip_status
 * @param <number> $include_rts
 * @return <string> $tweets
 */
function get_tweets( $atts ){
    extract( shortcode_atts( array(
        'screen_name'   => 'divtruth',
        'count'         => '5',
        'skip_status'   => 1,
        'include_rts'   => 1,
        'format'        => 'feed'
    ), $atts ) );

    $cacheTime = 1; // Time in minutes between updates.
    $exclude_replies = "false"; // Leave out @replies?
    $transName = 'list-tweets'; // Name of value in database.
    $backupName = $transName . '-backup'; // Name of backup value in database.

    # url and request method
    $host   = 'https://api.twitter.com';
    $path   = '/1.1/statuses/user_timeline.json';
    $method = 'GET';

    # configuration settings
    $settings = array(
        'oauth_access_token'        => get_field('oauth_access_token','options'),
        'oauth_access_token_secret' => get_field('oauth_access_token_secret','options'),
        'consumer_key'              => get_field('consumer_key','options'),
        'consumer_secret'           => get_field('consumer_secret','options')
    );
    if(in_array("", $settings)){
        return "You need to update your twitter settings.";
    }

    # parameters options
    $options = array(
        'screen_name' => $screen_name,
        'count'       => $count,
        'skip_status' => $skip_status,
        'include_rts' => $include_rts
    );

    $getfield = '?' . build_http_query($options);

    # execute the request
    $twitter = new TwitterAPIExchange($settings);
    $response = $twitter->setGetfield($getfield)
            ->buildOauth($host.$path, $method)
            ->performRequest();


    if(false === ($tweets = get_transient($transName) ) ) :    

        // If we didn't find tweets, use the previously stored values.
        if( !is_wp_error($response) ) :
            // Get tweets into an array.
            $tweets_json = json_decode($response, true);
            
            // Now update the array to store just what we need.
            // (Done here instead of PHP doing this for every page load)
            foreach ($tweets_json as $tweet) :

                // Core info.
                $name = $tweet['user']['screen_name'];
                //$name = print_r($tweet);
                $permalink = 'http://twitter.com/#!/'. $name .'/status/'. $tweet['id_str'];
                
                /* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
                $image = $tweet['user']['profile_image_url'];
                
                // Message. Convert links to real links.
                $pattern = '/http:(\S)+/';
                $replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
                $text = preg_replace($pattern, $replace, $tweet['text']);
                
                // Need to get time in Unix format.
                $time = $tweet['created_at'];
                $time = date_parse($time);
                $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
                
                // Now make the new array.
                $tweets[] = array(
                                'text' => $text,
                                'name' => $name,
                                'permalink' => $permalink,
                                'image' => $image,
                                'time' => $uTime
                                );
            endforeach;
            
            // Save our new transient, and update the backup.
            set_transient($transName, $tweets, 60 * $cacheTime);
            update_option($backupName, $tweets);
            
        else : // i.e. Fetching new tweets failed.
            $tweets = get_option($backupName); // False if there has never been data saved.
        endif;
    endif;

    // Now display the tweets, if we can.
    if($tweets) :
        if($format == "feed"){
            $output = '<ul id="tweets">';
            foreach($tweets as $t) :
                $output .= '<li>';
                    $output .= '<img src="'.$t['image'].'" width="32" alt="" />';                
                    $output .= '<div class="tweet-inner">';
                        $output .= '<p>';
                             $output .= '<a target="_blank" href="'.$t['permalink'].'">'.$t['name'] . '</a>: '. $t['text'];
                             $output .= ' - <span class="tweet-time">'.human_time_diff($t['time'], current_time('timestamp')).' ago</span>';
                        $output .= '</p>';
                    $output .= '</div><!-- /tweet-inner -->';
                $output .= '</li>';
            endforeach;
            $output .= '</ul>';
            $output .= '<a class="button twitter" target="_blank" href="http://twitter.com/#!/'. $screen_name .'">Follow us on Twitter</a>';
            return $output;
        } else if ($format == "array"){
            return $tweets;
        } else {
            return "Need to set proper format for response";
        }
    else :
        return '<p>No tweets found.</p>';
    endif;
}
add_shortcode( 'get_tweets', 'get_tweets' );

/**
 * Builds an http query string.
 * @param array $query  // of key value pairs to be used in the query
 * @return string       // http query string.
 */
function build_http_query( $query ){
    $query_array = array();
    foreach ( $query as $key => $key_value ) {
        $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
    }
    return implode( '&', $query_array );
}

?>