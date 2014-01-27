<?php

/**
 * General class with main methods and helper methods
 *
 * @author Gijs Jorissen
 * @since 0.2
 *
 */
class Custom
{
    var $dir = array();

    /**
     * Contructs the CUSTOM class
     * Adds actions
     *
     * @author Gijs Jorissen
     * @since 0.3
     *
     */
    function __construct()
    {
        // Add actions
        add_action( 'admin_init', array( $this, 'register_styles' ) );
        add_action( 'admin_print_styles', array( $this, 'enqueue_styles' ) );

        add_action( 'admin_init', array( $this, 'register_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        // Determine the full path to the this folder
        $this->_determine_custom_dir( dirname( __FILE__ ) );
    }


    /**
     * Registers styles
     *
     * @author Gijs Jorissen
     * @since 0.3
     *
     */
    function register_styles()
    {       
        if( CUSTOM_JQUERY_UI_STYLE != 'none' )
        {
            if( CUSTOM_JQUERY_UI_STYLE == 'custom' )
            {
                wp_register_style( 'custom_jquery_ui_css', 
                    $this->dir . '/assets/css/jquery_ui.css', 
                    false, 
                    CUSTOM_VERSION, 
                    'screen'
                );
            }
            else
            {
                wp_register_style( 'custom_jquery_ui_css', 
                    'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/' . CUSTOM_JQUERY_UI_STYLE . '/jquery-ui.css', 
                    false, 
                    CUSTOM_VERSION, 
                    'screen'
                );
            }
        }

        wp_register_style( 'custom_colorpicker_css', 
            $this->dir . '/assets/css/colorpicker.css', 
            false, 
            CUSTOM_VERSION, 
            'screen'
        );

        wp_register_style( 'custom_css', 
            $this->dir . '/assets/css/style.css', 
            false, 
            CUSTOM_VERSION, 
            'screen'
        );
    }


    /**
     * Enqueues styles
     *
     * @author Gijs Jorissen
     * @since 0.3
     *
     */
    function enqueue_styles()
    {
        wp_enqueue_style( 'custom_jquery_ui_css' );
        wp_enqueue_style( 'custom_colorpicker_css' );
        wp_enqueue_style( 'custom_css' );
    }


    /**
     * Registers scripts
     *
     * @author Gijs Jorissen
     * @since 0.3
     *
     */
    function register_scripts()
    {
        wp_register_script( 'custom_colorpicker_js', 
            $this->dir . '/assets/js/jquery.colorpicker.js',
            array( 'jquery' ), 
            CUSTOM_VERSION, 
            true 
        );

        wp_register_script( 'custom_js', 
            $this->dir . '/assets/js/functions.js',
            array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'jquery-ui-tabs', 'jquery-ui-accordion', 'custom_colorpicker_js' ), 
            CUSTOM_VERSION, 
            true 
        );
    }


    /**
     * Enqueues scripts
     *
     * @author Gijs Jorissen
     * @since 0.3
     *
     */
    function enqueue_scripts()
    {
        wp_enqueue_script( 'custom_colorpicker_js' );
        wp_enqueue_script( 'custom_js' );
    }


    /**
     * Beautifies a string. Capitalize words and remove underscores
     *
     * @param string $string
     * @return string
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    static function beautify( $string )
    {
        return ucwords( str_replace( '_', ' ', $string ) );
    }


    /**
     * Uglifies a string. Remove underscores and lower strings
     *
     * @param string $string
     * @return string
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    static function uglify( $string )
    {
        return strtolower( preg_replace( '/[^A-z0-9]/', '_', $string ) );
    }

    /**
     * Slugifies a string. Adding underscores and lower strings
     *
     * @param string $string
     * @return string
     *
     * @author Nick Worth
     * @since 1.0
     *
     */
    static public function slugify($text)
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
      $text = trim($text, '-');

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }


