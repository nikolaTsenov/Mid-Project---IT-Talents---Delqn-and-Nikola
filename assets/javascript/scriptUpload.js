var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".mp4"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}

var titleUpload = document.getElementById("fileTitle");
var uploadValidTitle = true;
document.getElementById("uploadSubmit").disabled = true;
titleUpload.onblur = function () {
	if (titleUpload.value.trim().length < 3) {
		uploadValidTitle = false;
		document.getElementById("appendTitleWarning").innerHTML = "Your title must consist of at least 3 characters!";
	} else if(titleUpload.value.trim().length > 30) {
		uploadValidTitle = false;
		document.getElementById("appendTitleWarning").innerHTML = "Your title cannot consist of more than 30 characters!";
	} else {
		uploadValidTitle = true;
		document.getElementById("appendTitleWarning").innerHTML = "";
		document.getElementById("uploadSubmit").disabled = false;
	}
}

titleUpload.onkeypress = function () {
	if (!uploadValidTitle) {
		document.getElementById("appendTitleWarning").innerHTML = "";
	}
}

