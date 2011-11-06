<?php
/**
 *
 * WHM Account Create Object
 *
 * Required input for Whm_Functions_Account->createacct
 *
 * username and domain are the minimum requirements to create an account
 *
 * Features added must an instance of FeatureAccountAdd or an error will
 * be thrown
 *
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
 * $Id: Create.php 203 2011-11-06 12:35:05Z peterk $
 */
class Whm_Account_Create extends Whm_Account_Abstract
{
    
    /**
     *
     * account object constructor
     *
     * @param string $username
     * @param string $domain
     * @param array $features an array of whmFeature objects or single feature
     */
    public function __construct($username, $domain, $features = null)
    {
        $this->_username = $username;
        $this->_domain = $domain;
        $this->_features = array();
        //check the names of parameters are valid
        if ($features != null) {
            if (is_array($features)) {
                foreach ($features as $feature) {
                   $this->addFeature($feature);
                }
            } else {
                $this->addFeature($features);
            }
        }
        
    }//__construct
    
    public function addFeature($feature)
    {

         if (is_a($feature, 'Whm_Feature_Account_Add')) {
              $this->_features[] = $feature;
         } else {
                throw new Exception('invalid feature requested');
         }              
    }//addFeature
            
    public function getAccountParams()
    {
        $features = array();
        $features['username'] = $this->_username;
        $features['domain'] = $this->_domain;
        foreach ($this->_features as $feature) {
            $features[$feature->featureName] = $feature->featureValue;
        }
        return $features;
    }    
}//whmAccount