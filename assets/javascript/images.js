window.onload = function() {gallery()};
/*Calling AJAX to load all videos*/
function gallery () {  
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
			// successfuly received response
			var data = JSON.parse(this.responseText);

			var output = document.createElement('div');
			output.className = "posters";
			output.innerHTML = "";
			// Get the current page:
			var currentPage = document.getElementById('anchor2').innerHTML;
			var currentPageValue = currentPage.valueOf() - 1;
			// Set posts counter:
			var countPosts = 0;
			
			for (var index=currentPageValue; index < data.length; index++) {
				
				var posts = data[index];

					/*Don't allow more tan 10 posts on single page:*/
					countPosts++;
					if (countPosts > 10) {
						break;
					}
					
					// get the category of the posts:
					var cat;
					var categs = new Array("balkan", "engHum", "memes", "awkward", "blackHum");
					var categsFullNames = new Array("Balkan Humour", "English Humour", "Memes", "Awkward", "Dark Humour");
					// get the session of the user:
					var userSession = document.getElementById('anchor').innerHTML;
					
					for (var cats = 0; cats < categs.length; cats++) {
						if (posts.category == categs[cats]) {
							cat = categsFullNames[cats];
						}
					}
					
					var poster = document.createElement('div');
					poster.className = "poster"+posts.category;
					poster.id = "poster_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
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
					
					var posterSubTitle2 = document.createElement('h6');
					posterSubTitle2.className = "posterSubTitle2";
					posterSubTitle2.innerHTML = "Uploaded by: "+posts.username;
					poster.appendChild(posterSubTitle2);
					
					var posterContainer = document.createElement('div');
					posterContainer.className = "posterContainer";
					posterContainer.innerHTML = "";
					poster.appendChild(posterContainer);
					
					var posterContent = document.createElement('img');
					posterContent.className = "posterGraphic";
					posterContent.src = "./users/"+posts.username+"/upload/"+posts.category+"/"+posts.fileName;
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
					like.id = "like1_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
					like.innerHTML = "Like";
					posterLike.appendChild(like);
					
					var countLikes = document.createElement('p');
					countLikes.className = "countLikes";
					countLikes.id = "like2_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
					countLikes.innerHTML = posts.likes;
					countLikes.style.display = "inline-block";
					posterLike.appendChild(countLikes);
					
					var dislike = document.createElement('button');
					dislike.className = "dislike";
					dislike.id = "dislike1_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
					dislike.innerHTML = "dislike";
					posterDislike.appendChild(dislike);
					
					var countDislikes = document.createElement('p');
					countDislikes.className = "countDislikes";
					countDislikes.id = "dislike2_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
					countDislikes.innerHTML = posts.dislikes;
					countDislikes.style.display = "inline-block";
					posterDislike.appendChild(countDislikes);
					
					var warnings = document.createElement('p');
					warnings.className = "warnUsers";
					warnings.id = "warn_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
					warnings.innerHTML = "";
					warnings.style.color = "#2a2d2d";
					posterReactions.appendChild(warnings);
					
					var link = document.createElement('a');
					link.className = "reactionsLink";
					link.innerHTML = "SEE HOW PEOPLE REACT TO THIS POST";
					link.href = "?page=post&post="+posts.title+"  "+posts.fileExtension+"  "+posts.category+"  "+posts.username;
					link.style.color = "#2a2d2d";
					posterReactions.appendChild(link);
					
					if (userSession == posts.username || userSession == "TheCheerer") {
						var deletePost = document.createElement('button');
						deletePost.className = "deletePost";
						deletePost.id = "delete_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
						if (userSession == posts.username) {
							deletePost.innerHTML = "Click here if you want to delete your post.";
						} else {
							deletePost.innerHTML = "Click here if you want to delete this user's post.";
						}
						poster.appendChild(deletePost);
						
						var deleteDiv = document.createElement('div');
						deleteDiv.className = "deleteContainer";
						deleteDiv.id = "deleteDiv_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
						deleteDiv.style.display = 'none';
						poster.appendChild(deleteDiv);
						
						var deleteAreYouSure = document.createElement('p');
						deleteAreYouSure.className = "deleteSure";
						deleteAreYouSure.innerHTML = "Are you sure you want to delete this post?";
						deleteAreYouSure.style.color = "#2a2d2d";
						deleteDiv.appendChild(deleteAreYouSure);
						
						var deleteButDiv = document.createElement('div');
						deleteButDiv.className = "delButContain";
						deleteDiv.appendChild(deleteButDiv);
						
						var deleteIt = document.createElement('button');
						deleteIt.className = "deleteIt";
						deleteIt.id = "deleteIt_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
						deleteIt.innerHTML = "Yes";
						deleteButDiv.appendChild(deleteIt);
						
						var dontDeleteIt = document.createElement('button');
						dontDeleteIt.className = "dontDeleteIt";
						dontDeleteIt.id = "dont_"+posts.title+"_"+posts.fileExtension+"_"+posts.category+"_"+posts.username;
						dontDeleteIt.innerHTML = "No!";
						deleteButDiv.appendChild(dontDeleteIt);
					}
				
			}
			var result = document.getElementById('result');
			result.appendChild(output);
			
			
		}
		
		/*Calling AJAX to set properly work of Like buttons*/
		var likeButtons = document.getElementsByClassName('like');
		var dislikeButtons = document.getElementsByClassName('dislike');
		function reactToIt (event) {
			
			if(typeof XMLHttpRequest !== 'undefined') xhttp2 = new XMLHttpRequest();
			else {
			   var versions = ["MSXML2.XmlHttp.5.0", 
						        "MSXML2.XmlHttp.4.0",
						        "MSXML2.XmlHttp.3.0", 
						        "MSXML2.XmlHttp.2.0",
						        "Microsoft.XmlHttp"]
			
			for(var i = 0; i < versions.length; i++) {
			   try {
			       xhttp2 = new ActiveXObject(versions[i]);
			       break;
			   }
			   catch(e){}
			} // end for
			}
			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					// successfuly received response
					// Clear warnings:
					var cleanWarnings = document.getElementsByClassName('warnUsers');
					for (var w = 0; w < cleanWarnings.length; w++) {
						cleanWarnings[w].innerHTML = "";
					}
					//get the respone:
					var data2 = this.responseText;
					console.log(data2);
					//Button's id:
					var e = event;
					var currents = e.target;
					var reactButId = currents.id;
					// count likes paragraph id and accessing the paragraph:
					var likeParId = reactButId.replace("like1_", "like2_");
					var likePar = document.getElementById(likeParId);
					// get the count likes paragraph inner HTML and prepare to change it:
					var likeParString = likePar.innerHTML;
					var newLikePar = likeParString.valueOf();
					if (data2 == "cookie set") {
						//increase likes by one
						newLikePar++;
					}
					if (data2 == "cookie unset" || data2 == "clearedCache") {
						//decrease likes by one
						if (newLikePar.value == 0) {
							newLikePar;
						} else {
							newLikePar--;
						}
					}
					if (data2 == "Please, log in if you want to react to the posts of this site!" ||
							data2 == "You cannot simultaneosly like and dislike a post!") {
						newLikePar;
						//message that you have to logi in:
						if (reactButId.substr(0, 1) == "l") {
							var warningToLog = reactButId.replace("like1_", "warn_");
						} else {
							var warningToLog = reactButId.replace("dislike1_", "warn_");
						}
						var warningToLogResult = document.getElementById(warningToLog);
						warningToLogResult.innerHTML = data2;
					}
					likePar.innerHTML = newLikePar;
				
				}
			}
			
			xhttp2.open("POST","./LikeService.php",true);
			xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp2.send("tit="+event.currentTarget.id);
		}
		
		for (var v = 0; v < likeButtons.length; v++) {
			likeButtons[v].addEventListener('click', reactToIt, false);
			dislikeButtons[v].addEventListener('click', reactToIt, false);
		} 
		/*End of AJAX call for proper work of Like buttons*/
		
		/*Warning when you click on delete button*/
		var deletion = document.getElementsByClassName('deletePost');
		
		function doYouWantItDeleted (event) {
			var it = event.currentTarget.id;
			var itsDivId = it.replace("delete_", "deleteDiv_");
			var itsDiv = document.getElementById(itsDivId);
			itsDiv.style.display = 'block';
		}
		
		for (var d = 0; d < deletion.length; d++) {
			deletion[d].addEventListener('click', doYouWantItDeleted, false);
		}
		//What happens if you click 'NO!':
		var rejectDeletion = document.getElementsByClassName('dontDeleteIt');
		
		for (var ind = 0; ind < rejectDeletion.length; ind++) {
			rejectDeletion[ind].onclick = function() {refuseToDeleteIt(this)};
		}
		function refuseToDeleteIt(e) {
		    var deleteDiv = document.getElementsByClassName('deleteContainer');
		    for (var i = 0; i < deleteDiv.length; i++) {
		    	deleteDiv[i].style.display = 'none';
		    }
		}
		// Calling AJAX when you click Yes:
		var deleteIt = document.getElementsByClassName('deleteIt');
		
		for (var ind = 0; ind < deleteIt.length; ind++) {
			deleteIt[ind].onclick = function() {deleteThisPost(this.id)};
		}
		function deleteThisPost(e) {
			if(typeof XMLHttpRequest !== 'undefined') xhttp2 = new XMLHttpRequest();
			else {
			   var versions = ["MSXML2.XmlHttp.5.0", 
						        "MSXML2.XmlHttp.4.0",
						        "MSXML2.XmlHttp.3.0", 
						        "MSXML2.XmlHttp.2.0",
						        "Microsoft.XmlHttp"]
			
			for(var i = 0; i < versions.length; i++) {
			   try {
			       xhttp2 = new ActiveXObject(versions[i]);
			       break;
			   }
			   catch(e){}
			} // end for
			}
			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					// successfuly received response
					
					var clickedId = e;
					var delPosterId = clickedId.replace("deleteIt", "poster");
					
					var delThisPoster = document.getElementById(delPosterId);
					delThisPoster.style.display = 'none';
					// reolad the page to re-order the paging:
					window.location.reload(true);
				}
			}
			
			xhttp2.open("POST","./DeleteService.php",true);
			xhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp2.send("del="+e);
		}
	}
	
	xhttp.open("POST","./videosService.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("type=images");	
}
/*End of AJAX call for loading allvideos*/

/*Setting a function for show/hide videos by category*/
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
	
	var cs = new Array(c1,c2,c3,c4,c5);
	var cIds = new Array("balkan", "engHum", "memes", "awkward", "blackHum");
	
	for (var j = 0; j <= 4; j++) {
		var cNth;
		var cId;
		
		cNth = cs[j];
		cId = cIds[j];
		
		if (cNth.length > 0) {
			if (document.getElementById(cId).checked == true) {
				for (var i=0;i<cNth.length;i++){
					cNth[i].style.display = 'block';
				}
		    }
		    if (document.getElementById(cId).checked == false) {
		    	for (var i=0;i<cNth.length;i++){
					cNth[i].style.display = 'none';
				}
		    }
		}
	}
}
/*End of function show/hide category*/