    /**
     * Makes a word plural
     *
     * @param string $string
     * @return string
     *
     * @author Gijs Jorissen
     * @since 0.1
     *
     */
    static function pluralize( $string )
    {
        $last = $string[strlen( $string ) - 1];

        if( $last != 's' )
        {
            if( $last == 'y' )
            {
                $cut = substr( $string, 0, -1 );
                //convert y to ies
                $plural = $cut . 'ies';
            }
            else
            {
                // just attach a s
                $plural = $string . 's';
            }

            return $plural;
        }

        return $string;
    }

    /**
    * Singularizes English nouns.
    *
    * @access public
    * @static
    * @param  string    $word    English noun to singularize
    * @return string Singular noun.
    */
    static function singularize($word)
    {
        $singular = array (
        '/(quiz)zes$/i' => '\1',
        '/(matr)ices$/i' => '\1ix',
        '/(vert|ind)ices$/i' => '\1ex',
        '/^(ox)en/i' => '\1',
        '/(alias|status)es$/i' => '\1',
        '/([octop|vir])i$/i' => '\1us',
        '/(cris|ax|test)es$/i' => '\1is',
        '/(shoe)s$/i' => '\1',
        '/(o)es$/i' => '\1',
        '/(bus)es$/i' => '\1',
        '/([m|l])ice$/i' => '\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\1',
        '/(m)ovies$/i' => '\1ovie',
        '/(s)eries$/i' => '\1eries',
        '/([^aeiouy]|qu)ies$/i' => '\1y',
        '/([lr])ves$/i' => '\1f',
        '/(tive)s$/i' => '\1',
        '/(hive)s$/i' => '\1',
        '/([^f])ves$/i' => '\1fe',
        '/(^analy)ses$/i' => '\1sis',
        '/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
        '/([ti])a$/i' => '\1um',
        '/(n)ews$/i' => '\1ews',
        '/s$/i' => '',
        );

        $uncountable = array('equipment', 'information', 'rice', 'money', 'species', 'series', 'fish', 'sheep', "press");

        $irregular = array(
        'person' => 'people',
        'man' => 'men',
        'child' => 'children',
        'sex' => 'sexes',
        'move' => 'moves');

        $lowercased_word = strtolower($word);
        foreach ($uncountable as $_uncountable){
            if(substr($lowercased_word,(-1*strlen($_uncountable))) == $_uncountable){
                return $word;
            }
        }

        foreach ($irregular as $_plural=> $_singular){
            if (preg_match('/('.$_singular.')$/i', $word, $arr)) {
                return preg_replace('/('.$_singular.')$/i', substr($arr[0],0,1).substr($_plural,1), $word);
            }
        }

        foreach ($singular as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }

    /**
    * Singularizes the slug.
    *
    * @access public
    * @static
    * @param  string    $word    English noun to singularize
    * @return string Singular noun.
    */
    static function singularize_slug($word)
    {
        return self::singularize(self::slugify($word));
    }

    /**
    * CamelCase String.
    *
    * @access public
    * @param <STRING> $string
    * @return <STRING> $camelCaseString.
    * @link uncamelcaser: via http://www.paulferrett.com/2009/php-camel-case-functions/
    */
    static function camel_case($str) {
        $str[0] = strtolower($str[0]);
        $func = create_function('$c', 'return "_" . strtolower($c[1]);');
        return preg_replace_callback('/([A-Z])/', $func, $str);
    }

    /**
     * Recursive method to determine the path to the custom folder
     *
     * @param string $path
     * @return string
     *
     * @author Gijs Jorissen
     * @since 0.4.1
     *
     */
    function _determine_custom_dir( $path = __FILE__ )
    {
        $path = dirname( $path );
        $path = str_replace( '\\', '/', $path );
        $explode_path = explode( '/', $path );

        $current_dir = $explode_path[count( $explode_path ) - 1];
        array_push( $this->dir, $current_dir );

        if( $current_dir == 'wp-content' )
        {
            // Build new paths
            $path = '';
            $directories = array_reverse( $this->dir );

            foreach( $directories as $dir )
            {
                $path = $path . '/' . $dir;
            }

            $this->dir = $path;
        }
        else
        {
            return $this->_determine_custom_dir( $path );
        }
    }       
}

?>
