<?php
$url=$_POST["url"];
 
echo  "$url";

/*

include('simple_html_dom.php');
$html = file_get_contents($url);
  
echo  "$html";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url); // ����� ������
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30); 
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17'); // ��� ������
curl_setopt($ch, CURLOPT_REFERER,$url); // �������� ������ ������
$result = curl_exec($ch);
curl_close($ch);
$fp = fopen ('/site/stranica.php', 'w+');
fwrite($fp, $html); // ���������� ������ ��� ��� ���������
fclose($fp);*/


//$url="http://lifeexample.ru/";//url ��������, � ������� ����� ���������� ��� ��������
function getContentPage($url){//������� ��� ��������� ��������� ���� ��������
    $c = curl_init($url);      
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    $text = curl_exec($c);
    curl_close($c);    
    return $text;
}
//�������������������� ������ ��������, � ������� ��� �������� � ����������� png � jpg
preg_match_all("'<img\s+src=\"(\S*.(png|jpg))\"'si",getContentPage($url),$result);     
foreach($result[1] as $name)
        {
            $row['image'][]=$name; copy($url.$name,$name); 
        }
$k=0;
//���������� ��� ��������� ��������, ������� ��� ��� ����������, � ��������� �����������
 /*while ($k<=(count($row['image'])-1))
 {
    $url=$row['image'][$k];
    $name= $row['image'][$k];
   // $name=str_replace("http://lifeexample.ru/","",$name);
    echo ($k+1).") 123: <b>".$name."</b><br/>";
    $dir="";
    $result1=explode("/", $name);          
       for($i=0 ; $i<=(count($result1)-2); $i++ )
                {      
                    if (!file_exists($dir.$result1[$i])){
                        mkdir($dir.$result1[$i], 0777);
                    }          
                    $dir.=$result1[$i]."/";
                }*/
             
    $k++;  
  
?>

