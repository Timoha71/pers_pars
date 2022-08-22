

var table1=document.getElementById('t1');
var a = table1.rows.length;
var i = 0;
console.log(document.getElementById("f0").innerHTML);
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
