<?php
header("Content-type: text/html; charset=utf-8");

define("ACCESS_TOKEN", 'V1bScbZACg8Wdqb9Bwz1wybRw8GL0heXetWeC3IYw4pOLrbMq0DkPK_bqtQEOIZrKVzD3hrwz9QBbSDaox4EtqUPBx_VHT6oNPAa2V5Iac4');

//创建菜单
function createMenu($data){
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".ACCESS_TOKEN);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $tmpInfo = curl_exec($ch);
 if (curl_errno($ch)) {
  return curl_error($ch);
 }
 curl_close($ch);
 return $tmpInfo;
}


$data = '{
"touser":"oMMDvsogMl3Pe124vjJPxMloKuBg",
"template_id":"ORnBy0hHWemGYWtmOMhR8xpUb3QDXf2Lt-HDZ27Oupg",
"url":"http://www.sunrise-inc.co.jp/gintama/",
"topcolor":"#FF0000",
"data":{
"first": {
"value":"您好，您的万事屋VIP会员服务已经成功开通啦",
"color":"#173177"
},
"product":{
"value":"终身荣誉会员",
"color":"#173177"
},
"price":{
"value":"9999999.00日元",
"color":"#173177"
},
"time":{
"value":"10月25日 16时03分",
"color":"#173177"
},
"remark":{
"value":"请于三日内前往歌舞伎町进行签到",
"color":"#173177"
}
}
}';



echo createMenu($data);//创建菜单

?>