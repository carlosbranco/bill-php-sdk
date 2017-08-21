<?php
namespace EpicBit\BillPhpSdk;

class Api {
	private $mode = "standard";
	private $log = false;
	protected $log_file = 'errorlog.html';
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
			$domain = "https://dev.bill.pt/";
		}
		return $domain . $this->prefix . $url;
	}

	public function request($method, $url, $params = [])
	{		
		$url  = $this->getModeUrl($url);
		$params = array_merge($params, ['api_token' => $this->api_token,'method' => $method]);
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

	    $response = curl_exec($curl);

	    if($this->log){
	    	$this->prettyLog($method, $url, $params, $response);
	    }

	    return $this->isJson($response) ? json_decode($response) : $response;
	}

	public function setLog($log)
	{
		$this->log = $log;
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




	public function getStock($params = [])
	{
		return $this->request('GET', 'stock', $params);
	}

	public function getStockSingleItem($params = [])
	{
		return $this->request('GET', 'stock/singular', $params);
	}

	public function getStockMovements($params = [])
	{
		return $this->request('GET', 'stock/movimentos', $params);
	}



	public function documentsWithPendingMovementsFromContact($params = [])
	{
		return $this->request('GET', 'movimentos-pendentes', $params);
	}

	public function pendingMovementsOfMultipleDocuments($params = []) 
	{
		return $this->request('GET', 'movimentos-pendentes/multiplos', $params);
	}

	public function pendingMovementsOfSingleDocument($id)
	{
		return $this->request('GET', 'movimentos-pendentes/' . $id);
	}

	public function prettyLog($method, $url, $params, $result)
	{
		if(!file_exists($this->log_file)){

			file_put_contents($this->log_file,'<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.1/css/bulma.css" /><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script><script>
				jQuery(document).ready(function(){
					function output(inp) {
						return inp;
					}

					function syntaxHighlight(json) {
						json = json.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
						return json.replace(/("(\u[a-zA-Z0-9]{4}|\[^u]|[^\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
							var cls = "number1";
							if (/^"/.test(match)) {
								if (/:$/.test(match)) {
									cls = "key";
								} else {
									cls = "string";
								}
							} else if (/true|false/.test(match)) {
								cls = "boolean";
							} else if (/null/.test(match)) {
								cls = "null";
							}
							return "<span class=\"" + cls + "\">" + match + "</span>";
						});
					}


					$("pre.json").each(function(){
						var div = $(this);
						var obj = JSON.parse(div.html());
						var str = JSON.stringify(obj, undefined, 4);
						div.html(output(syntaxHighlight(str)));

					});
				});
			</script><style>
			pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; color: #fff; background: #212121}
			.string { color: #FD971F; }
			.number1 { color: #66D9EF; }
			.boolean { color: #A6E22E; }
			.null { color: #F92672; }
			.key { color: #A6E22E; }

		</style>');


		}

		$type[0] = $type[1] = "json";

		if($this->isJson($params)){
			$params_dump = $params;
		} else {
			if(is_array($params)){
				$params_dump = json_encode($params);
			}else{
				$type[0] = "dump";
				ob_start();
				var_dump($params);
				$params_dump = ob_get_clean();
				ob_clean();
			}
		}

		
		if($this->isJson($result)){
			$result_dump = $result;
		} else {
			if(is_array($result)){
				$result_dump = json_encode($result);
			} else {
				$type[1] = "dump";
				ob_start();
				var_dump($result);
				$result_dump = ob_get_clean();
				ob_clean();
			}
		}
		$date = date("Y-m-d h:i:s");
		$data = '<div class="container"><div class="box">
		<div class="control">
			<div class="tags has-addons">
				<span class="tag is-warning">' . $method . '</span>
				<span class="tag is-dark">' . $url . ' - ' . $date .'</span>
			</div>
		</div>
		<hr>
		<div class="control">
			<div class="tags has-addons">
				<span class="tag is-info">Parameters</span>
				<span class="tag is-black">' . $date . '</span>
			</div>
		</div>
		<pre class="' . $type[0] . '">' . $params_dump . '</pre>
		<hr>
		<div class="control">
			<div class="tags has-addons">
				<span class="tag is-success">Response</span>
				<span class="tag is-black">' . $date . '</span>
			</div>
		</div>
		<pre class="' . $type[1] . '">' . $result_dump . '</pre>
	</div></div><hr>';

	file_put_contents($this->log_file, $data, FILE_APPEND | LOCK_EX);
}

public function isJson($string) {
	if(!is_string($string)){
		return false;
	}
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}


}
