<?php
/**
 * 
 * WHM
 * 
 * API Functions are split into different functional areas
 * as defined in the WHM API documentation
 *  
 * @package whm-lib 
 * @author Peter Kumaschow
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 * @example ../usage_example.php
 * @license GNU GPL v3
 * 
 * This file is part of whm-lib.
 * 
 * whm-lib is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 *  whm-lib is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with whm-lib.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */    

class Whm
// ensure that only a single instance exists for each class.
{
    /**
     * array of instance names
     */
    private static $_instances = array(); 
    /**
     * lock down constructor
     */
    private function __construct() {}
    /**
     * prevent cloning
     */
    private function __clone() {}
    /**
     * 
     * get instance of specified class
     * @param string $class
     * @param array $config
     * @param string $responseformat
     */
    public static function getInstance ($class, $config, $responseformat = 'json')
    {
        $realclass = "Whm_Functions_" . $class;
        if (array_key_exists($realclass, self::$_instances)) {
            // instance exists in array, so use it
            $instance = self::$_instances[$realclass];
            
        } else {
            // instance does not exist, so create it
            self::$_instances[$realclass] = new $realclass($config, $responseformat);
            $instance = self::$_instances[$realclass];
        } // if
        return $instance;
    } // getInstance
    
} // Whm

/**
 * autoloader
 */
function __autoload($class) 
{  
        if ( strpos($class, 'Whm') !== 0 ) {
            return;
        }
        $file = dirname(__FILE__) . '/' . str_replace('_', DIRECTORY_SEPARATOR, substr($class,4)) . '.php';
        //echo 'called autoload for ' . $file ."\n";
        if ( file_exists($file) ) {
            require $file;
        } 
}