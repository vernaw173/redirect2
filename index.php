<?php

$url = 'https://hddn.cc/json/links?token=ac572c37e40235b8ce75bb3282c96f0a';   //ваша ссылка с токеном из профайла
$offers = array('853');   //ID офферов или только один оффер
$utm = '';  //например = $_GET['utm'], тогда открываем как http://moy-domain.ru/?utm=111
$preland = 0; //переход на прилэнд

shuffle($offers);
$offer = $offers[0];
if(!file_exists(md5($url).'.json')||filectime(md5($url).'.json') < time()-5*60){
    $urldata = file_get_contents($url);
    if($urldata)if(!file_put_contents(md5($url).'.json',$urldata)) die("File write error (create file '".md5($url).".json' with 666 permission)");
}
$urldata = json_decode(file_get_contents(md5($url).'.json'),1);

if(isset($urldata['offers'][$offer]['link'])){
    if($preland)
	header("Location: ".str_replace('/d/','/dp/',$urldata['offers'][$offer]['link']).($utm?"?u=$utm":(isset($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'')), true);
    else
	header("Location: ".$urldata['offers'][$offer]['link'].($utm?"?u=$utm":(isset($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'')), true);
}
else die('Error');
