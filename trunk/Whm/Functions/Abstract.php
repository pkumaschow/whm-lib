<?php

/**
 * WHM Abstract Functions
 * 
 * Base class for WHM API Function Classes
 *
 * @abstract
 * @category whm-lib
 * @package whm-lib
 * @subpackage Functions
 * @author Peter Kumaschow  (pkumaschowATgmail.com)
 * @copyright Peter Kumaschow 2011 All Rights Reserved
 *
 * $Id: Abstract.php 201 2011-11-06 12:11:37Z peterk $
 */

abstract class Whm_Functions_Abstract
{
    
    protected $_querystring;
    protected $_method;
    protected $_params;
    protected $_apiresponse;
    protected $_rest;
    //protected $_apiversion = 0;
    

    /**
     *
     * constructor sets api return object to xml or json responses
     * @param string $username
     * @param string $hash
     * @param string $host
     * @param string $apiresponse (json or xml
     * @param string $rest name of rest class
     * @throws Exception
     */
    public function __construct( $config, $apiresponse = 'json', $rest = 'Whm_Rest_Api' )
    {
        if (!isset($config['host']) ||!isset($config['hash']) || !isset($config['username']))
        {
            throw new Exception('invalid configuration ');
        }
        if ($apiresponse == 'json' || $apiresponse == 'xml') {
            $this->setApi($apiresponse);
            //instantiate passed in rest class
            $this->_rest = new $rest($config, $this->_apiresponse);
            
        } else {
            throw new Exception('invalid api (' . $api . ') not xml or json');
        }
    }
    
    
    /**
     *
     * set rest method to call
     * @param string $method
     */
    public function setMethod( $method )
    {
        $this->_method = $method;
    }
    
    /**
     *
     * get currently set method
     */
    public function getMethod()
    {
        return $this->_method;
    }
    
    /**
     *
     * set api type (xml or json)
     * @param string $api
     */
    public function setApi( $api )
    {
        switch ($api)
        {
            case 'xml':
                $this->_apiresponse = 'xml';
                break;
            default:
                $this->_apiresponse = 'json';
        }
    }

    /**
     *
     * get current api type
     */
    public function getApi()
    {
        return $this->_apiresponse;
    }
    
    public function getQueryString()
    {
        //check that first char is '?'
        return $this->_querystring;
    }

    /**
     * Sets query string from supplied params
     *
     * @param array $params
     */
    public function setQueryString( $params )
    {
        $querystring = '?';
        $paramcount = 0;
        foreach ($params AS $key=>$value) {
            if (isset($params[$key])) {
                if ($paramcount > 0) {
                    $querystring .= '&';
                }
                $querystring .= urlencode($key).'='.urlencode($value);
                $paramcount++;
            }
        }
        $this->_querystring = $querystring ;
    }//buildQueryString
    
    /**
     *
     * set params to be passed to method
     * @param array $params
     */
    public function setParams( array $params )
    {
        $this->_params = $params;
    }
    
    /**
     *
     * get params
     * @return array
     */
    public function getParams()
    {
        return $this->_params;
    }
    
    /**
     *
     * post method call
     * @param string $method
     * @param array $params
     */
    public function post( $method )
    {
        $this->setMethod($method);
        $result = $this->_rest->query($method.$this->getQueryString());
        $result =  $this->decode($result);
        return $result;
    }//post
    
    /**
     *
     * intended to be used for calling api methods and bypassing
     * any local validation of the passed in params
     *
     * @param string $method
     * @param string $params
     */
    public function quickpost( $method, $params )
    {
        $this->setQueryString($params);
        return $this->post($method);
    }
    
    /**
     * return result object decoded appropriately depending on which api
     * is being used.
     *
     * @param mixed $results
     * @return object or false
     */
    public function decode( $results )
    {
        switch ($this->_apiresponse)
        {
            case 'json':
                $decodedResponse = json_decode($results);
                //TODO: Add an error check for json response
                break;
            case 'xml':
                $decodedResponse = new SimpleXMLElement($results);
                if (isset($decodedResponse->error)) {
                    throw new Exception($decodedResponse->error);
                }
                break;
        }
        return $decodedResponse;
    }//decode
    
    /**
     *
     * checks params agains known valid params and sets the querystring
     * to be used in the rest call to whm rest service
     *
     * @param array $requiredParams
     * @param array $validRequiredParams
     * @param array $optionalParams
     * @param array $validOptionalParams
     */
    public function checkParams(
        $requiredParams,
        $validRequiredParams,
        $optionalParams = null,
        $validOptionalParams = null )
    {
        $this->validateParams($requiredParams, $validRequiredParams, 1);
        if ($optionalParams) {
            $this->validateParams($optionalParams, $validOptionalParams);
            $params = array_merge($requiredParams, $optionalParams);
        } else {
            $params = $requiredParams ;
        }
        $this->setQueryString($params);
    }//checkParams
    
    
    /**
     * compares two associative arrays and used to validate parameters passed
     * into a method against an array of acceptable parameter names
     *
     * returns an array of the outcome, first index indicates validation
     * success or failure
     *
     * true = SUCCESS
     * false = FAILURE
     *
     * If validation fails then the second index will contain an error message
     *
     * @param array $inputParams
     * @param array $allowedParams
     */
    public function validateParams( $inputParams, $validParams, $required = 0 )
    {
        if ($required &&
            (
                count($inputParams) === 0 ||
                count($inputParams) != count($validParams))
            ) {
            throw new Exception('Required parameters are missing');
        }
        //check the names of parameters are valid
        $invalidParams = array_diff_key($inputParams, $validParams);
        if (count($invalidParams)>0) {
            throw new Exception('One or more parameters are invalid');
        }
        //TODO: check parameter types are valid
    }//validateParams
    
    
    /**
     *
     * get version of WHM
     * @return string
     */
    public function version()
    {
        $response = $this->post('version');
        return $response->version;
    }
    
    /**
     *
     * List Available XML/JSON API calls — applist
     *
     * This function lists all available XML/JSON API functions.
     *
     */
    public function applist()
    {
        return $this->post('applist');
    }
}


