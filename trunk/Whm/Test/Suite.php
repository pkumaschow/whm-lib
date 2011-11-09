<?php

/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'AbstractFunctionsTest.php';
require_once 'AccountFunctionsTest.php';
//require_once 'whmAdministrationFunctionsTest.php';
require_once 'AccountTest.php';
//require_once 'whmDNSFunctionsTest.php';
//require_once 'whmPackageFunctionsTest.php';
//require_once 'whmRestTest.php';
//require_once 'whmFeatureTest.php';
//require_once 'whmServerFunctionsTest.php';
//require_once 'whmServiceFunctionsTest.php';

/**
 * Static test suite.
 */
class Whm_Test_Suite extends PHPUnit_Framework_TestSuite
{
    /**
     * Constructs the test suite handler.
     */
    public function __construct ()
    {
        $this->setName('whm');
        $this->addTestSuite('AbstractFunctionsTest');
        $this->addTestSuite('AccountFunctionsTest');
//        $this->addTestSuite('whmAccountModelTest');
//        $this->addTestSuite('whmAdministrationModelTest');
//        $this->addTestSuite('whmDNSModelTest');
//        $this->addTestSuite('whmFeatureTest');
//        $this->addTestSuite('whmPackageModelTest');
//        $this->addTestSuite('whmRestTest');
//        $this->addTestSuite('whmServerModelTest');
//        $this->addTestSuite('whmServiceModelTest');
    }
    /**
     * Creates the suite.
     */
    public static function suite ()
    {
        return new self();
    }
        
}//class
