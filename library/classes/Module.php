<?php
/**
 * Module Class
 * @todo This module is only a concept, it is NOT DEVELOPED. The idea is to replace the 
 *       need to init_{module-slug}_module() in the module _init.php
 * @author Nick Worth
 * @since 1.0
 */

class Module extends CPT
{

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
    public function __construct( $module ){
        
    }

    
     /**
     * Construct a new Custom Post Type
     *
     * @param string $name
     * @param array $args
     * @param array $labels
     *
     * @author Gijs Jorissen
     * @since 0.1
     * @link http://davidwalsh.name/dynamic-functions
     */
    static function __call($method,$arguments) {
        $meth = CUSTOM::camel_case(substr($method,3,strlen($method)-3));
        return array_key_exists($meth,$this->info) ? $this->info[$meth] : false;
    }
}

?>