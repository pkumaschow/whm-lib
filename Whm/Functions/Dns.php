<?php

require_once('Abstract.php');

/**
 * WHM DNS Functions
 *
 * Calls to DNS functions of the WHM XML and JSON APIs
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
 *
 * $Id: Dns.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_Dns extends Whm_Functions_Abstract
{
    
    /**
     *
     * This method will add a DNS zone record to the server.
     *
     * TODO: COMPLETE CALL
     *
     * Record Types: A, MX, CNAME, NS, PTR
     *
     * @param string $zone
     * @param string $type
     * @param array  $requiredParams
     * @param array  $optionalParams
     * @return object
     */
    public function addzonerecord(
        $zone,
        $type,
        $requiredParams,
        $optionalParams
        )
    {
        if (!in_array($type, array('A','MX','CNAME','NS','PTR'))) {
            throw new Exception('invalid zone record requested');
        }
        //common valid options for all record types
        $validOptionalParams = array(
            'class' => 'string',
            'ttl'	=> 'integer'
        );
        switch ( $type )
        {
            case 'A':
                //requires zone, address, type
                //optional class, ttl
                break;
            case 'MX':
                $name = $zone.".";
                //requires zone, name, exchange, preference, type
                //optional class, ttl
                break;
            case 'CNAME':
                //requires zone, cname, type
                //optional class, ttl
                if (!isset($requiredParams['cname'])) {
                    throw new Exception('cname required');
                }
                $requiredParams = array_merge(
                    array(
                        'zone' => $zone,
                        'type' => $type
                    ),
                    $requiredParams
                );
                $validRequiredParams = array(
                    'zone'  => 'string',
                    'cname' => 'string',
                    'type'  => 'string'
                );
                break;
            case 'NS':
                //required zone, nsdname, type
                //optional class, ttl
                break;
            case 'PTR':
                //required zone, name, ptdrname, type
                //optional ttl
                break;
        }
        
        
    }//addzonerecord

    /**
     *
     * This method displays the DNS zone configuration for a specific domain.
     *
     * http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/ListOneZone
     *
     * @param $domain string
     * @param $line string
     * @return object
     */
    public function dumpzone( $domain )
    {
        $requiredParams = array(
            'domain' => $domain,
        );
        $validRequiredParams = array(
            'domain' => 'string'
        );
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->post('dumpzone');
    }//dumpzone
    
    //TODO: implement editzonerecord
    public function editzonerecord()
    {
        
    }//editzonerecord
    
    /**
     *
     * This method will return zone records for a domain.
     *
     * To use This method most effectively, you may first wish to run the
     * dumpzone functionfor the domain(s) whose record(s) you wish to retrieve.
     * The Line output variable from that function call can then be used as a
     * reference to create the input for This method.
     *
     * @param string $domain
     * @param string $line
     * @return object
     */
    public function getzonerecord( $domain, $line )
    {
        $requiredParams = array(
            'domain' => $domain,
            'line'   => $line,
        );
        $validRequiredParams = array(
            'domain' => 'string',
            'line'   => 'string'
        );
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->post('getzonerecord');
    }//getzonerecord
    
    //TODO: implement killdns
    public function killdns()
    {
        
    }
       
    /**
     *
     *
     * This method will generate a list of all domains and corresponding DNS
     * zones associated with your server.
     *
     *
     * @return object
     */
    public function listzones()
    {
        return $this->post('listzones');
    }//listzones
    
    public function lookupnsip( $nameserver )
    {
        $this->setQueryString(array('nameserver'=>$nameserver));
        return $this->post('lookupnsip');
    }
    
    public function removezonerecord()
    {
        
    }
    
    public function resetzone()
    {
        
    }
    
    
    public function resolvedomainname()
    {
        //This method is only available in version 11.27/11.28+.
    }
    public function listmxs()
    {
        //This method is only available in version 11.27/11.28+. /
    }
    public function savemxs()
    {
        //This method is only available in version 11.27/11.28+.
    }
}