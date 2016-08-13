setInterval(function(){startSlide();},1000);

var x=0;

function startSlide(){
x++;
if(x==26){x=1}
if(x==8){		
        $("#cover1").fadeOut(1000);
		$("#cover3").fadeIn(1000); 
}if(x==16){	
        $("#cover2").fadeOut(1000);
}if(x==25){	
        $("#cover3").fadeOut(1000);
		$("#cover1").fadeIn(1000);
		$("#cover2").fadeIn(1000);
	}
}

//$(".featured").delay(2000).fadeIn(1000);

// not used
function toggleSchoolList(){	
    var b = document.getElementById("schoolListField");
    if(b.style.display == "none" || b.style.display !="block"){
	   	$('#schoolListField').fadeIn('fast');
	   	$("#schoolListName").text("Close List");
    }else{
	  	$('#schoolListField').fadeOut('fast');
	  	$("#schoolListName").text("Open List");
    }
}

// FadeIn login window
$(document).ready(function(){
    $("#signIn").click(function(){
        $(".overlay").fadeIn('fast');
        $(".signInBox").fadeIn('fast');
        $("#signIn").fadeOut('fast');
    });
});

// FadeOut login window
$(document).ready(function(){
    $(".closeOverlay").click(function(){
        $(".overlay").fadeOut('fast');
        $(".signInBox").fadeOut('fast');
        $("#signIn").fadeIn('fast');
    });
});


// makes school button in list active
$(document).ready(function() {
    $("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
    });
});


// redirects to map
$(document).ready(function() {
	$(".mapReturn").click(function(){
        window.location.href = "map.php";
    });
});

// redirects to dashboard
$(document).ready(function() {
	$("#backToDashboardBtn").click(function(){
        window.location.href = "dashBoard.php";
    });
});

// redirects to dashboard
$(document).ready(function() {
	$("#listBtn1").click(function(){
       map.setZoom(4);
       closeAllDrawers();
       closenMoreInfo();
    });
});


// Unghosts btns
$(document).ready(function() {
	$(".schoolNo").focusin(function(){
		$('.mapBtnsOpacity').css("opacity", "1");
    });
    $(".schoolNo").focusout(function(){
		$('.mapBtnsOpacity').css("opacity", ".35");
    });
});

// Close more info
$(document).ready(function() {
	$(".moreInfoCloseBtn").click(function(){
		$('#moreInfoWrapper').fadeOut('fast');
	});
});

$(document).ready(function(){
	$('.logoOnMapTop').click(function(){
		$('.logOff').fadeToggle('fast');		
	});
	$('html').click(function(){
		$('.logOff').fadeOut('fast');
	});
	$('.logoOnMapTop').click(function(event){
    	event.stopPropagation();
	});
});

// Places info into moreInfoWrapper
function showInfoId(clicked_id){
	var getId=clicked_id;
	nn = getId.substr(getId.length - 1);
	var desc = $('#siteLanguage'+nn).html();
	openMoreInfo();
	$('.moreInfoText').html('<div class="schlProfile"></div>'+'<h19>'+desc+'</h19>'+'<h16>Attention</h16>'+'<h19>'+desc+'</h19>');
}


// Opens moreInfoWrapper 
function openMoreInfo(){
	var b = document.getElementById("moreInfoWrapper");
	 if(b.style.display !="block" || b.style.display =="none"){
	   	$('#moreInfoWrapper').fadeIn('fast');
    }else{
	  	$('#moreInfoWrapper').fadeOut('fast');
    }
}

// Closes moreInfoWrapper 
function closenMoreInfo(){
	 $('#moreInfoWrapper').fadeOut('fast');
}


// Closes All Drawers 
   function closeAllDrawers(){
	   var myDrawer = new Array();
	   var allElems=document.getElementsByTagName("*");	   
	  	   
		   for (var i=0;i<allElems.length;i++){
			   if(allElems[i].className=="drawerClass") myDrawer.push(allElems[i]);
		   }
			   for (var i =0; i < myDrawer.length; i++){
				   myDrawer[i].style.height="70px";
				   myDrawer[i].style.backgroundColor="";
		   }	   		   				   
   }

