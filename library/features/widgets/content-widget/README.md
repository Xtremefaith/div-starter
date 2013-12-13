# Content Widget

## Description
This widget allows users to easily drop content in any area of their theme that uses a sidebar. With some simple options (and more to come) then can add content from pages, post, or custom post types. 

This widget functions off the [Content Feed Shortcode](https://bitbucket.org/betsela/plus1-starter-theme/src/develop/library/features/shortcodes/content_feed.php?at=develop), so if a widget will not do the trick the same functionality can be obtained through the shortcode directly

## Requirements
+ Content Feed Shortcode

## Instructions

#### Widget
From your WordPress Dashboard go to: `Appearance -> Widgets` Open the sidebar you wish to use and drag and drop the "Plus1 Content Widget" into it. Change the settings as needed per that instance and you're done

#### Shortcode
Below is a outline to the options within the shortcode, place anywhere shortcodes are accepted. The values listed below are the default options, you can test by simply using `[get_content]`

	[get_content 
        $title           => '',             # h4 Header
        $class           => '',             # aside class
        $post_type       => 'post',         # post, page, or cpt
        $order           => 'DESC',         # ASC or DESC
        $post_image      => '',             # left, right, or none
        $image_size      => 'thumbnail',    # thumbnail, medium, large, or custom
        $post_excluded   => '',             # post_ids
        $post_included   => '',             # post_ids
        $posts_per_page  => '3',            # number of post to display
        $character_limit => '',             # <optional> set a character limit
        $more_link       => '',             # if character limit then set a more permalink text
        $category        => '',             # category_ids
    ] 

## Contributors
+ [Nick Worth](mailto:nick@positiveelement.com) - ([@Xtremefaith](http://twitter.com/Xtremefaith))