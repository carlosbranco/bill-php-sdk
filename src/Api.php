<?php
use EpicBit\BillPhpSdk;

class Api {
	private $mode = "standard";
	private $log = false;
	private $api_token = "";
	private $version = '1.0';
	private $prefix;

	function __construct($mode = "standard", $version = '1.0') 
	{
		$this->mode = $mode;
		$this->version = $version;
		$this->prefix = 'api/' . $version . '/';
	}

	public function getModeUrl($url)
	{
		$domain = "https://app.bill.pt/";
		if( $this->mode != "standard" ){
			$domain = "https://demo.bill.pt/";
		}
		return $domain . $this->prefix . $url;
	}

	public function request($method, $url, $params = [])
	{
		$url  = $this->getModeUrl($url);
		$params = array_merge($params, ['api_token' => $this->api_token, 'method' => $method]);
		$content = json_encode($params);
		$curl    = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_HTTPHEADER,
		    array(
		        "Content-type: application/json",
		        "Content-Length: " . strlen($content),
		    )
		);

		return curl_exec($curl);
	}

	public function setToken($api_token){
		$this->api_token = $api_token;
	}

	public function getToken($params)
	{
		return $this->request('POST', 'auth/login', $params);
	}

	
	public function getDocumentAllTypes()
	{
		return $this->request('GET', 'tipos-documento');
	}

	public function getDocumentTypesOf($category)
	{
		return $this->request('GET', 'tipos-documento/' .  $category);
	}

	

	public function getPaymentMethods()
	{
		return $this->request('GET', 'metodos-pagamento');
	}

	

	public function getDeliveryMethods()
	{
		return $this->request('GET', 'metodos-expedicao');
	}

	public function createDeliveryMethod($params)
	{
		return $this->request('POST', 'metodos-expedicao', $params);
	}

	public function createDeliveryMethod($params)
	{
		return $this->request('POST', 'metodos-expedicao', $params);
	}

	public function updateDeliveryMethod($id,$params)
	{
		return $this->request('PATCH', 'metodos-expedicao/' . $id, $params);
	}

	public function deleteDeliveryMethod($id)
	{
		return $this->request('DELETE', 'metodos-expedicao/' . $id);
	}

	

	public function getMeasurementUnits()
	{
		return $this->request('GET', 'unidades-medida');
	}

	public function createMeasurementUnit($params)
	{
		return $this->request('POST', 'unidades-medida', $params);
	}

	public function updateMeasurementUnit($id, $params)
	{
		return $this->request('PATCH', 'unidades-medida/' . $id, $params);
	}

	public function deleteMeasurementUnit($id)
	{
		return $this->request('DELETE', 'unidades-medida/' . $id);
	}

	

	public function getVehicles()
	{
		return $this->request('GET', 'viaturas');
	}

	public function createVehicle($params)
	{
		return $this->request('POST', 'viaturas', $params);
	}

	public function updateVehicle($id, $params)
	{
		return $this->request('PATCH', 'viaturas/' . $id, $params);
	}

	public function deleteVehicle($id)
	{
		return $this->request('DELETE', 'viaturas/' . $id);
	}



	public function getDocumentSets()
	{
		return $this->request('GET', 'series');
	}

	public function createDocumentSet($params)
	{
		return $this->request('POST', 'series', $params);
	}

	public function updateDocumentSet($id, $params)
	{
		return $this->request('PATCH', 'series/' . $id, $params);
	}

	public function deleteDocumentSet($id)
	{
		return $this->request('DELETE', 'series/' . $id);
	}


	public function getTaxs()
	{
		return $this->request('GET', 'impostos');
	}

	public function createTax($params)
	{
		return $this->request('POST', 'impostos', $params);
	}

	public function updateTax($id, $params)
	{
		return $this->request('PATCH', 'impostos/' . $id, $params);
	}

	public function deleteTax($id)
	{
		return $this->request('DELETE', 'impostos/' . $id);
	}



	public function getTaxExemptions()
	{
		return $this->request('GET', 'motivos-isencao');
	}


	public function getWarehouses()
	{
		return $this->request('GET', 'lojas');
	}

	public function createWarehouse($params)
	{
		return $this->request('POST', 'lojas', $params);
	}

	public function updateWarehouse($id, $params)
	{
		return $this->request('PATCH', 'lojas/' . $id, $params);
	}

	public function deleteWarehouse($id)
	{
		return $this->request('DELETE', 'lojas/' . $id);
	}


	public function getContacts()
	{
		return $this->request('GET', 'contatos');
	}

	public function getContactWithID($id, $params = [])
	{
		return $this->request('GET', 'contatos/' . $id, $params);
	}

	public function createContact($params)
	{
		return $this->request('POST', 'contatos', $params);
	}

	public function updateContact($id, $params)
	{
		return $this->request('PATCH', 'contatos/' . $id, $params);
	}

	public function deleteContact($id)
	{
		return $this->request('DELETE', 'contatos/' . $id);
	}


	public function getItems()
	{
		return $this->request('GET', 'items');
	}

	public function getItemWithID($id, $params = [])
	{
		return $this->request('GET', 'items/' . $id, $params);
	}

	public function createItem($params)
	{
		return $this->request('POST', 'items', $params);
	}

	public function updateItem($id, $params)
	{
		return $this->request('PATCH', 'items/' . $id, $params);
	}

	public function deleteItem($id)
	{
		return $this->request('DELETE', 'items/' . $id);
	}


	public function getDocuments($params)
	{
		return $this->request('GET', 'documentos', $params);
	}

	public function getDocumentWithID($id, $params = [])
	{
		return $this->request('GET', 'documentos/' . $id, $params);
	}

	public function createDocument($params)
	{
		return $this->request('POST', 'documentos', $params);
	}

	public function deleteDocument($id)
	{
		return $this->request('DELETE', 'documentos/' . $id);
	}

	public function createDocumentOpeningBalance($params)
	{
		return $this->request('POST', 'documentos/saldo-inicial', $params);
	}

	public function communicateBillOfLanding($id)
	{
		return $this->request('POST', 'documentos/comunicar/guia/' . $id);
	}

	public function addTransportationCodeManually($params)
	{
		return $this->request('POST', 'documentos/adicionar/codigo-at', $params);
	}

	public function emailDocument($params)
	{
		return $this->request('POST', 'documentos/enviar-por-email', $params);
	}

	public function addPrivateNoteToDocument($params)
	{
		return $this->request('POST', 'documentos/nota-documento', $params);
	}




	public function getStock($params)
	{
		return $this->request('GET', 'stock', $params);
	}

	public function getStockSingleItem($params)
	{
		return $this->request('GET', 'stock/singular', $params);
	}

	public function getStockMovements($params)
	{
		return $this->request('GET', 'stock/movimentos', $params);
	}



	public function documentsWithPendingMovementsFromContact($params)
	{
		return $this->request('GET', 'movimentos-pendentes', $params);
	}

	public function pendingMovementsOfMultipleDocuments($params)
	{
		return $this->request('GET', 'movimentos-pendentes/multiplos', $params);
	}

	public function pendingMovementsOfSingleDocument($id)
	{
		return $this->request('GET', 'movimentos-pendentes/' . $id);
	}


}
