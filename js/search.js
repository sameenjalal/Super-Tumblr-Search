var xmlHttp
function searchUser(str)
{
   xmlHttp=GetXmlHttpObject()
      if (xmlHttp==null)
      {
	 alert ("Browser does not support HTTP Request")
	 return
      }
   var url="searchresult.php"
      url=url+"?q="+str
      url=url+"&sid="+Math.random()
      xmlHttp.onreadystatechange=stateChanged
      xmlHttp.open("GET",url,true)
      xmlHttp.send(null)
      }