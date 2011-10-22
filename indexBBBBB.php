<html>
<head>

<LINK rel=stylesheet HREF="css/borders.css" TYPE="text/css">

<script language="javascript" src="./js/jquery-1.6.4.min.js">
</script>
<script>

function process()
{
	var words = $('#searchq').val();
	$.ajax({
		type: "POST",
		url:"wordProcess.php",
		data: {data: words},
		success: function(data) {
			dataParsed = $.parseJSON(data);
			//console.log(dataParsed);
			//$("posts").append(
			$('#posts').html("<ul id=\"lists\" ></ul>");
			for( i in dataParsed ) {
				it = dataParsed[i];
				//console.log(it);
				li="";
				if(it.type == "video" || it.type == "photo"){
					li = "<div class=\"post_box\"><li class=\"posts\">" + dataParsed[i].caption + "</li></div>";
				}
				else if(it.type == "text" || it.type == "quote" || it.type == "chat"){
					li = "<div class=\"post_box\"><li class=\"posts\">" + dataParsed[i].body + "</li></div>";
				}
				else if(it.type == "link"){
					li = "<div class=\"post_box\"><li class=\"posts\">" + dataParsed[i].title + "</li></div>";
				}
				else if(it.type == "audio"){
					li = "<div class=\"post_box\"><li class=\"posts\">" + dataParsed[i].id3_title + "</li></div>";
				}
				else if(it.type == "answer"){
					li = "<div class=\"post_box\"><li class=\"posts\">" + dataParsed[i].answer + "</li></div>";
				}
				else {
					console.log(it.type);
				}
				//console.log(li);
				//$('#lists').empty();
				$('#lists').append(li);
			}
		}
	});

}

</script>
<?php/*<body bgcolor="#001255 or #2c4762">*/ ?>
<body bgcolor="2c4762">
<div class="rbroundbox">
<div class="rbtop"><div></div></div>
<div class="rbcontent">

<h2>Tumblr Super Search!</h2>

<input name="searchq" type="text" id="searchq" />
<input type="submit" id="submitSearch" value="Search" onclick="javascript: process();" />

<h3>Search Results</h3>
<div id="msg">Type something into the input field</div>
<div id="search-result"></div>

</div>
<div class="rbbot"><div></div></div>
</div>
<div id="posts">
	<ul id="list">
	</ul>
</div>

</body>

</html>
