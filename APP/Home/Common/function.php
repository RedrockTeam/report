<?php
function send_request($requestType, $conf = null){
	//请求的xml文本
	//dump($conf);
	$xml = [
		'Detail' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetRepairDetail xmlns="http://tempuri.org/"><id>'.$conf['id'].'</id><appId>'.$conf['appId'].'</appId></GetRepairDetail></soap12:Body></soap12:Envelope>',
		'TypeCategories' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetRepairTypeCategories xmlns="http://tempuri.org/" /></soap12:Body></soap12:Envelope>',
		'InfoById' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetRepairInfoById xmlns="http://tempuri.org/"><id>'.$conf['id'].'</id></GetRepairInfoById></soap12:Body></soap12:Envelope>',
		'Types' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetRepairTypes xmlns="http://tempuri.org/"><categId>'.$conf['cateId'].'</categId></GetRepairTypes></soap12:Body></soap12:Envelope>',
		'ServerAreas' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetServiceAreas xmlns="http://tempuri.org/" /></soap12:Body></soap12:Envelope>',
		'ServerTypes' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetServiceTypes xmlns="http://tempuri.org/" /></soap12:Body></soap12:Envelope>',
		'PayReturnVisit' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><SavePayReturnVisit xmlns="http://tempuri.org/"><value><rzm>'.$conf['rzm'].'</rzm><wxdjh>'.$conf['wxdjh'].'</wxdjh><hfmyd>'.$conf['hfmyd'].'</hfmyd><hfjy>'.$conf['hfjy'].'</hfjy></value></SavePayReturnVisit></soap12:Body></soap12:Envelope>',
		'RepairApp' => '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><SaveRepairApp xmlns="http://tempuri.org/"><value><rzm>'.$conf['rzm'].'</rzm><xm>'.$conf['xm'].'</xm><ip>'.$conf['ip'].'</ip><bt>'.$conf['bt'].'</bt><fwxmh>'.$conf['fwxmh'].'</fwxmh><bxdh>'.$conf['bxdh'].'</bxdh><fwqyh>'.$conf['fwqyh'].'</fwqyh><bxdd>'.$conf['bxdd'].'</bxdd><bxnr>'.$conf['bxnr'].'</bxnr></value></SaveRepairApp></soap12:Body></soap12:Envelope>',
	];
	//请求头的设置地址
	$url = [
		'Detail' => "http://tempuri.org/GetRepairDetail",
		'TypeCategories' => "http://tempuri.org/GetRepairTypeCategories",//ok
		'InfoById' => "http://tempuri.org/GetRepairInfoById",//ok
		'Types' => "http://tempuri.org/GetRepairTypes",//ok
		'ServerAreas' => "http://tempuri.org/GetServiceAreas",//ok
		'ServerTypes' => "http://tempuri.org/GetServiceTypes",
		'PayReturnVisit' => "http://tempuri.org/SavePayReturnVisit",
		'RepairApp' => "http://tempuri.org/SaveRepairApp",
	];
	$lenth = strlen($xml[$requestType]);
	$header = array (  
		"POST /repairservice.asmx HTTP/1.1",  
		"Host: 202.202.43.135:81",  
		"Content-Type: application/soap+xml; charset=utf-8",  
		"Content-length: $lenth",  
		'SOAPAction: "'.$url[$requestType].'"',
	);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "http://202.202.43.135:81/repairservice.asmx");  
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);  //设置头信息的地方  
	curl_setopt($ch, CURLOPT_HEADER, 0);    //不取得返回头信息    
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml[$requestType]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
	$result = curl_exec($ch);
	//dump($result);
	$dom = new DOMDocument();
	$dom->loadXML($result);
	$data = getArray($dom->documentElement);//获取xml信息
	switch ($requestType) {
		case 'Detail':
			$resArr = dell_Detail($data);
			break;
		case 'TypeCategories':
			$resArr = dell_TypeCategories($data);
			break;
		case 'InfoById':
			$resArr = dell_InfoById($data);
			break;
		case 'Types':
			$resArr = dell_Types($data);
			break;
		case 'ServerAreas':
			$resArr = dell_ServerAreas($data);
			break;
		case 'ServerTypes':
			$resArr = dell_ServerTypes($data);
			break;		
		case 'PayReturnVisit':
			$resArr = dell_PayReturnVisit($data);
			break;	
		case 'RepairApp':
			$resArr = dell_RepairApp($data);
			break;			
	}
	//dump($resArr);
	return $resArr;
}

/*
根据不同的分类获取数组并且解析
$data: 获取的xml格式原始数组
$xmlRes: 经过便利后的有效数组
*/
function dell_Detail($data){

}
function dell_TypeCategories($data){
	$result = null; //结果数组
	$xmlRes = $data["soap:Body"]["GetRepairTypeCategoriesResponse"]["GetRepairTypeCategoriesResult"]["RepairTypeCategories"];
	return $xmlRes;//返回
}
function dell_InfoById($data){
	$result = null;
	$xmlRes = $data["soap:Body"]["GetRepairInfoByIdResponse"]["GetRepairInfoByIdResult"]["RepairInfo"];
	return $xmlRes;
}
function dell_Types($data){
	$result = null;
	$xmlRes = $data["soap:Body"]["GetRepairTypesResponse"]["GetRepairTypesResult"]["RepairTypes"];
	return $xmlRes;
}
function dell_ServerAreas($data){
	$result = null;
	$xmlRes = $data["soap:Body"]["GetServiceAreasResponse"]["GetServiceAreasResult"]["ServiceAreas"];
	return $xmlRes;
}
function dell_ServerTypes($data){
	$result = null;
	$xmlRes = $data["soap:Body"]["GetServiceTypesResponse"]["GetServiceTypesResult"]["ServiceTypes"];
	return $xmlRes;
}
function dell_PayReturnVisit($data){
	
}
function dell_RepairApp($data){
	$result = null; //结果数组
	$xmlRes = $data["soap:Body"]["SaveRepairAppResponse"]["SaveRepairAppResult"]["#text"];
	return $xmlRes;//这里是返回的维修单号
}

function getArray($node) {
    $array = false;

  	if ($node->hasAttributes()) {
    	foreach ($node->attributes as $attr) {
      		$array[$attr->nodeName] = $attr->nodeValue;
    	}
  	}
  	if ($node->hasChildNodes()) {
    	if ($node->childNodes->length == 1) {
      		$array[$node->firstChild->nodeName] = getArray($node->firstChild);
    	}else{
      		foreach ($node->childNodes as $childNode) {
      			if ($childNode->nodeType != XML_TEXT_NODE) {
        			$array[$childNode->nodeName][] = getArray($childNode);
      			}
    		}
  		}
  	}else {
    	return $node->nodeValue;
  	}
  		return $array;
}