<?php
$p='http://uralfo.gov.ru';

include('simple_html_dom.php');
$urls = 'http://uralfo.gov.ru/polpred/staff/';
		
			//$out = file_get_contents($urls);	//� ��������� ���������� ������ �������� � ������
	$html = new simple_html_dom();	//������� ������
	$html = file_get_html($urls);
$e=1;
	foreach($html->find('img') as $pic){
$c='http://uralfo.gov.ru'.$pic->src;       
$way='/URAL/'.$e.'.png';	   
echo $way;
$e++;
$ch = curl_init($c);
$fp = fopen(".".$way, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);}

?>

