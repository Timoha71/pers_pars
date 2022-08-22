
<?php
include('simple_html_dom.php');
$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
    or die('Ошибка подключения: ' . pg_last_error());
	
date_default_timezone_set('Europe/Moscow');
$html = new simple_html_dom();
Header('Content-type: text/xml');

echo '<persons>';

$query = 'SELECT * FROM person;';
$result = pg_query($query) or die('Request mistake(ошибка запроса): ' . pg_last_error());

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) 
{
$url=$line['link'];

$html = file_get_html($url);
//echo $html;
/*foreach($html->find('"'.$line["fio_tag"].'"') as $text){ 
echo $text;
foreach($text->find('"'.$line["fio_class"].'"') as $text2){
echo $text2;
}}*/
//echo '"'.$line['fio_tag'].'"';

if ($line['fio_class']=='')
{$a1 = $line['fio_tag'];}
else {$a1 = $line['fio_tag']."[class=".$line['fio_class']."]";}

if ($line['rank_class']=='')
{$b1 = $line['rank_tag'];}
else {$b1 = $line['rank_tag']."[class=".$line['rank_class']."]";}

foreach($html->find($a1) as $text) {
$a = $text->plaintext;
echo '<person><fio>'.$a.'</fio>';
}
foreach($html->find($b1) as $text) {
$b = $text->plaintext;
echo '<rank>'.$b.'</rank></person>';
}

}
echo '</persons>';

pg_free_result($result);
pg_close($dbconn);
?>

