<?php
/**
 *
 * WHM Account Abstract Object
 *
 * Used in the call to createacct and modifyacct in whmAccountModel
 * 
 * @abstract
 * @package whm-lib
 * @subpackage Account 
 * @author Peter Kumaschow  (pkumaschowATgmail.com)
 * @copyright Peter Kumaschow 2011
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
 * $Id: Abstract.php 203 2011-11-06 12:35:05Z peterk $
 *
 */
abstract class Whm_Account_Abstract
{
    /**
     *
     * the username for the account
     * @var string
     */
    
    
    protected $_username;
    /**
     *
     * the domain name for the account
     * @var string
     */
    protected $_domain;
    /**
     *
     * an array of whmFeature objects
     * @var array
     */
    protected $_features;
    
    /**
     *
     * retrieve the account username
     */
    public function getUsername()
    {
        return $this->_username;
    }//getUsername
    
    /**
     *
     * set the account username
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }//setUsername
    
    /**
     *
     * retrieve the account domain name
     */
    public function getDomain()
    {
        return $this->_domain;
    }//getDomain
    
    /**
     *
     * set the account domain name
     * @param string $domain
     */
    public function setDomain($domain)
    {
        $this->_domain = $domain;
    }//setDomain
    
    /**
     *
     * returns modify flag
     * can only set this value when instantiating the account object
     */
    public function getModify()
    {
        return $this->_modify;
    }
    
    /**
     *
     * add a feature to the account to be created
     * @param whmFeature $feature
     */
    public function addFeature($feature)
    {    
        $this->_features[] = $feature;
    }//addFeature
    
    /**
     *
     * returns added features
     * @return array of feature objects
     */
    public function getFeatures()
    {
        return $this->_features;
    }
    

    
    /**
     *
     * remove a feature
     * @param string $featureName
     */
    public function removeFeature($featureName)
    {
        $amendedFeatureList = null;
        foreach ($this->_features as $feature) {
            if ($feature->featureName != $featureName) {
                $amendedFeatureList[] = $feature;
            }
            $this->_features = $amendedFeatureList;
        }
    }//removeFeature
    
}//whmAccount