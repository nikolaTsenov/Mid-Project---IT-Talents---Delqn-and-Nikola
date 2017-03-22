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
var submitButton = document.getElementById("uploadSubmit");

titleUpload.onblur = function () {
	if (titleUpload.value.trim().length < 3) {
		uploadValidTitle = false;
		document.getElementById("appendTitleWarning").innerHTML = "Your title must consist of at least 3 characters!";
		submitButton.disabled = true;
	} else if(titleUpload.value.trim().length > 30) {
		uploadValidTitle = false;
		document.getElementById("appendTitleWarning").innerHTML = "Your title cannot consist of more than 30 characters!";
		submitButton.disabled = true;
	} else {
		uploadValidTitle = true;
		document.getElementById("appendTitleWarning").innerHTML = "";
		submitButton.disabled = false;
	}
	for (var i = 0; i < titleUpload.value.length; i++) {
		var checkItForSymbol = titleUpload.value.charAt(i);
		console.log(checkItForSymbol);
		if (checkItForSymbol == '#') {
			uploadValidTitle = false;
			document.getElementById("appendTitleWarning").innerHTML = "We are sorry! Your title cannot contain '#'!";
			submitButton.disabled = true;
		}
	}
}


titleUpload.onkeyup = function () {
	if (!uploadValidTitle) {
		document.getElementById("appendTitleWarning").innerHTML = "";
	}
	if (titleUpload.value.trim().length < 3) {
		submitButton.disabled = true;
	}
	if (titleUpload.value.trim().length >= 3) {
		submitButton.disabled = false;
	}
	if (titleUpload.value.trim().length > 30) {
		submitButton.disabled = false;
	}
}

/* submitButton.onclick = function checkFileSize () {
	var input, file;
	if (!window.FileReader) {
		return;
    }
	input = document.getElementById('fileUpload');
	if (!input) {
		document.getElementById("appendFileSizeWarning").innerHTML = "There is no file put for upload!";
	}
	else if (!input.files) {
		return;
    }
	else if (!input.files[0]) {
		document.getElementById("appendFileSizeWarning").innerHTML = "Please, select a file before clicking upload!";
    } 
	else {
        file = input.files[0];
        if (file.size > 8000000) {
        	document.getElementById("appendFileSizeWarning").innerHTML = "The maximum allowed file size is 8MB.";
        }
    } 
	
} */
