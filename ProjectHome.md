A PHP Class Library that simplifies access to the WHM XML / JSON API.

It is currently usable although not all of the API calls have been implemented. But many have.

Usage Example:

```
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
```