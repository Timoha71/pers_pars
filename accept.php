<?php
include('simple_html_dom.php');


$html=new simple_html_dom();

$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
or die('Ошибка подключения: ' . pg_last_error());

$query = 'SELECT * FROM person;';
$result = pg_query($query) or die('Request mistake(ошибка запроса): ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{
$url=$line['link'];
$url1 = strrev($url);
$url2 = strpbrk($url1, '/');
$url3 = strrev($url2);

$html = file_get_html($url);

if ($line['fio_class']=='')
{$a1 = $line['fio_tag'];}
else {$a1 = $line['fio_tag']."[class=".$line['fio_class']."]";}

if ($line['rank_class']=='')
{$b1 = $line['rank_tag'];}
else {$b1 = $line['rank_tag']."[class=".$line['rank_class']."]";}

if ($line['img_class']=='')
{$c1 = $line['img_tag'];}
else {$c1 = $line['img_tag']."[class=".$line['img_class']."]";}

foreach($html->find($a1) as $text) {
$a = $text->plaintext;
$query1 = "UPDATE person SET fio='".$a."' where link='".$line['link']."';";
$result1 = pg_query($query1) or die('Request mistake: ' . pg_last_error());
pg_free_result($result1);
}

foreach($html->find($b1) as $text) {
$b = $text->plaintext;
$query2 = "UPDATE person SET rank_name='".$b."'where link='".$line['link']."';";
$result1 = pg_query($query2) or die('Request mistake: ' . pg_last_error());
pg_free_result($result1);
}

foreach($html->find($c1) as $text) {
$c2=$c = $text->outertext;
$c = $text->innertext;
$cc = str_get_html($c);

foreach($cc->find('img') as $pic){
$picture=$pic->src;
 
$picture1 = strrev($picture);
$picture2 = strpbrk($picture1, '/');
$picture3 = strrev($picture2);
$dir = rtrim($picture3, '/');
$picture4 = strpbrk($picture, '/');
	  
$ch = curl_init($url3.$picture);

$f1 = fopen($picture, 'w+');

curl_setopt($ch, CURLOPT_FILE, $f1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($f1);
}

$query3 = "UPDATE person SET img='".$c2."' where link='".$line['link']."';";
$result1 = pg_query($query3) or die('Request mistake: ' . pg_last_error());
pg_free_result($result1);
}
}


pg_close($dbconn);
header('Location: dictionary.html');
?>