<?php 
/**
 * Hooks Class
 * This class demonstrates how to pass data to a callback function
 * without using global varaibles.
 *
 * @link http://alexmansfield.com/wordpress/passing-arguments-to-callback-functions
 * @link https://gist.github.com/kucrut/5110603
 * 
 */
class Hooks {
 
    public function __construct( $strings ) {
        $this->strings = $strings;
        foreach( $this->strings as $string ) {
            add_action( $string[ 'hook' ], array( $this, 'echo_strings' ), $string[ 'priority' ] );
        }
    } // End function __construct()
 
    public function echo_strings() {
        $hook = current_filter();
        foreach ( $this->strings as $string ) {
            if ( $string['hook'] == $hook ) {
                echo $string['message'];
            }
        }
    }
 
} // End class Example_Class
?>