<?php

require_once('Whm/Whm.php');

$config['username'] = 'yourwhmusername';
$config['hash'] = "yourhash";
$config['host'] = 'yourserver.com';

//Get an instance of the Account Functions API
$whmAccountFunctions = Whm::getInstance('Account', $config);
//Get A list of Accounts
$response = $whmAccountFunctions->listaccts();
//Echo a list of accounts 

foreach ($response->acct as $account)
{
    echo $account->domain."\n";
}
