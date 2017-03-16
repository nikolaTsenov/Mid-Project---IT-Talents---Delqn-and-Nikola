document.getElementById('but').onclick = function () {
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
					var poster = document.createElement('div');
					poster.className = "poster";
					poster.width = "100%";
					poster.height = "auto";
					output.appendChild(poster);
					
					var posterTitle = document.createElement('h4');
					posterTitle.className = "posterTitle";
					posterTitle.innerHTML = posts.title;
					poster.appendChild(posterTitle);
					
					var posterContainer = document.createElement('div');
					posterContainer.className = "posterContainer";
					posterContainer.innerHTML = "";
					poster.appendChild(posterContainer);
					
//					var posterContent = document.createElement('img');
//					posterContent.src = "./users/"+posts.username+"/upload/"+posts.category+"/"+posts.fileName;
//					posterContent.className = "posterGraphic";
//					posterContent.alt = posts.title;
//					posterContainer.appendChild(posterContent);
					
					var posterContent = document.createElement('video');
					posterContent.className = "posterGraphic";
					posterContent.src = "./users/"+posts.username+"/upload/"+posts.category+"/"+posts.fileName;
					posterContent.controls = true;
					posterContainer.appendChild(posterContent);
// nadolu ne raboti			
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
					posterLike.appendChild(like);
					
					var dislike = document.createElement('button');
					dislike.className = "dislike";
					posterDislike.appendChild(dislike);
					
					var imgLike = document.createElement('img');
					imgLike.src = "./assets/images/galleryImages/like.png";
					imgLike.className = "imageLike";
					imgLike.alt = "like";
					like.appendChild(imgLike);
					
					var imgDislike = document.createElement('img');
					imgDislike.src = "./assets/images/galleryImages/dislike.png";
					imgDislike.className = "imageDislike";
					imgDislike.alt = "dislike";
					dislike.appendChild(imgDislike);
//do tuk
				}
			}
			
			var result = document.getElementById('result');
			result.appendChild(output);
		}
	}
	
	xhttp.open("GET","./videosService.php",true);
	
	xhttp.send(null);	
}

//<div class="poster">
	//<h4 class="posterTitle"></h4>
	//<div class="posterContainer">
	//	<img src="" alt="" />
	//</div>
	//<div class="posterReactions">
	//	<div class="like">
	//		<a href=""><img src="" alt="" /></a>
	//	</div>
	//	<div class="dislike">
	//		<a href=""><img src="" alt="" /></a>
	//	</div>
	//</div>
	//<div class="comments"></div> 
//</div>