// Commence Search
var name =""

$(document).ready(function(){
	$(".searchBtn").click(function(){
	var schlNme= $('#theSchool').val();
	//alert(schlNme);
	name =schlNme.charAt(0);
	passName();
	});
});

function passName(){	
		var siteBox=document.getElementById('side_bar_drawer'+name);
	    if(siteBox.style.height=="70px" || siteBox.style.height!="600px"){
		siteBox.scrollIntoView (true);
		siteBox.style.height="600px";
		siteBox.style.backgroundColor="#fff";
	}else{
		siteBox.style.height="70px";
		siteBox.style.backgroundColor="";
		closeAllDrawers();
	}				
}

////////////////////////////////
// fixscroll.js:
// call loadP and unloadP when body loads/unloads and scroll position will not move
function getScrollXY() {
    var x = 0, y = 0;
    if( typeof( window.pageYOffset ) == 'number' ) {
        // Netscape
        x = window.pageXOffset;
        y = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
        // DOM
        x = document.body.scrollLeft;
        y = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
        // IE6 standards compliant mode
        x = document.documentElement.scrollLeft;
        y = document.documentElement.scrollTop;
    }
    return [x, y];
}
           
function setScrollXY(x, y) {
    window.scrollTo(x, y);
}
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
function loadP(pageref){
	x=readCookie(pageref+'x');
	y=readCookie(pageref+'y');
	setScrollXY(x,y)
}
function unloadP(pageref){
	s=getScrollXY()
	createCookie(pageref+'x',s[0],0.1);
	createCookie(pageref+'y',s[1],0.1);
}
////////////////////////////////

function validateForm(){
	latform=document.getElementById('latfrm').value;
	longform=document.getElementById('longfrm').value;
	e = document.getElementById("longfrm");
	eduform=e.options[e.selectedIndex].value;
	schlform=document.getElementById('schlfrm').value;
	cntryform=document.getElementById('cntryfrm').value;
	mapDiscform=document.getElementById('mapDiscfrm').value;
	aboutform=document.getElementById('aboutfrm').value;

	//var checkedValue = null; 
	var inputElements = document.getElementsById('languageCheckbox');
	for(var i=0; inputElements[i]; ++i){
      if(inputElements[i].checked){
           checkedValue = inputElements[i].value;
           break;
	      }
	}	
}

////////////////////////////////

function initForm(){
 	query = window.location.href;
	if(query=="http://jasondportfolio.com/_site2/LLEMap/dashBoard.php#setintro"){
		document.getElementById('map').style.cssText="border-bottom:0px solid #333; color:#BBB";		
		document.getElementById('intro').style.cssText="border-bottom:2px solid #333; color:#333";
		document.getElementById('container').style.display="none";
		document.getElementById('containerIntro').style.display="block";			
		window.location.href="http://jasondportfolio.com/_site2/LLEMap/dashBoard.php#setintro";

	}else{
		document.getElementById('map').style.cssText="border-bottom:2px solid #333; color:#333";		
		document.getElementById('intro').style.cssText="border-bottom:0px solid #333; color:#BBB";
	}
}

function switchForm(this_instance){
	if(this_instance=="map"){
	document.getElementById('map').style.cssText="border-bottom:2px solid #333; color:#333";		
	document.getElementById('intro').style.cssText="border-bottom:0px solid #333; color:#BBB";
	document.getElementById('container').style.display="block";
	document.getElementById('containerIntro').style.display="none";				
	window.location.href="http://jasondportfolio.com/_site2/LLEMap/dashBoard.php";
	}if(this_instance=="intro"){
	document.getElementById('map').style.cssText="border-bottom:0px solid #333; color:#BBB";		
	document.getElementById('intro').style.cssText="border-bottom:2px solid #333; color:#333";
	document.getElementById('container').style.display="none";
	document.getElementById('containerIntro').style.display="block";			
	window.location.href="http://jasondportfolio.com/_site2/LLEMap/dashBoard.php#setintro";
	}
}
















