<!DOCTYPE html>
<html lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Display Messages</title> 
<script type="text/javascript" src="ajax.js"> </script> 
<script type="text/javascript">
	createRequest();
	function GetCookie( name ) { // Cookieの値を取得するための関数
		var result = null;
		var cookieName = name + '=';
		var allcookies = document.cookie;
		var position = allcookies.indexOf( cookieName );
		if( position != -1 ){
			var startIndex = position + cookieName.length;
			var endIndex = allcookies.indexOf( ';', startIndex );
			if( endIndex == -1 ){
				endIndex = allcookies.length;
			}
			result = decodeURIComponent(
			allcookies.substring( startIndex, endIndex ) );
		}
	return result;
	}
	
	function getspeak(){
		// input 値の取得
		words = document.getElementById("1234").value;
		// CookieからNickの値を取得
		nick  = GetCookie("nick");
		
		request.open("GET","./speaking.php?words=" + words + "&nick=" + nick,true);
		request.onreadystatechange = RefreshPage;
		request.send(null);
		// 入力文字の初期化
		document.getElementById("1234").value = "";
		
	}
	
	function RefreshPage() {
		if (request.readyState == 4) {
			getdisplay;
		}
		//code
		
	}
	
	function getdisplay(){
		request.open("GET","./display.php",true);
		request.onreadystatechange = updatePage;
		request.send(null);
			}
	
	function getId(){
		msg=document.getElementById("1234").value;
		alert(document.cookie);
		alert(msg);
	}
	function updatePage() {
			if (request.readyState == 4) {
			document.getElementById("1123").innerHTML = request.responseText;
		}
	}
</script>
</head>
<body onLoad="setInterval(getdisplay,5000);"> 
	
	<input Id="1234">
	<button onClick="getspeak();getdisplay();">say</botton>
	<button onClick="getdisplay();" >get</button>
		
<DIV ID="1123">
</DIV>
</body> 
</html>
