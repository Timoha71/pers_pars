<?php

session_start();
$url=$_POST["url"];
$_SESSION['url']=$url;
echo $url;

include('simple_html_dom.php');
		
	$html = new simple_html_dom();	
	$proxy = '10.0.0.1:3128';

$context = array( 
   'http' => array( 
      'proxy' => $proxy,
      'request_fulluri' => true, 
    ), 
);	
//stream_context_set_default(['http'=>['proxy'=>'10.0.0.1:3128']]);		
$stream = stream_context_create($context);
	//$html = file_get_html($url, false, $context);//$html = file_get_html($url);
	$html = file_get_html($url);
	$template= file_get_contents("Template.html");

$url1 = strrev($url);
$url2 = strpbrk($url1, '/');
$url3 = strrev($url2);
/*echo $url1;
echo $url2;
echo $url3;
echo '<br>';	*/

foreach($html->find('img') as $pic){

$c=$pic->src; 
//echo $c; 
echo '<br>';


//!echo $url3.$c;
//!echo $c;
//preg_match_all('\/\w{2,}\/\w{2,}\.\w{2,}',$c,$out);
//preg_match_all('/\/\w{2,}\/\w{2,}\.\w{2,}/',$c,$out) ;
//print_r($out);

$c1 = strrev($c);
$c2 = strpbrk($c1, '/');
$c3 = strrev($c2);
$dir = rtrim($c3, '/');
$c4 = strpbrk($c, '/');
//!echo $dir;

//!echo '<br>'; 
	  
$ch = curl_init($url3.$c);
//curl_setopt($ch, CURLOPT_PROXY, '10.0.0.1');
//curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
if (!file_exists($dir)) { 
    mkdir($dir);
}

$f1 = fopen($c, 'w+');

curl_setopt($ch, CURLOPT_FILE, $f1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($f1);
}




foreach ($html->find('link') as $link)
{
$l = $link->href;
$css = file_get_html($url3.$l);
$f2 = fopen($l,'w+');
fwrite ($f2, $css); 
fclose($f2);
}


$fp = fopen ('stranica.html', 'w+');
fwrite ($fp, $html); 
$fp = fopen ('stranica.html', 'a+');
fwrite ($fp, $template); 

fclose($fp);

$html->clear();
unset($html);
//header('Location: stranica.html');
echo '<script>location.replace("stranica.html");</script>'; exit;


?>
