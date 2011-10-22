/* ---------------------------- */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
function createObject() {
   var request_type;
   var browser = navigator.appName;
   if(browser == "Microsoft Internet Explorer"){
      request_type = new ActiveXObject("Microsoft.XMLHTTP");
   } else {
      request_type = new XMLHttpRequest();
   }
   return request_type;
}

var http = createObject();


/*Write tokenized array to file*/
function write2File()
{
   searchq = encodeURI(document.getElementById('searchq').value);
   document.getElementById('msg').style.display = "block";
   document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"";
// Set te random number to add to URL request
   nocache = Math.random();
   http.open('get', 'in-search.php?name='+searchq+'&nocache = '+nocache);
   http.onreadystatechange = searchNameqReply;
   http.send(null);
}



function showUser(str)
{
   console.log(str);
   if (str=="")
   {
      $("#txtHint").value="";
      return;
   } 
   if (window.XMLHttpRequest)
   {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
   }
   else
   {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   xmlhttp.onreadystatechange=function()
      {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
         {
            document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
         }
      }
   xmlhttp.open("GET","processing.php?q="+str,true);
   xmlhttp.send();
}
/* -------------------------- */
/* SEARCH */
/* -------------------------- */
function searchNameqB() {
   var qArray;
   
   searchq = encodeURI(document.getElementById('searchq').value);
   document.getElementById('msg').style.display = "block";
//   document.getElementById('msg').innerHTML = "Searching for <strong>" + searchq+"";
// Set te random number to add to URL request
//   nocache = Math.random();
//   http.open('get', 'in-search.php?name='+searchq+'&nocache = '+nocache);
//   http.onreadystatechange = searchNameqReply;
   // http.send(null);
   qArray=searchq.split("%20");
   document.getElementById('msg').innerHTML = "Searching for array: <strong>" + qArray+"";
   
   if (window.XMLHttpRequest)
   {
      xmlhttp=new XMLHttpRequest();
   }
   else
   {
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
   
   console.log(qArray);
   fanF(qArray, "for");
   fanF(qArray, "and");
   fanF(qArray, "nor");
   fanF(qArray, "but");
   fanF(qArray, "or");
   fanF(qArray, "yet");
   fanF(qArray, "so");
   fanF(qArray, "the");
   fanF(qArray, "a");
   fanF(qArray, "on");
   fanF(qArray, "to");
   fanF(qArray, "of");
   
   xmlhttp.open("GET","processing.php?q="+searchq,true);
   xmlhttp.send();
}
function searchNameqReply() {
   if(http.readyState == 4){
      var response = http.responseText;
      document.getElementById('search-result').innerHTML = response;
   }
}

/* Filters fanboy words */
function fanF(arrayName, element)
{
   for(var i=0; i<arrayName.length;i++ )
   { 
      if(arrayName[i]==element)
      {
	 arrayName.splice(i,1); 
	 i--;
      }
   } 
}


