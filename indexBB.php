<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Super Tumblr Search</title>
<?php
/*
<script language="Javascript">
  function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}
function getquerystring() {
    var form     = document.forms['f1'];
    var word = form.word.value;
    qstr = 'w=' + escape(word);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    document.getElementById("result").innerHTML = str;
}
</script>
*/
?>
	<meta name="author" content="Sameen, Jesse, Mark">
	<meta name="description" content="A Hack for PennApps">
	<meta name="keywords" content="Tumblr, PennApps, software, developer, web, HTML, CSS, PHP, JavaScript, programming, programmer, student, Rutgers, SEO">

	<link rel="canonical" href="http://goneill.net/www.goneill.net">

	<link rel="shortcut icon" href="http://goneill.net/img/favicon.ico">
	
	<link rel="stylesheet" type="text/css" href="home_files/reset.css">
	<link rel="stylesheet" type="text/css" href="home_files/styles.css">
	
	<script src="search.js"></script>
	
	<!--[if lt IE 9]>
		<script src="js/html5-ie.js"></script>
	<![endif]-->
	
</head>
<body>

<h1><a href="http://sameenjalal.com/Tumbling/pennapps/Tumbling/"><center>Super Tumblr Search</center></a></h1>
<center>
  <form>
    <input type="text" name="search" id="search" onchange="searchUser(this.value)">
  </form>
  <div id="searchresult" name="searchresult"> Search results ...</div>
</center>
</body></html>
