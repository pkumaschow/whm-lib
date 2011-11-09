<?php

/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */

require_once ('PHPUnit/Framework/TestCase.php');

class Whm_Test_Abstract extends PHPUnit_Framework_TestCase
{
    protected $config;
    protected $domain;
    protected $testUserName;
    protected $testDomainName;
    protected $online = false;
    
    protected function setUp()
    {
        parent::setUp();
        $this->config['username'] = 'your_whm_username';
        $this->config['hash'] = "your_whm_hash";
        $this->config['host'] = 'your_whm_hostname';
        $this->config['domain'] = 'your_domain_name';
        $this->config['testip'] = '192.168.1.89';
        $this->config['netmask'] = '255.255.255.0';
        $this->testUserName = 'unittest';
        $this->testDomainName = 'unittest.com';
    }
    
    protected function log($mixed)
    {
    	$handle = fopen('log.txt','w');
    	$logentry = date('c');
    	$logentry .= "\n===============================\n";
    	$logentry .= var_export($mixed,true);
		$logentry .= "\n===============================\n";
    	fwrite($handle, $logentry);
    }
/**
 * autoloader
 */    
    public static function autoload($class) 
    {  
        if ( strpos($class, 'Whm') !== 0 ) {
            return;
        }
        if ($class == 'Whm') {
            $file = dirname(__FILE__) . '/../Whm.php';
        } else {
            $file = dirname(__FILE__) . '/../' . str_replace('_', DIRECTORY_SEPARATOR, substr($class,4)) . '.php';
        }
        
        if ( file_exists($file) ) {
            require $file;
        } 
    }
}

spl_autoload_register('\Whm_Test_Abstract::autoload'); // As of PHP 5.3.0


