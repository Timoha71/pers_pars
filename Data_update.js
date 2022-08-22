

function startAjax(){

  var request; 
  if(window.XMLHttpRequest){ 
      request = new XMLHttpRequest(); 
  } else if(window.ActiveXObject){ 
      request = new ActiveXObject("Microsoft.XMLHTTP");  
  } else { 
      return; 
  } 
  request.overrideMimeType("text/xml");  	
  request.onreadystatechange = function(){
		switch (request.readyState) {
		  case 1: break
		  case 2: break
		  case 3: break
		  case 4:{
		   if(request.status==200){		
	   
				var xmlDoc = request.responseXML;
				var table="<table class='table2_css' id='t2'><caption class='capt'>Данные на web-ресурсах</caption> <tr><th class='th_css'>ФИО   </th><th class='th_css'>Должность</th></tr>";				
				var persons = xmlDoc.getElementsByTagName("person");
				document.getElementById("Print1").innerHTML = persons.length;
				
				    for (i = 0; i <persons.length; i++) 
					{ 
					
				    table += "<tr><td class='td2_css' id='ff"+i.toString()+"'>" 
					+persons[i].getElementsByTagName("fio")[0].childNodes[0].nodeValue+"</td>";
					table +="<td class='td2_css' id='rr"+i.toString()+"'>" +persons[i].getElementsByTagName("rank")[0].childNodes[0].nodeValue +"</td></tr>";	
				     }
				  table +="</table>";
				  
				  document.getElementById("Print1").innerHTML = table;			
				
			  
					}else if(request.status==404){
						alert("Ошибка: запрашиваемый скрипт не найден!");
					 }
					  else alert("Ошибка: сервер вернул статус: "+ request.status);
		   
			break
			}
		}		
    } 
    request.open ('GET', 'Data_update2.php', true); 
    request.send (null); 
	
	
var table=document.getElementById('t1');
var a = table.rows.length;
var i = 0;

for (var i=0; i<=a-1; i++)
{
if (document.getElementById(("f" + i).toString()).innerHTML!=document.getElementById(("ff" + i)).toString().innerHTML || 
document.getElementById(("r" + i).toString()).innerHTML!=document.getElementById(("rr" + i).toString()).innerHTML)
{

document.getElementById(("f" + i).toString()).style.background="green";
document.getElementById(("ff" + i).toString()).style.background="green";
document.getElementById(("r" + i).toString()).style.background="green";
document.getElementById(("rr" + i).toString()).style.background="green";
}

}
  } 
 
