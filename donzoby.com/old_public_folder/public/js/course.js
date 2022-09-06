$(document).ready(function() {
 //$('#lga').select2();
//$("#course").select2();
  $("#course").bind('click', function(){            
         var course = $(this).val(); //alert(course);
		

switch (course) {
  case "web design":
  var data = ['HTML', 'CSS', 'JavaScript', 'jQuery', 'Bootstrap']; 
   break;
 
 case "web dev":
  var data = ['PHP', 'SQL', 'MySql', 'Laravel'];
   break;
    case "mobile app dev":
  var data = ['Andoid Kotlin','Andoid Java', 'iOS Swift'];
   break;
   case "windows dev":
  var data = ['C# (C-Sharp)', 'Java'];
   break;
   
   case "MS Office":
  var data = ['MS Word', 'MS PowerPoint', 'MS Excel', 'MS Access'];
   break;
    case "office operations":
  var data = ['Paper Work', 'Machine Operations'];

   break;
   
   case "internet usage":
  var data = ['Online Services','Browsers', 'Miscellaneous'];

   break;
   case "mobile usage":
  var data = ['Andoid Phones', 'iPhones', 'Service Providers', 'Hardware', 'Apps'];

   break;
   case "graphics":
  var data =  ['CorelDraw', 'Photoshop', 'Gimp'];

 }
	
	


var i;
var html = [];
//loop through the array
for (var i = 0; i < data.length; i++) {//begin for loop

  //add the option elements to the html array
  html.push("<option>" + data[i] + "</option>")

}//end for loop

//add the option values to the select list with an id of lga
document.getElementById("subject").innerHTML = html.join('');
});

});