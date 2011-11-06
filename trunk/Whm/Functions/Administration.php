<?php

/**
 * WHM API Administration Functions
 *
 * Calls to Administration functions of the WHM XML and JSON APIs
 *
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 *
 * @package whm-lib
 * @subpackage Functions
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
 * $Id: Administration.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_Administration extends Whm_Functions_Abstract
{

    /**
     * Add new IP address(es) to WebHost Manager.
     *
     * Note:
     * When adding multiple IP addresses, you must use Class C CIDR format.
     *
     * @param string $ip
     * @param string $netmask
     * @return object
     */
    public function addip($ip, $netmask)
    {
        $requiredParams = array(
            'ip'      => $ip,
            'netmask' => $netmask,
        );
        $validRequiredParams = array(
            'ip'      => 'string',
            'netmask' => 'string'
        );
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->post('addip');
    }//addip
    
    /**
     * 
     * Delete IP address.
     * @param string $ip
     * @param string $ethernetdev
     * @param int $skipifshutdown
     * @return object
     */
    public function delip($ip, $ethernetdev = null, $skipifshutdown = 0)
    {
        $params['ip'] = $ip;
        $params['skipifshutdown'] = $skipifshutdown;
        if ($ethernetdev != null) {
            $params['ethernetdev'] = $ethernetdev;
        }
        $this->setQueryString($params);
        return $this->post('delip');
    }//delip
    
    /**
     *
     * This function lists all IP addresses bound to network
     * interfaces on the server.
     * 
     * @return object
     */
    public function listips()
    {
        return $this->post('listips');
    }//listips
    
    /**
     *
     * cPanel and WHM store "non-volatile" data on your server.
     * You can use the nvget function to view the value of a
     * non-volatile variable.
     *
     * Use the nvset function to set the value.
     *
     * @param string $key
     * @return object
     */
    public function nvget($key)
    {
        $this->setQueryString(
            array(
                'key' => $key,
            )
        );
        return $this->post('nvget');
    }//nvget
    
    /**
     *
     * Set the value of "non-volatile" data on
     * your server.
     *
     * @param string $key
     * @param string $value
     * @return object
     */
    public function nvset($key, $value)
    {
        $this->setQueryString(
            array(
                'key'   => $key,
                'value' => $value,
            )
        );
        return $this->post('nvset');
    }//nvset
    
    /**
     *
     * This function can restart a server gracefully or forcefully.
     * @param boolean $force
     * @return object
     */
    public function reboot($force=0)
    {
        $this->setQueryString(array('force'=>$force));
        //return $this->post('reboot');
    }//reboot
    
    /**
     *
     * This function lets you change the server's hostname.
     *
     * Important:
     * The server's hostname should absolutely not be identical to your
     * domain name. For example, if your domain is example.com, you
     * could use a hostname such as server1.example.com, but not
     *  example.com itself.
     *
     * @param string $hostname
     * @return object
     */
    public function sethostname($hostname)
    {
        $this->setQueryString(array('hostname'=>$hostname));
        return $this->post('sethostname');
    }//sethostname
    
    public function setresolvers($nameserver1,$nameserver2,$nameserver3=null)
    {
        $params['nameserver1'] = $nameserver1;
        $params['nameserver2'] = $nameserver2;
        if ($nameserver3 != null) {
            $params['nameserver1'] = $nameserver1;
        }
        $this->setQueryString($params);
        return $this->post('setresolvers');
    }//setresolvers

    /**
     *
     * This function will display bandwidth information by account.
     * @param array $optionalParams
     * @return object
     */
    public function showbw($optionalParams = null)
    {
        //what is this? ugly ugly ugly!
        $requiredParams = array('x'=>0); //no required params for this call
        $validRequiredParams = array('x'=>'integer');
        $validOptionalParams = array(
            'month'      => 'integer',
            'year'       => 'integer',
            'showres'    => 'string',
            'search'     => 'string',
            'searchtype' => 'string', //eg: domain, user, owner, package
        );
        $this->checkParams(
            $requiredParams,
            $validRequiredParams,
            $optionalParams,
            $validOptionalParams
        );
        return $this->post('showbw');
    }//showbw
    
}//whmAdministrationModel