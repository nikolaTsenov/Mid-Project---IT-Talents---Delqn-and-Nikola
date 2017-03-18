window.onload = function() {gallery()};

function gallery () {  
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// successfuly received response
			var data = JSON.parse(this.responseText);

			var output = document.createElement('div');
			output.className = "posters";
			output.innerHTML = "";
			
			for (var index=0; index < data.length; index++) {
				var posts = data[index];
				if (posts.fileExtension == "mp4") {
					
					var cat;
					
					if (posts.category == "balkan") {
						cat = "Balkan Humour";
					}
					if (posts.category == "engHum") {
						cat = "English Humour";
					}
					if (posts.category == "memes") {
						cat = "Memes";
					}
					if (posts.category == "awkaward") {
						cat = "Awkward";
					}
					if (posts.category == "blackHum") {
						cat = "Dark Humour";
					}
					
					var poster = document.createElement('div');
					poster.className = "poster"+posts.category;
					poster.style.width = "98.5%";
					poster.style.height = "auto";
					poster.style.margin = "0 auto";
					poster.style.marginBottom = "1em";
					poster.style.paddingBottom = "1em";
					poster.style.borderBottom = "thin solid #FFFAF0";
					output.appendChild(poster);
					
					var posterTitle = document.createElement('h4');
					posterTitle.className = "posterTitle";
					posterTitle.innerHTML = posts.title;
					poster.appendChild(posterTitle);
					
					var posterSubTitle = document.createElement('h6');
					posterSubTitle.className = "posterSubTitle";
					posterSubTitle.innerHTML = "Category: "+cat;
					poster.appendChild(posterSubTitle);
					
					var posterContainer = document.createElement('div');
					posterContainer.className = "posterContainer";
					posterContainer.innerHTML = "";
					poster.appendChild(posterContainer);
					
					var posterContent = document.createElement('video');
					posterContent.className = "posterGraphic";
					posterContent.src = "./users/"+posts.username+"/upload/"+posts.category+"/"+posts.fileName;
					posterContent.controls = true;
					posterContainer.appendChild(posterContent);	
		
					var posterReactions = document.createElement('div');
					posterReactions.className = "posterReactions";
					poster.appendChild(posterReactions);
					
					var posterLike = document.createElement('div');
					posterLike.className = "posterLike";
					posterReactions.appendChild(posterLike);
					
					var posterDislike = document.createElement('div');
					posterDislike.className = "posterDislike";
					posterReactions.appendChild(posterDislike);
					
					var like = document.createElement('button');
					like.className = "like";
					like.innerHTML = "<i class='fa fa-thumbs-up' aria-hidden='true'></i>";
					posterLike.appendChild(like);
					
					var countLikes = document.createElement('p');
					countLikes.className = "countLikes";
					countLikes.innerHTML = "0";
					countLikes.style.display = "inline-block";
					posterLike.appendChild(countLikes);
					
					var dislike = document.createElement('button');
					dislike.className = "dislike";
					dislike.innerHTML = "<i class='fa fa-thumbs-down' aria-hidden='true'></i>";
					posterDislike.appendChild(dislike);
					
					var countDislikes = document.createElement('p');
					countDislikes.className = "countDislikes";
					countDislikes.innerHTML = "0";
					countDislikes.style.display = "inline-block";
					posterDislike.appendChild(countDislikes);

				}
			}
			var result = document.getElementById('result');
			result.appendChild(output);
		}
	}
	
	xhttp.open("POST","./videosService.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();	
}

var category = document.getElementsByClassName('category');
for (var c=0;c<category.length;c++) {
	category[c].onchange = function() {categoryChange()};
}

function categoryChange() {
	
	var c1 = document.getElementsByClassName('posterbalkan');
	var c2 = document.getElementsByClassName('posterengHum');
	var c3 = document.getElementsByClassName('postermemes');
	var c4 = document.getElementsByClassName('posterawkward');
	var c5 = document.getElementsByClassName('posterblackHum');
	if (c1.length > 0) {
		if (document.getElementById('balkan').checked == true) {
			for (var i=0;i<c1.length;i++){
				c1[i].style.display = 'block';
			}
	    }
	    if (document.getElementById('balkan').checked == false) {
	    	for (var i=0;i<c1.length;i++){
				c1[i].style.display = 'none';
			}
	    }
	}
	if (c2.length > 0) {
	    if (document.getElementById('engHum').checked == true) {
			for (var i=0;i<c2.length;i++){
				c2[i].style.display = 'block';
			}
	    }
	    if (document.getElementById('engHum').checked == false) {
			for (var i=0;i<c2.length;i++){
				c2[i].style.display = 'none';
			}
	    }
	}
	if (c3.length > 0) {
	    if (document.getElementById('memes').checked == true) {
			for (var i=0;i<c3.length;i++){
				c3[i].style.display = 'block';
			}
	    }
	    if (document.getElementById('memes').checked == false) {
			for (var i=0;i<c3.length;i++){
				c3[i].style.display = 'none';
			}
	    }
	}
	if (c4.length > 0) {
	    if (document.getElementById('awkaward').checked == true) {
			for (var i=0;i<c4.length;i++){
				c4[i].style.display = 'block';
			}
	    }
	    if (document.getElementById('awkward').checked == false) {
			for (var i=0;i<c4.length;i++){
				c4[i].style.display = 'none';
			}
	    }
	}
	if (c5.length > 0) {
	    if (document.getElementById('blackHum').checked == true) {
			for (var i=0;i<c4.length;i++){
				c4[i].style.display = 'block';
			}
	    }
	    if (document.getElementById('blackHum').checked == false) {
			for (var i=0;i<c5.length;i++){
				c5[i].style.display = 'none';
			}
	    }
	}
}