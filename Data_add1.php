<?php


$s = 'http://localhost:71/Mayor.htm';
$s1 = strrev($s);
$s2 = strpbrk($s1, '/');
$s3 = strrev($s2);
$s4 = $s3."guber_files";
echo $s1;
echo "<br>";
echo $s2;
echo "<br>";
echo $s3;
echo "<br>";echo $s4;
?>

