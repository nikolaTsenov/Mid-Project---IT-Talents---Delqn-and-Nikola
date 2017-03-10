var postData = {
 name: 'gosho',
 pass: 'pesho',
 repass: 'pesho',
};


$.ajax({
  type: "POST",
  url: './ajax.php',
  data: postData,
  success: function (response) {
  
  }
});