<?php
namespace EpicBit\BillPhpSdk;

class Api {
	private $mode = "standard";
	private $log = false;
	protected $log_file = 'errorlog.html';
	protected $memory_log = [];
	protected $log_type = 'file';
	private $api_token = "";
	private $version = '1.0';
	private $prefix;
	private $http_code;
	private $valid_currency =  ["EUR_€" => "Euro (€)","USD_$" => "U.S. dollar ($)","GBP_£" => "Pound sterling (£)","CAD_C$" => "Canadian dollar (C$)","AUD_A$" => "Australian dollar (A$)","ZAR_R" => "South African rand (R)","AFN_؋" => "Afghan afghani (؋)","ALL_L" => "Albanian lek (L)","DZD_د.ج" => "Algerian dinar (د.ج)","AOA_Kz" => "Angolan kwanza (Kz)","ARS_$" => "Argentine peso ($)","AMD_դր." => "Armenian dram (դր.)","AWG_ƒ" => "Aruban florin (ƒ)","AZN_¤" => "Azerbaijani manat (¤)","BSD_$" => "Bahamian dollar ($)","BHD_ب.د" => "Bahraini dinar (ب.د)","BDT_¤" => "Bangladeshi taka (¤)","BBD_$" => "Barbadian dollar ($)","BYR_Br" => "Belarusian ruble (Br)","BZD_$" => "Belize dollar ($)","BMD_$" => "Bermudian dollar ($)","BTN_¤" => "Bhutanese ngultrum (¤)","BOB_Bs." => "Bolivian boliviano (Bs.)","BAM_KM" => "Bosnia & Herzegovina mark (KM)","BWP_P" => "Botswana pula (P)","BRL_R$" => "Brazilian real (R$)","BND_$" => "Brunei dollar ($)","BGN_лв" => "Bulgarian lev (лв)","BIF_Fr" => "Burundian franc (Fr)","KHR_¤" => "Cambodian riel (¤)","CVE_Esc" => "Cape Verdean escudo (Esc)","KYD_$" => "Cayman Islands dollar ($)","XAF_Fr" => "Central African CFA franc (Fr)","XPF_Fr" => "CFP franc (Fr)","CLP_$" => "Chilean peso ($)","CNY_¥" => "Chinese yuan (¥)","COP_$" => "Colombian peso ($)","KMF_Fr" => "Comorian franc (Fr)","CDF_Fr" => "Congolese franc (Fr)","CRC_₡" => "Costa Rican colón (₡)","HRK_kn" => "Croatian kuna (kn)","CUC_$" => "Cuban convertible peso ($)","CUP_$" => "Cuban peso ($)","CZK_Kč" => "Czech koruna (Kč)","DKK_kr." => "Danish krone (kr.)","DJF_Fr" => "Djiboutian franc (Fr)","DOP_$" => "Dominican peso ($)","XCD_$" => "East Caribbean dollar ($)","EGP_ج.م" => "Egyptian pound (ج.م)","ERN_Nfk" => "Eritrean nakfa (Nfk)","EEK_KR" => "Estonian kroon (KR)","ETB_¤" => "Ethiopian birr (¤)","FKP_£" => "Falkland Islands pound (£)","FJD_$" => "Fijian dollar ($)","GMD_D" => "Gambian dalasi (D)","GEL_ლ" => "Georgian lari (ლ)","GHS_₵" => "Ghanaian cedi (₵)","GIP_£" => "Gibraltar pound (£)","GTQ_Q" => "Guatemalan quetzal (Q)","GNF_Fr" => "Guinean franc (Fr)","GYD_$" => "Guyanese dollar ($)","HTG_G" => "Haitian gourde (G)","HNL_L" => "Honduran lempira (L)","HKD_$" => "Hong Kong dollar ($)","HUF_Ft" => "Hungarian forint (Ft)","ISK_kr" => "Icelandic króna (kr)","INR_Rs" => "Indian rupee (Rs)","IDR_Rp" => "Indonesian rupiah (Rp)","IRR_﷼" => "Iranian rial (﷼)","IQD_ع.د" => "Iraqi dinar (ع.د)","ILS_₪" => "Israeli new sheqel (₪)","JMD_$" => "Jamaican dollar ($)","JPY_¥" => "Japanese yen (¥)","JOD_د.ا" => "Jordanian dinar (د.ا)","KZT_〒" => "Kazakhstani tenge (〒)","KES_Sh" => "Kenyan shilling (Sh)","KWD_د.ك" => "Kuwaiti dinar (د.ك)","KGS_¤" => "Kyrgyzstani som (¤)","LAK_₭" => "Lao kip (₭)","LVL_Ls" => "Latvian lats (Ls)","LBP_ل.ل" => "Lebanese pound (ل.ل)","LSL_L" => "Lesotho loti (L)","LRD_$" => "Liberian dollar ($)","LYD_ل.د" => "Libyan dinar (ل.د)","LTL_Lt" => "Lithuanian litas (Lt)","MOP_P" => "Macanese pataca (P)","MKD_ден" => "Macedonian denar (ден)","MGA_¤" => "Malagasy ariary (¤)","MWK_MK" => "Malawian kwacha (MK)","MYR_RM" => "Malaysian ringgit (RM)","MVR_Rf" => "Maldivian rufiyaa (Rf)","MRO_UM" => "Mauritanian ouguiya (UM)","MUR_₨" => "Mauritian rupee (₨)","MXN_$" => "Mexican peso ($)","MDL_L" => "Moldovan leu (L)","MNT_₮" => "Mongolian tögrög (₮)","MAD_د.م." => "Moroccan dirham (د.م.)","MZN_MZN" => "Mozambican metical (MZN)","MMK_K" => "Myanma kyat (K)","NAD_$" => "Namibian dollar ($)","NPR_₨" => "Nepalese rupee (₨)","ANG_ƒ" => "Netherlands Antillean guilder (ƒ)","TWD_$" => "New Taiwan dollar ($)","NZD_$" => "New Zealand dollar ($)","NIO_C$" => "Nicaraguan córdoba (C$)","NGN_₦" => "Nigerian naira (₦)","KPW_₩" => "North Korean won (₩)","NOK_kr" => "Norwegian krone (kr)","OMR_ر.ع." => "Omani rial (ر.ع.)","PKR_₨" => "Pakistani rupee (₨)","PAB_B/." => "Panamanian balboa (B/.)","PGK_K" => "Papua New Guinean kina (K)","PYG_₲" => "Paraguayan guaraní (₲)","PEN_S/." => "Peruvian nuevo sol (S/.)","PHP_₱" => "Philippine peso (₱)","PLN_zł" => "Polish złoty (zł)","QAR_ر.ق" => "Qatari riyal (ر.ق)","RON_L" => "Romanian leu (L)","RUB_р." => "Russian ruble (р.)","RWF_Fr" => "Rwandan franc (Fr)","SHP_£" => "Saint Helena pound (£)","SVC_₡" => "Salvadoran colón (₡)","WST_T" => "Samoan tala (T)","STD_Db" => "São Tomé and Príncipe dobra (Db)","SAR_ر.س" => "Saudi riyal (ر.س)","RSD_дин." => "Serbian dinar (дин.)","SCR_₨" => "Seychellois rupee (₨)","SLL_Le" => "Sierra Leonean leone (Le)","SGD_$" => "Singapore dollar ($)","SBD_$" => "Solomon Islands dollar ($)","SOS_Sh" => "Somali shilling (Sh)","KRW_₩" => "South Korean won (₩)","LKR_Rs" => "Sri Lankan rupee (Rs)","SDG_£" => "Sudanese pound (£)","SRD_$" => "Surinamese dollar ($)","SZL_L" => "Swazi lilangeni (L)","SEK_kr" => "Swedish krona (kr)","CHF_Fr" => "Swiss franc (Fr)","SYP_ل.س" => "Syrian pound (ل.س)","TJS_ЅМ" => "Tajikistani somoni (ЅМ)","TZS_Sh" => "Tanzanian shilling (Sh)","THB_฿" => "Thai baht (฿)","TOP_T$" => "Tongan paʻanga (T$)","TTD_$" => "Trinidad and Tobago dollar ($)","TND_د.ت" => "Tunisian dinar (د.ت)","TRY_TL" => "Turkish lira (TL)","TMM_m" => "Turkmenistani manat (m)","UGX_Sh" => "Ugandan shilling (Sh)","UAH_₴" => "Ukrainian hryvnia (₴)","AED_د.إ" => "United Arab Emirates dirham (د.إ)","UYU_$" => "Uruguayan peso ($)","UZS_¤" => "Uzbekistani som (¤)","VUV_Vt" => "Vanuatu vatu (Vt)","VEF_Bs F" => "Venezuelan bolívar (Bs F)","VND_₫" => "Vietnamese đồng (₫)","XOF_Fr" => "West African CFA franc (Fr)","YER_﷼" => "Yemeni rial (﷼)","ZMK_ZK" => "Zambian kwacha (ZK)","ZWR_$" => "Zimbabwean dollar ($)","XDR_SDR" => "Special Drawing Rights (SDR)","TMT_m" => "Turkmen manat (m)","VEB_Bs" => "Venezuelan bolivar (Bs)"];

