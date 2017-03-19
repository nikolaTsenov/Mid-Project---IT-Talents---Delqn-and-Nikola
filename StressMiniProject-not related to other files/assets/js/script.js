function deleteUser(str) {
    if (str == "") {
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	var a = str;
            	var classes = document.getElementsByClassName(a);
                for (var i = 0; i < classes.length; i++) {
                	classes[i].style.display = "none";
                }
            }
        };
        xmlhttp.open("GET","deleteService.php?q="+str,true);
        xmlhttp.send();
    }
}
