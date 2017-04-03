function deleteThisComment (id) {
	
	if(typeof XMLHttpRequest !== 'undefined') xhttp = new XMLHttpRequest();
	else {
	   var versions = ["MSXML2.XmlHttp.5.0", 
				        "MSXML2.XmlHttp.4.0",
				        "MSXML2.XmlHttp.3.0", 
				        "MSXML2.XmlHttp.2.0",
				        "Microsoft.XmlHttp"]
	
	for(var i = 0; i < versions.length; i++) {
	   try {
	       xhttp = new ActiveXObject(versions[i]);
	       break;
	   }
	   catch(e){}
	} // end for
	}
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = this.responseText;
			console.log(response);
			var buttonId = id;
			var comDivId = buttonId.replace(/[_]/g,'+');
			
			var comDiv = document.getElementById(comDivId);
			
			comDiv.style.display = 'none';
		}
	}
	xhttp.open("POST","./delComService.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("delete="+id);
}