<?php
/**
 * WHM SSL Functions
 *
 * Calls to SSL functions of the WHM XML and JSON APIs
 *
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 * 
 * @package whm-lib
 * @subpackage Functions
 * @author Peter Kumaschow
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
 * $Id: SSL.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_SSL extends Whm_Functions_Abstract
{

    /**
     * Returns the SSL certificate, private key, and CA bundle/intermediate
     * certificate associated with a specified domain.
     *
     * Alternatively, it can display the private key and CA bundle associated
     * with a specified SSL certificate.
     *
     * @param string $domain
     * @param string $crtdata
     * @return object
     */
    public function fetchsslinfo( $domain , $crtdata = NULL)
    {
            $this->setQueryString(array('domain'=>$domain,'crtdata'=>$crtdata));
            return $this->post('fetchsslinfo');
    }//fetchsslinfo
    
    /**
     * Generates an SSL certificate.
     *
     * Valid parameters
     *
     * xemail (string) — Email address of the domain owner.
     * host (string) — Domain the SSL certificate will be associated with.
     * country (string) — Country in which your organization is located.
     * state (string) — State in which your organization is located.
     * city (string) — City in which your organization is located.
     * co (string) — Organization name.
     * cod (string) — Department name associated with the SSL certificate.
     * email (string) — Email address to which the certificate will be sent.
     * pass (string) — Password associated with the SSL certificate.
     *
     *
     * @param array $params
     * @return mixed
     */
    public function generatessl( $params )
    {
        $this->setQueryString($params);
        return $this->post('generatessl');
    }
    
}//whmSSLModel