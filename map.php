<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>LLE | Map</title>

<?php include 'include/header.html';?>
<?php 	
	if($_SESSION["planet"]=="pluto"){
		// do nothing
	}else{
	echo"<script>window.open('loginRedirect.php','_self');</script>";
	exit(); 
	}	
?>


 <!---------- Google API Below this line ---------->

    <script type="text/javascript" src="../src/data.json"></script>
    <script type="text/javascript">
      var script = '<script type="text/javascript" src="../src/markerclusterer';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '_compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>


<script type="text/javascript">
		
//<![CDATA[
      // this variable will collect the html which will eventually be placed in the side_bar
      var side_bar_html = "";
 
      // arrays to hold copies of the markers and html used by the side_bar
      // because the function closure trick doesnt work there
      var gmarkers = [];
      var map = null;

window.onload = function initialize() {
  // create the map
  var myOptions = {
    zoom: 4,
    center: new google.maps.LatLng(39.101974,-84.500055),
    mapTypeControl: false,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
 


var infowindow = new google.maps.InfoWindow(
  {
    size: new google.maps.Size(150,50)
  });

 <?php echo displayMapInfo();?>
    

// put the assembled side_bar_html contents into the side_bar div
  document.getElementById("side_bar").innerHTML = side_bar_html;
 
}

var infowindow = new google.maps.InfoWindow(
  {
    size: new google.maps.Size(150,50)
  });
 
// This function picks up the click and opens the corresponding info window
function myclick(i) {
  google.maps.event.trigger(gmarkers[i], "click");
  //alert(i);
}

function openDrawer(element) {
	
	if(element.style.height=="70px" || element.style.height!="600px"){

		element.scrollIntoView (true);
		element.style.height="600px";
		element.style.backgroundColor="#fff";
	}else{
		element.style.height="70px";
		element.style.backgroundColor="";
	}
}

var b=1;
var c=1;  // for name in sidebar
var d=1;  // openMoreInfo button in sidebar
var e=1;  // id the description
var n=1;  // datalist number


// A function to create the marker and set up the event window function
var markers = [];
function createMarker(latlng, header, name, html, color, siteNumber, description, language, country) {
	
    var contentString = html+'<h100>' + color + '</h100>';
    
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
    //    icon: 'http://google-maps-icons.googlecode.com/files/factory.png',
        zIndex: Math.round(latlng.lat()*-100000)<<5
        })
        if(contentString.indexOf('blue') >= 0){
		var i=siteNumber; 
        Blue = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter_withshadow&chld=' + i + '|0CF|000';
marker.setIcon(Blue);
 		}else if(
 		contentString.indexOf('green') >= 0){
	    var i=siteNumber;
        Green = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter_withshadow&chld='+ i +'|0F0|000';
marker.setIcon(Green); 
       }else{
	   if(contentString.indexOf('red') >= 0){
	   var i=siteNumber;
        Red = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter_withshadow&chld='+ i +'|FF7D72|000';
marker.setIcon(Red); 
       }  
}

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString);
        infowindow.open(map,marker);
        map.setZoom(14);
        map.setCenter(marker.getPosition());
        closeDrawer();
		var siteBox=document.getElementById('side_bar_drawer'+siteNumber);
	    if(siteBox.style.height=="70px" || siteBox.style.height!="600px"){
		siteBox.scrollIntoView (true);
		siteBox.style.height="600px";
		siteBox.style.backgroundColor="#fff";
	}else{
		siteBox.style.height="70px";
		siteBox.style.backgroundColor="";
		//map.setZoom(4);
		closenMoreInfo();
	}				
   });
   
   
   function closeDrawer(){
	   var myDrawer = new Array();
	   var allElems=document.getElementsByTagName("*");	   
	   var siteBox2=document.getElementById('side_bar_drawer'+siteNumber);
	   if(siteBox2.style.height=="600px"){
		   //do nothing
	   }else{	   
		   for (var i=0;i<allElems.length;i++){
			   if(allElems[i].className=="drawerClass") myDrawer.push(allElems[i]);
		   }
			   for (var i =0; i < myDrawer.length; i++){
				   myDrawer[i].style.height="70px";
				   myDrawer[i].style.backgroundColor="";
				   closenMoreInfo();
		   }  		   
		}	   
   }
   
   
    // Push info into moreInfo box
    var cnt = $('drawerClass').text();
    // save the info we need to use later for the side_bar
    gmarkers.push(marker);
    // add a line to the side_bar html
    side_bar_html += '<div id="side_bar_drawer'+b+++'" class="drawerClass" >'+header+'<a href="javascript:myclick(' + (gmarkers.length-1) + ')">' +'<h17>'+c+++'</h17>'+' '+'<h18>'+name + ' - '+country+'</h18>' +'</a>'+'<h16>Overview</h16>'+'<h15 id="descTest'+e+++'" class="default-skin desc">'+description+'</h15>'+'<h16>Languages</h16>'+'<h15 id="siteLanguage1">'+language+'</h15>'+'<h16>Enrollment</h16>'+'<h16>Address</h16>'+'<h16>Website</h16>'+'<div class="moreInfo" id="moreInfo'+d+++'" onclick="showInfoId(this.id)">School In Depth</div>'+'</div>'; 
    // Send titles and countries to dataList   
	document.getElementById("browsers").innerHTML+="<option value='"+n+++""+' '+""+name+""+' – '+""+country+"'>";
}	
</script>




</head>

<body id="mapWindow" >
	
		<div class="logOff">
			<div class="arrow-up"></div>
			<form method="post" action="index.php">
				<input id="logOffbtn" type="submit" name="logout" value="Log Out"/>
			</form>
		</div>
		<div class="logoOnMapTop"></div>
		<div class="logoOnMapBtm"></div>
		
		<?php  
			if($_SESSION["food"]=="chocolate"){
					echo '<div id="backToDashboardBtn"><h20>Dashboard</h20></div>';
				}else{
					// do nothing
			}	
		?>

		<div class="helpBtn"></div>
		<div id="searchBarWrapper">
			<form action="demo_form.asp" method="get" id="schlSearch" autocomplete="off">
			  <input list="browsers" name="browser" id="theSchool" autocomplete="off" >
			  <datalist id="browsers">
			  </datalist>
			</form>
			<div class="searchBtn"></div>
		</div>

<!--Map page Start-->  
 		   <div id="moreInfoWrapper">
	 		   <div class="moreInfoCloseBtn"></div>
	 		   <div id="moreInfoContainer">
		 		   <div class="moreInfoHeader"></div>
		 		   <div class="default-skin moreInfoText"></div>
	 		   </div>
 		   </div> 	

           <div id="map_canvas"></div>
           <div id="side_bar_key">
              <div id="listBtn1" class="listBtnClass" onclick="mCategory();"></div>
           </div>
           <div id="side_bar"></div>
           </div>
<!--Map page End--> 

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> </script>


<?php include 'include/footer.html';?>
</body>
</html>
