<?php
/**
 * Rest Model
 * 
 * @package whm-lib
 * @subpackage Rest 
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
 *  along with whm-lib.  If not, see <http://www.gnu.org/licenses/>.* 
 *
 * $Id: Api.php 203 2011-11-06 12:35:05Z peterk $ 
 */

class Whm_Rest_Api
{
    /**
     * 
     * Raw responses?
     * @var boolean
     */
    private $_raw;
    /**
     * hostname
     * @var string
     */
    private $_host;
    /**
     * WHM Username
     * @var string
     */
    private $_username;
    /**
     * WHM Hash
     * @var string
     */
    private $_hash;
    /**
     * curl header
     * @var array
     */
    private $_header;
    /**
     * CPANEL API to use xml-api or json-api
     * @var string
     */
    private $_api ;
    
    /**
     *
     * log all requests
     * @var boolean
     */
    private $_logRequest;
    
    /**
     *
     * log all responses
     * @var boolean
     */
    private $_logResponse;

    /**
     * WHM Constructor
     * @param string $host
     * @param string $username
     * @param string $hash
     * @param array $options
     * @return void
     */
    public function __construct( $whm, $api = 'xml', $log = false, $raw = true )
    {
        $this->setRaw($raw);
        if ($api !== 'xml' && $api !== 'json') {
            throw new Exception('invalid api (' . $api . ') set', 100);
        }
        $this->_host = 'https://'.$whm['host'].':2087/';
        $this->_username = $whm['username'];
        $this->_hash = $whm['hash'];
        $this->_api = $api;
        $this->_logRequest = $log;
        $this->_logResponse = $log;
        $this->_header[0] = "Authorization: WHM ".$whm['username'].":".
            preg_replace("'(\r|\n)'", "", $whm['hash']);
    }//whmRest

    /**
     * Query WHM via CPANEL API and return the results
     *
     * This is a native JSON/XML API Call
     *
     * @param string $query
     * @param array $params
     * @return string
     */
    public function query( $query , $params = null )
    {
        $session = curl_init($query);
        if ($this->_logRequest) {
            $this->logRequest($query);
        }
        //Include HTTP Response header
        curl_setopt($session, CURLOPT_HEADER, true);
        // Allow certs that do not match the domain
        curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
        // Allow self-signed certs
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
        // Return contents of transfer on curl_exec
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($session, CURLOPT_HTTPHEADER, $this->_header);
        curl_setopt(
            $session, CURLOPT_URL, $this->_host.$this->_api . '-api/'.$query
        );
        
        $response = curl_exec($session);
        curl_close($session);
        
        
        //Get HTTP Status code from the response
        $statusCode = array();
        preg_match('/\d\d\d/', $response, $statusCode);
        
        switch( $statusCode[0])
        {
            case 100: //CONTINUE
            case 200: //SUCCESS
            case 201: //CREATED
            case 202: //ACCEPTED
            case 864: //????
                break;
            case 503: //SERVICE UNAVAILABLE
                throw new Exception('WHM not available', 503);
                break;
            case 403: //FORBIDDEN
                throw new Exception('WHM forbidden access', 403);
                break;
            case 400: //BAD REQUEST
                throw new Exception('WHM Bad Request', 400);
                break;
            default:  //
                throw new Exception('WHM Unexpected Status of '.$statusCode[0]);
        }
        
        //Get the XML/JSON from the response, bypassing the header
        if ($this->_api == 'xml') {
            $response = strstr($response, '<');
            
        } else {
            $response = strstr($response, '{');
        }
        if ($this->_logResponse) {
            $this->logResponse($response);
        }
        return $response;
    }//query

    /**
     * set host name to query
     * @param string $host
     * @return void
     */
    public function setHost( $host )
    {
        $this->_host = $host;
    }//setHost
    
    /**
     * get host name being queried
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }//getHost
    
    public function setRaw($raw)
    {
        $this->_raw = $raw;
    }
    
    public function isRaw()
    {
        return $this->_raw;
    }
    
    //TODO: COMPLETE LOGGING FEATURES
    private function logRequest( $request )
    {
        $filename = '/tmp/whmrequest.log';
        file_put_contents($filename, $request."\n", FILE_APPEND | LOCK_EX);
    }//logRequest
    
    private function logResponse( $response )
    {
        $filename = '/tmp/whmresponse.log';
        file_put_contents($filename, $response."\n\n", FILE_APPEND | LOCK_EX);
    }//logResponse

}//Whm_Rest_Api