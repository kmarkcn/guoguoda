<?php
$arr = getXmlToArray();
$out_trade_no = $arr['out_trade_no'];
$money = $arr['total_fee'];
$url = "http://www.kmark.cn/gogoda/index.php?s=addon/GuoGuoUser/Gguser/payResults/out_trade_no/".$out_trade_no."/money/".$money."/";
if(file_get_contents($url)=='1'){
	echo "success";
}




function getXmlToArray(){
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	$array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
	return $array_data;
}

































?>