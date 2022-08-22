
<?php
  $proxy = '10.0.0.1:3128';

$context = array( 
   'http' => array( 
      'proxy' => $proxy,
      'request_fulluri' => true, 
    ), 
);	
stream_context_set_default(['http'=>['proxy'=>'10.0.0.1:3128']]);		
$stream = stream_context_create($context);

  
  $link = "https://www.mos.ru/mayor/biography/";
  $file = file_get_contents($link);
  file_put_contents("/123", $file);
?>

