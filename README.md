# bill-php-sdk
A simple helper to use bill.pt API

Documentation:
https://api.bill.pt

## Namespace:
```
use EpicBit\BillPhpSdk\Api;
```

## Instance:
```
$api = new Api();
```
Optional parameter (string)
Define what server the API will try to connect. By default  API will try to connect to portuguese server.
But if you have a international account you would like to do:
```
Example : $api = new Api('world');
```
Valid: standard,portugal,world,dev

## Turn On LOG: 
Turn on LOG. Type can be:
file or memory
```
$api->setlog(true, $type);
```
To return LOG from memory:
```
$api->getLogFromMemory();
```

## How to login and get token:
```
$user = $api->getToken([
	'email' => "johndoe@example.com",
	'password' => 'XXXXX'
	]);

$api->setToken($user->api_token);
```

## If you already have the token you can just setToken:
```
$api->setToken($user->api_token);
```

## Currency
Get list of all valid currencies
```
$api->getCurrencyList();
```

## Country
Get list of all valid countries
```
$api->getCountriesList();
```

## Validate
Verify if is a valid currency code Example: EUR_€ is valid.
Just dump the list to get all valid options.
```
$api->isValidCurrency($currency); 
```
Validate user token (will return a boolean)
```
$api->validToken();
```
Validate Date time (or any format)
```
$api->isValidDateTime($date_time, $format); (by default if you dont pass $format will be : Y-m-d H:i:s")
```
Validate Portuguese Zip Code
```
$api->isValidZipCode($zip);
```

## Success 
This method will return a boolean. 
You can check if your last request was valid or not.
```
$api->success();
```



## DocumentType Requests:
```
$api->getDocumentAllTypes();
$api->getDocumentTypesOf($category);
```

## PaymentMethods Requests:
```
$api->getPaymentMethods();
```

## DeliveryMethods Requests:
```
$api->getDeliveryMethods();
$api->createDeliveryMethod($params);
$api->updateDeliveryMethod($id, $params);
$api->deleteDeliveryMethod($id);
```

## MeasurementUnits Requests:
```
$api->getMeasurementUnits();
$api->createMeasurementUnit($params);
$api->updateMeasurementUnit($id, $params);
$api->deleteMeasurementUnit($id);
```

## Vehicles Requests:
```
$api->getVehicles();
$api->createVehicle($params);
$api->updateVehicle($id, $params);
$api->deleteVehicle($id);
```

## DocumentSets Requests:
```
$api->getDocumentSets();
$api->createDocumentSet($params);
$api->updateDocumentSet($id, $params);
$api->deleteDocumentSet($id);
```

## Taxs Requests:
```
$api->getTaxs();
$api->createTax($params);
$api->updateTax($id, $params);
$api->deleteTax($id);
```

## TaxExemptions Requests:
```
$api->getTaxExemptions();
```

## Warehouses Requests:
```
$api->getWarehouses();
$api->createWarehouse($params);
$api->updateWarehouse($id, $params);
$api->deleteWarehouse($id);
```

## Contacts(clients,suppliers etc) Requests:
```
$api->getContacts($params);
$api->getContactWithID($id, $params);
$api->createContact($params);
$api->updateContact($id, $params);
$api->deleteContact($id);
```

## Items Requests:
```
$api->getItems($params);
$api->getItemWithID($id, $params);
$api->createItem($params);
$api->updateItem($id, $params);
$api->deleteItem($id);
```

## Documents Requests:
```
$api->getDocuments($params);
$api->getDocumentWithID($id, $params);
$api->createDocument($params);
$api->deleteDocument($id);
$api->createDocumentOpeningBalance($params);
$api->communicateBillOfLanding($id);
$api->addTransportationCodeManually($params);
$api->emailDocument($params);
$api->addPrivateNoteToDocument($params);
$api->convertDocumentWithID($document_id, $convert_to, $data, $date_shipping, $date_delivery);
```

## Stock Requests:
```
$api->getStock($params);
$api->getStockSingleItem($params);
$api->getStockMovements($params);
```

## PendingMovements Requests:
```
$api->documentsWithPendingMovementsFromContact($params);
$api->pendingMovementsOfMultipleDocuments($params);
$api->pendingMovementsOfSingleDocument($id);
```

## Receipts Requests:
```
$api->createReceipt($params);
$api->createReceiptToDocumentWithID($id, $params);
```

## Tax Authority Requests:
```
$api->setTaxAuthorityLoginInformation($params);
$api->testTaxAuthorityLogin();
$api->taxAuthorityLoginState();
$api->taxAuthortiyCommunicationLog();
```

### If you are not sure what params you can use on each request please visit our api doc.
https://api.bill.pt
