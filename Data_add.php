<?php
session_start();
$link=$_SESSION['url'];

$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
    or die('Could not connect: ' . pg_last_error());
	
date_default_timezone_set('Europe/Moscow');

include('simple_html_dom.php');
$html = new simple_html_dom();

$d12 = new simple_html_dom();

$d1=$_POST['d1'];
$d2=$_POST['d2'];
$d3=$_POST['d3'];
$d4=$_POST['d4'];
$d5=$_POST['d5'];
$d6=$_POST['d6'];
$d7=$_POST['d7'];
$d8=$_POST['d8'];
$d9=$_POST['d9'];
$d10=$_POST['d10'];
$d11=$_POST['d11'];
$d12=$_POST['d12'];
$html= str_get_html($d12);
$i = 1;
/*foreach($html->find('img') as $pic){
$i++;

echo $pic;	
}	*/
//$('button').not('[id]').not('[class]').text('Here is Johnny!');

/*foreach($d12->find('img') as $pic)
$c='http://uralfo.gov.ru'.$pic->src;       
$way='/URAL/p.png';	   
$ch = curl_init($c);
$fp = fopen(".".$way, 'wb');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);*/

$query = "INSERT INTO person (fio, fio_tag, fio_id, fio_class,
			rank_id, rank_tag, rank_class, rank_name, link, img_id, img_tag, img_class, img)
			values ('$d4', '$d2', '$d1', '$d3', '$d5', '$d6', '$d7', '$d8', '$link',
			'$d9', '$d10', '$d11', '$d12')";

$result = pg_query($query) or die('Request mistake(ошибка запроса): ' . pg_last_error());

pg_free_result($result);
pg_close($dbconn);
header('Location: add_pers.html');
?>
