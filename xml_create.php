
<?php
$p = "'";
include('simple_html_dom.php');
$fp = fopen('REPORT.xml', 'w');

fwrite($fp, '<?xml version="1.0" encoding="utf-8"?>');
fwrite($fp, '<persons>');
$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
    or die('Could not connect: ' . pg_last_error());
$query = 'SELECT *  FROM person';
$result = pg_query($query) or die('ошибка запроса: ' . pg_last_error());
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{
$str_img= str_get_html($line["img"]);

foreach($str_img->find('img') as $pic)
{
$pic1=$pic->src;
}

fwrite($fp, '<person>');	
fwrite($fp, '<fio>'.$line["fio"].'</fio>'."\n");
fwrite($fp, '<rank>'.$line["rank_name"].'</rank>'."\n");
fwrite($fp,  '<img>'.$pic1.'</img>'."\n");
fwrite($fp, '</person>');
}

fwrite($fp, '</persons>');
fclose($fp);
header('location: report.xml');

?>
