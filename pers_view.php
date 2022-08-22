
<?php
echo '<?xml version="1.0" encoding="utf-8"?>';
$dbconn = pg_connect("host=localhost dbname=postgres user=postgres password=1")
    or die('Could not connect: ' . pg_last_error());


$query = 'SELECT *  FROM person';
$result = pg_query($query) or die('ошибка запроса: ' . pg_last_error());


echo '<perss>';


while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
echo '<pers><fio>'.$line["fio"].'</fio><rank>'.$line["rank_name"].'</rank></pers>';

}

echo '</perss>';

?>

