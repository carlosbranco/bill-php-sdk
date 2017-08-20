# bill-php-sdk
A simple helper to use bill.pt API

Documentation:
https://api.bill.pt

##Namespace:
```
use EpicBit\BillPhpSdk\Api;
```

##Instance:
```
$api = new Api();
```

##Turn On LOG: 
```
$api->setlog(true);
```

##How to login and get token:
```
$user = json_decode($api->getToken([
	'email' => "johndoe@example.com",
	'password' => 'XXXXX'
	])
);

$api->setToken($user->api_token);
```

##If you already have the token you can just setToken:
```
$api->setToken($user->api_token);
```

##DocumentType Requests:
```
$api->getDocumentAllTypes();
$api->getDocumentTypesOf($category);
```

##PaymentMethods Requests:
```
$api->getPaymentMethods();
```

##DeliveryMethods Requests:
```
$api->getDeliveryMethods();
$api->createDeliveryMethod($params);
$api->updateDeliveryMethod($id, $params);
$api->deleteDeliveryMethod($id);
```

##MeasurementUnits Requests:
```
$api->getMeasurementUnits();
$api->createMeasurementUnit($params);
$api->updateMeasurementUnit($id, $params);
$api->deleteMeasurementUnit($id);
```

##Vehicles Requests:
```
$api->getVehicles();
$api->createVehicle($params);
$api->updateVehicle($id, $params);
$api->deleteVehicle($id);
```

##DocumentSets Requests:
```
$api->getDocumentSets();
$api->createDocumentSet($params);
$api->updateDocumentSet($id, $params);
$api->deleteDocumentSet($id);
```

##Taxs Requests:
```
$api->getTaxs();
$api->createTax($params);
$api->updateTax($id, $params);
$api->deleteTax($id);
```

##TaxExemptions Requests:
```
$api->getTaxExemptions();
```

##Warehouses Requests:
```
$api->getWarehouses();
$api->createWarehouse($params);
$api->updateWarehouse($id, $params);
$api->deleteWarehouse($id);
```

##Contacts(clients,suppliers etc) Requests:
```
$api->getContacts();
$api->getContactWithID($id, $params);
$api->createContact($params);
$api->updateContact($id, $params);
$api->deleteContact($id);
```

##Items Requests:
```
$api->getItems();
$api->getItemWithID($id, $params);
$api->createItem($params);
$api->updateItem($id, $params);
$api->deleteItem($id);
```

##Documents Requests:
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
```

##Stock Requests:
```
$api->getStock($params);
$api->getStockSingleItem($params);
$api->getStockMovements($params);
```

##PendingMovements Requests:
```
$api->documentsWithPendingMovementsFromContact($params);
$api->pendingMovementsOfMultipleDocuments($params);
$api->pendingMovementsOfSingleDocument($id);
```

###If you are not sure what params you can use on each request please visit our api doc.
https://api.bill.pt
