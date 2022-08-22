<?php
$FO=$_Post["FO"];
 
$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
 or die('Could not connect: ' . pg_last_error());
  $query = "DELETE FROM passlog where State='Uralfo'";
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

$p='http://uralfo.gov.ru';

include('simple_html_dom.php');
$urls = 'http://uralfo.gov.ru/polpred/polpred/';
		
			//$out = file_get_contents($urls);	//и добавляем содержание каждой страницы в строку
	$html = new simple_html_dom();	//создаем объект
	
	
	$html = file_get_html($urls);	//помещаем наш контент	
foreach($html->find('h2.person-post') as $text){ 
$a=$text->plaintext;
//echo $a; 
} 
foreach($html->find('img') as $text){ 
$b=$text->alt;
//echo $b; 
} 
foreach($html->find('img') as $pic)
$c='http://uralfo.gov.ru'.$pic->src;       
$way='/URAL/p.png';	   
$ch = curl_init($c);
$fp = fopen(".".$way, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);


	   
$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
 or die('Could not connect: ' . pg_last_error());
 
 $query = "INSERT INTO passlog values ('$b','$a','$way','Uralfo')";
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());




//замы
$urls2 = 'http://uralfo.gov.ru/polpred/staff/';
$html = file_get_html($urls2);
$i=0;
foreach($html->find('span.person_caption') as $text){ 
$a=$text->plaintext;
$i++;
//echo $a;

  $query = "INSERT INTO passlog values ('$i','$a',null,'Uralfo')";
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
} 
$e=1;
$i=0;
	foreach($html->find('img') as $pic){
$c='http://uralfo.gov.ru'.$pic->src;       
$way='/URAL/'.$e.'.png';	   
//echo $way;
$e++;
$i++;
$ch = curl_init($c);
$fp = fopen(".".$way, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);
  $query = "UPDATE passlog SET img ='$way' where fio = '$i'";
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());}

$i=0;
foreach($html->find('span.person_title') as $text){ 
$b=$text->plaintext;
//echo $b;
$i++;
  $query = "UPDATE passlog SET fio ='$b' where fio = '$i'";
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
} 


header('Location: 1.html');
//http://ufo.gov.ru/polpred/biography/
//http://www.dfo.gov.ru/polpred/polpred/
//http://skfo.gov.ru/polpred/polpred/
//http://szfo.gov.ru/polpred/polpred/
//http://sfo.gov.ru/polpred/polpred/
//http://uralfo.gov.ru/polpred/polpred/

?>
