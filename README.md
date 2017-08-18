# bill-php-sdk
A simple helper to use bill.pt API

Documentation:
https://api.bill.pt

How to use:
```
include  '../vendor/autoload.php';
use EpicBit\BillPhpSdk\Api;

$api = new Api();
#set log to true will create a html file called errorlog.html with all request information dont use in production since will have sensitive information
$api->setlog(true);

$user = json_decode($api->getToken(['email' => "johndoe@example.com", 'password' => 'XXXXX']));

$api->setToken($user->api_token);
```