	private $countries = array
	(
		'AF' => 'Afghanistan',
		'AX' => 'Aland Islands',
		'AL' => 'Albania',
		'DZ' => 'Algeria',
		'AS' => 'American Samoa',
		'AD' => 'Andorra',
		'AO' => 'Angola',
		'AI' => 'Anguilla',
		'AQ' => 'Antarctica',
		'AG' => 'Antigua And Barbuda',
		'AR' => 'Argentina',
		'AM' => 'Armenia',
		'AW' => 'Aruba',
		'AU' => 'Australia',
		'AT' => 'Austria',
		'AZ' => 'Azerbaijan',
		'BS' => 'Bahamas',
		'BH' => 'Bahrain',
		'BD' => 'Bangladesh',
		'BB' => 'Barbados',
		'BY' => 'Belarus',
		'BE' => 'Belgium',
		'BZ' => 'Belize',
		'BJ' => 'Benin',
		'BM' => 'Bermuda',
		'BT' => 'Bhutan',
		'BO' => 'Bolivia',
		'BA' => 'Bosnia And Herzegovina',
		'BW' => 'Botswana',
		'BV' => 'Bouvet Island',
		'BR' => 'Brazil',
		'IO' => 'British Indian Ocean Territory',
		'BN' => 'Brunei Darussalam',
		'BG' => 'Bulgaria',
		'BF' => 'Burkina Faso',
		'BI' => 'Burundi',
		'KH' => 'Cambodia',
		'CM' => 'Cameroon',
		'CA' => 'Canada',
		'CV' => 'Cape Verde',
		'KY' => 'Cayman Islands',
		'CF' => 'Central African Republic',
		'TD' => 'Chad',
		'CL' => 'Chile',
		'CN' => 'China',
		'CX' => 'Christmas Island',
		'CC' => 'Cocos (Keeling) Islands',
		'CO' => 'Colombia',
		'KM' => 'Comoros',
		'CG' => 'Congo',
		'CD' => 'Congo, Democratic Republic',
		'CK' => 'Cook Islands',
		'CR' => 'Costa Rica',
		'CI' => 'Cote D\'Ivoire',
		'HR' => 'Croatia',
		'CU' => 'Cuba',
		'CY' => 'Cyprus',
		'CZ' => 'Czech Republic',
		'DK' => 'Denmark',
		'DJ' => 'Djibouti',
		'DM' => 'Dominica',
		'DO' => 'Dominican Republic',
		'EC' => 'Ecuador',
		'EG' => 'Egypt',
		'SV' => 'El Salvador',
		'GQ' => 'Equatorial Guinea',
		'ER' => 'Eritrea',
		'EE' => 'Estonia',
		'ET' => 'Ethiopia',
		'FK' => 'Falkland Islands (Malvinas)',
		'FO' => 'Faroe Islands',
		'FJ' => 'Fiji',
		'FI' => 'Finland',
		'FR' => 'France',
		'GF' => 'French Guiana',
		'PF' => 'French Polynesia',
		'TF' => 'French Southern Territories',
		'GA' => 'Gabon',
		'GM' => 'Gambia',
		'GE' => 'Georgia',
		'DE' => 'Germany',
		'GH' => 'Ghana',
		'GI' => 'Gibraltar',
		'GR' => 'Greece',
		'GL' => 'Greenland',
		'GD' => 'Grenada',
		'GP' => 'Guadeloupe',
		'GU' => 'Guam',
		'GT' => 'Guatemala',
		'GG' => 'Guernsey',
		'GN' => 'Guinea',
		'GW' => 'Guinea-Bissau',
		'GY' => 'Guyana',
		'HT' => 'Haiti',
		'HM' => 'Heard Island & Mcdonald Islands',
		'VA' => 'Holy See (Vatican City State)',
		'HN' => 'Honduras',
		'HK' => 'Hong Kong',
		'HU' => 'Hungary',
		'IS' => 'Iceland',
		'IN' => 'India',
		'ID' => 'Indonesia',
		'IR' => 'Iran, Islamic Republic Of',
		'IQ' => 'Iraq',
		'IE' => 'Ireland',
		'IM' => 'Isle Of Man',
		'IL' => 'Israel',
		'IT' => 'Italy',
		'JM' => 'Jamaica',
		'JP' => 'Japan',
		'JE' => 'Jersey',
		'JO' => 'Jordan',
		'KZ' => 'Kazakhstan',
		'KE' => 'Kenya',
		'KI' => 'Kiribati',
		'KR' => 'Korea',
		'KW' => 'Kuwait',
		'KG' => 'Kyrgyzstan',
		'LA' => 'Lao People\'s Democratic Republic',
		'LV' => 'Latvia',
		'LB' => 'Lebanon',
		'LS' => 'Lesotho',
		'LR' => 'Liberia',
		'LY' => 'Libyan Arab Jamahiriya',
		'LI' => 'Liechtenstein',
		'LT' => 'Lithuania',
		'LU' => 'Luxembourg',
		'MO' => 'Macao',
		'MK' => 'Macedonia',
		'MG' => 'Madagascar',
		'MW' => 'Malawi',
		'MY' => 'Malaysia',
		'MV' => 'Maldives',
		'ML' => 'Mali',
		'MT' => 'Malta',
		'MH' => 'Marshall Islands',
		'MQ' => 'Martinique',
		'MR' => 'Mauritania',
		'MU' => 'Mauritius',
		'YT' => 'Mayotte',
		'MX' => 'Mexico',
		'FM' => 'Micronesia, Federated States Of',
		'MD' => 'Moldova',
		'MC' => 'Monaco',
		'MN' => 'Mongolia',
		'ME' => 'Montenegro',
		'MS' => 'Montserrat',
		'MA' => 'Morocco',
		'MZ' => 'Mozambique',
		'MM' => 'Myanmar',
		'NA' => 'Namibia',
		'NR' => 'Nauru',
		'NP' => 'Nepal',
		'NL' => 'Netherlands',
		'AN' => 'Netherlands Antilles',
		'NC' => 'New Caledonia',
		'NZ' => 'New Zealand',
		'NI' => 'Nicaragua',
		'NE' => 'Niger',
		'NG' => 'Nigeria',
		'NU' => 'Niue',
		'NF' => 'Norfolk Island',
		'MP' => 'Northern Mariana Islands',
		'NO' => 'Norway',
		'OM' => 'Oman',
		'PK' => 'Pakistan',
		'PW' => 'Palau',
		'PS' => 'Palestinian Territory, Occupied',
		'PA' => 'Panama',
		'PG' => 'Papua New Guinea',
		'PY' => 'Paraguay',
		'PE' => 'Peru',
		'PH' => 'Philippines',
		'PN' => 'Pitcairn',
		'PL' => 'Poland',
		'PT' => 'Portugal',
		'PR' => 'Puerto Rico',
		'QA' => 'Qatar',
		'RE' => 'Reunion',
		'RO' => 'Romania',
		'RU' => 'Russian Federation',
		'RW' => 'Rwanda',
		'BL' => 'Saint Barthelemy',
		'SH' => 'Saint Helena',
		'KN' => 'Saint Kitts And Nevis',
		'LC' => 'Saint Lucia',
		'MF' => 'Saint Martin',
		'PM' => 'Saint Pierre And Miquelon',
		'VC' => 'Saint Vincent And Grenadines',
		'WS' => 'Samoa',
		'SM' => 'San Marino',
		'ST' => 'Sao Tome And Principe',
		'SA' => 'Saudi Arabia',
		'SN' => 'Senegal',
		'RS' => 'Serbia',
		'SC' => 'Seychelles',
		'SL' => 'Sierra Leone',
		'SG' => 'Singapore',
		'SK' => 'Slovakia',
		'SI' => 'Slovenia',
		'SB' => 'Solomon Islands',
		'SO' => 'Somalia',
		'ZA' => 'South Africa',
		'GS' => 'South Georgia And Sandwich Isl.',
		'ES' => 'Spain',
		'LK' => 'Sri Lanka',
		'SD' => 'Sudan',
		'SR' => 'Suriname',
		'SJ' => 'Svalbard And Jan Mayen',
		'SZ' => 'Swaziland',
		'SE' => 'Sweden',
		'CH' => 'Switzerland',
		'SY' => 'Syrian Arab Republic',
		'TW' => 'Taiwan',
		'TJ' => 'Tajikistan',
		'TZ' => 'Tanzania',
		'TH' => 'Thailand',
		'TL' => 'Timor-Leste',
		'TG' => 'Togo',
		'TK' => 'Tokelau',
		'TO' => 'Tonga',
		'TT' => 'Trinidad And Tobago',
		'TN' => 'Tunisia',
		'TR' => 'Turkey',
		'TM' => 'Turkmenistan',
		'TC' => 'Turks And Caicos Islands',
		'TV' => 'Tuvalu',
		'UG' => 'Uganda',
		'UA' => 'Ukraine',
		'AE' => 'United Arab Emirates',
		'GB' => 'United Kingdom',
		'US' => 'United States',
		'UM' => 'United States Outlying Islands',
		'UY' => 'Uruguay',
		'UZ' => 'Uzbekistan',
		'VU' => 'Vanuatu',
		'VE' => 'Venezuela',
		'VN' => 'Viet Nam',
		'VG' => 'Virgin Islands, British',
		'VI' => 'Virgin Islands, U.S.',
		'WF' => 'Wallis And Futuna',
		'EH' => 'Western Sahara',
		'YE' => 'Yemen',
		'ZM' => 'Zambia',
		'ZW' => 'Zimbabwe',
		);

function __construct($mode = "standard", $version = '1.0') 
{
	$this->mode = $mode;
	$this->version = $version;
	$this->prefix = 'api/' . $version . '/';
}

public function isValidCurrency($currency)
{
	return array_key_exists($currency, $this->getCurrencyList());
}

public function getCurrencyList()
{
	return $this->valid_currency;
}

public function getCountriesList()
{
	return $this->countries;
}

public function getLogFromMemory()
{
	return $this->memory_log;
}

public function isValidDateTime($dateStr, $format = "Y-m-d H:i:s")
{
	date_default_timezone_set('UTC');
	$date = DateTime::createFromFormat($format, $dateStr);
	return $date && ($date->format($format) === $dateStr);
}

public function isValidZipCode($zipCode)
{
	$regexp = "/[0-9]{4}\-[0-9]{3}/";
	if (preg_match($regexp, $zipCode)) {
		return(true);
	} else {
		return(false);
	}
}

public function validToken()
{
	if( strlen( $this->api_token ) < 120 ){
		return false;
	}

	$this->postCheckToken();

	return $this->success();
}

public function postCheckToken()
{
	return $this->request('POST', 'valid-token', []);
}

public function getModeUrl($url)
{
	$domain = "https://app.bill.pt/";
	if( $this->mode == "standard" ||  $this->mode == "portugal" ){
		$domain = "https://app.bill.pt/";
	}

	if( $this->mode == "dev" ){
		$domain = "https://dev.bill.pt/";
	}

	if( $this->mode == "world" ){
		$domain = "https://int.bill.pt/";
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

	$this->http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	
	if($this->log){
		$time = [
		'total' =>  curl_getinfo($curl, CURLINFO_TOTAL_TIME),
		'namelookup' => curl_getinfo($curl, CURLINFO_NAMELOOKUP_TIME),
		'connect' => curl_getinfo($curl, CURLINFO_CONNECT_TIME)
		];

		$this->prettyLog($method, $url, $params, $response, $time, $this->log_type);
	}

	return $this->isJson($response) ? json_decode($response) : $response;
}

public function success(){
	if($this->http_code > 199 && $this->http_code < 300){
		return true;
	}

	return false;
}

public function getHttpCode()
{
	return $this->http_code;
}

public function setLog($log, $type = "file")
{
	$this->log = $log;
	$this->log_type = $type;
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


public function getContacts($params = [])
{
	return $this->request('GET', 'contatos', $params);
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


public function getItems($params = [])
{
	return $this->request('GET', 'items', $params);
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

public function convertDocumentWithID($document_id, $convert_to, $date = null, $date_shipping = null, $date_delivery = null)
{
	$original = $this->getDocumentWithID($document_id);
	$document['tipificacao'] = $convert_to;
	$document['contato_id'] = $original->contato_id;
	$document['loja_id'] = $original->loja_id;
	$document['serie_id'] = $original->serie_id;
	$document['metodo_pagamento_id'] = $original->metodo_pagamento_id;
	$document['metodo_expedicao_id'] = $original->metodo_expedicao_id;

	if( !is_null($date)){
		$document['data'] = $date;
	}

	if(isset($original->morada) && $original->morada != ""){
		$document['morada'] = $original->morada;
	}

	if(isset($original->codigo_postal) && $original->codigo_postal != ""){
		$document['codigo_postal'] = $original->codigo_postal;
	}

	if(isset($original->cidade) && $original->cidade != ""){
		$document['cidade'] = $original->cidade;
	}

	if(isset($original->pais) && $original->pais != ""){
		$document['pais'] = $original->pais;
	}

	if($original->carga_morada != ""){
		$document['carga_morada'] = $original->carga_morada;
	}

	if($original->carga_codigo_postal != ""){
		$document['carga_codigo_postal'] = $original->carga_codigo_postal;
	}

	if($original->carga_cidade != ""){
		$document['carga_cidade'] = $original->carga_cidade;
	}

	if($original->carga_pais != ""){
		$document['carga_pais'] = $original->carga_pais;
	}

	if(!is_null($date_shipping) && $original->data_carga != ""){
		$document['data_carga'] = $date_shipping;
	}

	if($original->descarga_morada != ""){
		$document['descarga_morada'] = $original->descarga_morada;
	}

	if($original->descarga_codigo_postal != ""){
		$document['descarga_codigo_postal'] = $original->descarga_codigo_postal;
	}

	if($original->descarga_cidade != ""){
		$document['descarga_cidade'] = $original->descarga_cidade;
	}

	if($original->descarga_pais != ""){
		$document['descarga_pais'] = $original->descarga_pais;
	}

	if(!is_null($date_delivery) && $original->data_descarga != ""){
		$document['data_descarga'] = $date_delivery;
	}


	foreach($original->lancamentos as $key => $lancamento){
		$lancamento_pai = $lancamento->id;
		$produtos[$key] = (array) $lancamento;
		$produtos[$key]['lancamento_pai_id'] = $lancamento_pai;
	}

	$document['produtos'] = $produtos;
	$document['terminado'] = 1;

	return $this->createDocument($document);;
}



public function createReceipt($params)
{
	return $this->request('POST', 'recibos/', $params);
}

public function createReceiptToDocumentWithID($id, $params = [])
{
	return $this->request('POST', 'recibos/pagar/' . $id, $params);
}


public function prettyLog($method, $url, $params, $result, $response_time, $type_of_log = 'file')
{
	if($this->log_type == "memory"){
		$this->memory_log[] = [
		'method' => $method,
		'url' => $url,
		'params' => $params,
		'result' => $result,
		'response_time' => $response_time
		];
		return;
	}

	if(!file_exists($this->log_file)){
		$response_time = $response_time['total'];

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
		<div class="tags has-addons">
			<span class="tag is-info">Time</span>
			<span class="tag is-black">' . $response_time . '</span>
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
