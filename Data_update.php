
<?php
include('simple_html_dom.php');
$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
    or die('Ошибка подключения: ' . pg_last_error());
	
date_default_timezone_set('Europe/Moscow');



$query = 'SELECT * FROM person;';
$result = pg_query($query) or die('Request mistake(ошибка запроса): ' . pg_last_error());
echo '<table class="table_css">';
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{
$url=$line['link'];
$html = new simple_html_dom();
$html = file_get_html($url);
//echo $html;
/*foreach($html->find('"'.$line["fio_tag"].'"') as $text){ 
echo $text;
foreach($text->find('"'.$line["fio_class"].'"') as $text2){
echo $text2;
}}*/
//echo '"'.$line['fio_tag'].'"';


foreach($html->find($line['fio_tag']."[class=".$line['fio_class']."]") as $text) {
$a = $text->plaintext;

}
foreach($html->find($line['rank_tag']."[class=".$line['rank_class']."]") as $text) {
$b = $text->plaintext;

}
$p = "'";
$query2 = 'SELECT fio FROM person where link='.$p.$line["link"].$p.';';
$result2 = pg_query($query2) or die('Request mistake(ошибка запроса): ' . pg_last_error());
$line2 = pg_fetch_array($result2, null, PGSQL_ASSOC);
 if ($line2['fio']==$a)
 {
echo '<tr class="tr_css"><td><b><a >'.$line["fio"].'</a></b></td>
<td>'.$line["rank_name"].'</td></tr>';
 }
else {echo '<tr class="tr_css"><td><b><a class="no_decor" >'.$a.'</a></b></td>
<td>'.$b.'</td></tr>';} 

}
echo '</table>';
pg_free_result($result);
pg_close($dbconn);
?>

