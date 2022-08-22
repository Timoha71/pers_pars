<?php

$dbconn = pg_connect("host=localhost dbname=tt user=postgres password=1")
    or die('Could not connect: ' . pg_last_error());


$query = 'SELECT * FROM person';
$result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<pers>';



while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    
        //echo "\t\t<td>$col_value</td>\n";

			    // echo "Pic: <img src='".$line['img']."'><br>";
			 echo '<per><fio>'.$line['fio_tag'].'</fio><info>'.$line['fio_class'].'</info><pic>'.$line['fio_id'].'</pic></per>';
    
	}
    



pg_free_result($result);
echo '</pers>';

pg_close($dbconn);
?> 
