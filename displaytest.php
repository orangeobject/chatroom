<!DOCTYPE html>
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="refresh" content="5;url=displaytest.php"> 
<title>Display Messages</title> 
<script type="text/javascript" src="ajax.js"> </script> 
<script type="text/javascript">
	function getspeak(){
		
		request.open("GET","./speaking.php?words=test&nick=dq",true);
		request.send(null);
}
</script>
<script type="text/javascript">
	createRequest();
	function getId(){
		msg=document.getElementById("1234").value;
		alert(msg);
}
	function updatePage() {
			if (request.readyState == 4) {
			document.getElementById("1123").innerHTML = request.responseText;
		}
	}
</script>
</head>
<body> 
	<input Id="1234">
	<button onClick="getId();"></button>
	<button onClick="getspeak();">say</botton>
	<button onClick="getdisplaytest();" >get</button>
	<form action="speak.php" method="post" target="_self">
	<input type="button" onclick="location.href='http://10.17.23.222/mylog'"value="datebase" target="_self">
<?php 
//connect to mysql server, server name: main, database username: root 
$link_ID=mysql_connect('localhost',"root","116center"); 
mysql_select_db("chat"); //abc is the database name 
$str="select * from chat ORDER BY chtime DESC;" ;
$result=mysql_query($str, $link_ID);
$rows=mysql_num_rows($result); 
//get the latest 15 messages 
@mysql_data_seek($resut,$rows-15); 
//if the number of messages<15, get all of the messages 
if ($rows<15) $l=$rows; else $l=15; for ($i=1;$i<=$l; $i++) { 
list($chtime, $nick, $words)=mysql_fetch_row($result); 
 echo " "; echo $nick; echo":" ; echo $words; echo $chtime; echo"<br> 
"; 
} //delete the old messages(only keep the newest 20 only) 
@mysql_data_seek($result,$rows-20);
list($limtime)=mysql_fetch_row($result); 
$str="DELETE FROM chat WHERE chtime<'$limtime' ;" ; 
$result=mysql_query($str,$link_ID);
mysql_close($link_ID); 
?> 
</body> 
</html>
