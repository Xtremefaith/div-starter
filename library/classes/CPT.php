<?php
/* Custom Post Type Class
 * 
 * @author: Nick Worth (adapted from wp.tutsplus.com: http://wp.tutsplus.com/tutorials/creative-coding/custom-post-type-helper-class/)
 * @description: A Quick and accessible class for making CPTs withing the CUSTOMMP module
 * DEPENDENCY: Customs.php
 */

class CPT
{
    var $post_type_name;
    var $post_type_args;
    var $post_type_labels;


    /**
     * Construct a new Custom Post Type
     *
     * @param string $name
     * @param array $args
     * @param array $labels
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    public function __construct( $name, $args = array(), $labels = array() ){
        if( ! empty( $name ) )
        {
            // Set some important variables
            $this->post_type_name       = CUSTOM::uglify( $name );
            $this->post_type_args       = $args;
            $this->post_type_labels     = $labels;

            // Add action to register the post type, if the post type doesnt exist
            if( ! post_type_exists( $this->post_type_name ) )
            {
                add_action( 'init', array( &$this, 'register_post_type' ), 1 );
            }

            /* Flush rewrite rules for custom post types. */
            add_action( 'after_switch_theme', array( &$this, 'cpt_flush_rewrite_rules') );

        }
    }

    /**
     * Flush your rewrite rules
     *
     * @author Nick Worth
     * @since 1.0
     *
     */
    function cpt_flush_rewrite_rules() {
         flush_rewrite_rules();
    }

    /**
     * Register the Post Type
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    function register_post_type()
    {       
        // Capitilize the words and make it plural
        $name       = CUSTOM::beautify( $this->post_type_name );
        $plural     = CUSTOM::pluralize( $name );

        // We set the default labels based on the post type name and plural. 
        // We overwrite them with the given labels.
        $labels = array_merge(

            // Default
            array(
                'name'                  => _x( $plural, 'post type general name', 'CUSTOM_TEXTDOMAIN' ),
                'singular_name'         => _x( $name, 'post type singular name', 'CUSTOM_TEXTDOMAIN' ),
                'add_new'               => _x( 'Add New', strtolower( $name ), 'CUSTOM_TEXTDOMAIN' ),
                'add_new_item'          => __( 'Add New ' . $name, 'CUSTOM_TEXTDOMAIN' ),
                'edit_item'             => __( 'Edit ' . $name, 'CUSTOM_TEXTDOMAIN' ),
                'new_item'              => __( 'New ' . $name, 'CUSTOM_TEXTDOMAIN' ),
                'all_items'             => __( 'All ' . $plural, 'CUSTOM_TEXTDOMAIN' ),
                'view_item'             => __( 'View ' . $name, 'CUSTOM_TEXTDOMAIN' ),
                'search_items'          => __( 'Search ' . $plural, 'CUSTOM_TEXTDOMAIN' ),
                'not_found'             => __( 'No ' . strtolower( $plural ) . ' found', 'CUSTOM_TEXTDOMAIN' ),
                'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash', 'CUSTOM_TEXTDOMAIN' ), 
                'parent_item_colon'     => '',
                'menu_name'             => $plural
            ),

            // Given labels
            $this->post_type_labels

        );

        // Same principle as the labels. We set some default and overwite them with the given arguments.
        $args = array_merge(

            // Default
            array(
                'label'                 => $plural,
                'labels'                => $labels,
                'public'                => true,
                'supports'              => array( 'title', 'editor' ),
            ),

            // Given args
            $this->post_type_args

        );

        // Register the post type
        register_post_type( $this->post_type_name, $args );
    }


    /**
     * Add a taxonomy to the Post Type
     *
     * @param string $name
     * @param array $args
     * @param array $labels
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    function add_taxonomy( $name, $args = array(), $labels = array() )
    {
        // Call CUSTOM_Taxonomy with this post type name as second parameter
        $taxonomy = new CUSTOM_Taxonomy( $name, $this->post_type_name, $args, $labels );

        // For method chaining
        return $this;
    }


    /**
     * Add post meta box to the Post Type
     *
     * @param string $title
     * @param array $fields
     * @param string $context
     * @param string $priority
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    function add_meta_box( $title, $fields = array(), $context = 'normal', $priority = 'default' )
    {
        $meta_box = new CUSTOM_Meta_Box( $title, $this->post_type_name, $fields, $context, $priority );

        // For method chaining
        return $this;
    }   
}

?>