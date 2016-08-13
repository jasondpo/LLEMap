<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>LLE | Dashboard</title>  

<?php include 'include/header.html';?>
<?php
	if($_SESSION["planet"]=="pluto" && $_SESSION["food"]=="chocolate"){
	//echo "start page, pluto";
	}else{
	echo"<script>window.open('loginRedirect.php','_self');</script>";
	exit(); 
	}
	
	$test=$_GET['contactId'];
	if($test==null){
		//do nothing
	}else if ($test!=null){
		$db = openDB();
		$sql = "SELECT id, lat, lng, title, country, infoBox, about, language, education FROM mapInfo WHERE id = "."'".$test."'"; 
		$ds = $db->query($sql);
		$cnt = $ds->rowCount();         
        $row = $ds->fetch(); // Get data row		
	}
?>
<script>
	function clearFields(){	
		window.open('dashBoard.php','_self');
}

</script>

</head>
    
 <body id="inputFields" onunload="unloadP('UniquePageNameHereScroll')" onload="loadP('UniquePageNameHereScroll'); initForm();"/>
 
<div class="inputWrapper">
	

	<div class="logo"></div>
	
	<div class="welcomeField">
		<h2>LLE Map Dashboard</h2> <h3>Last Updated:</h3>
	</div>
		
	<div class="dashboard-nav">
		<div class="dashboard-box"><h22 id="map" onclick="switchForm('map');">Map</h22> <h22 id="intro" onclick="switchForm('intro');">Intro</h22></div>
	</div>

	<div class="container" id="container">
			
		<form id="schoolForm" action="dashBoard.php" onsubmit="return validateForm()" method="post">
			
			<span class="floatLeft">
				<label><span>*</span>Latitude</label><br>    
			    <input type="text" id="latfrm" name="latitude" value="<?php echo $row['lat'];?>"/>
		    </span> 
		       
		   	<label><span>*</span>Longitude</label><br>    
		    <input type="text" id="longfrm" name="longitude" value="<?php echo $row['lng'];?>"/>
		        
		    <br> <br> 
		    <hr>  
			<br> <br>
			 
			<label><span>*</span>Education Level</label><br>
		        <select name="education" id="edufrm">
		            <option value="red" <?php if($row['education'] == "red") echo 'selected'; ?>>Primary - Red</option>
		            <option value="blue" <?php if($row['education'] == "blue") echo 'selected'; ?>>Secondary - Blue</option>
		            <option value="green" <?php if($row['education'] == "green") echo 'selected'; ?>>Postsecondary - Green</option>
		            <option value="" <?php if($row['education'] == "") echo 'selected'; ?>>Choose Level</option>
		        </select>
		        
		    <br> <br>
		    <hr>    
		    <br> <br>
		    
		    <span class="floatLeft">
		    <label><span>*</span>School Name</label> <br>   
		    <input type="text" name="schoolName" id="schlfrm" value="<?php echo $row['title'];?>"/>
			</span>  
		   
		    <label><span>*</span>Country</label> <br>   
		    <input type="text" name="country" id="cntryfrm" value="<?php echo $row['country'];?>"/>
		     
		     <br/><br/>
		    
		    <label>Popup Box Info: 200 character limit</label><br>     
		    <textarea name="mapDisc" class="mapDisc" id="mapDiscfrm"><?php echo $row['infoBox'];?></textarea> 
		        
		    <br> <br>
		    <hr>    
		    <br> <br>
		        
		    <label>Overview</label> <br>    
		    <textarea  name="about" class="about" id="aboutfrm"><?php echo $row['about'];?></textarea>
		        
		    <br> <br>
		    <hr>    
		    <br> <br>
		    
		    <label><span>*</span>Languages spoken</label> <br><br>    
		    <label>English</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="English "<?php $langauge =$row['language'];  if(strpos($langauge,'English') !== false){echo 'checked';}; ?>>&nbsp;
			<label>Spanish</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="Spanish "<?php $langauge =$row['language'];  if(strpos($langauge,'Spanish') !== false){echo 'checked';}; ?>>&nbsp;
			<label>French</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="French "<?php $langauge =$row['language'];  if(strpos($langauge,'French') !== false){echo 'checked';}; ?>><br>
			<label>Swahili</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="Swahili "<?php $langauge =$row['language'];  if(strpos($langauge,'Swahili') !== false){echo 'checked';}; ?> >&nbsp;
			<label>Chinese</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="Chinese "<?php $langauge =$row['language'];  if(strpos($langauge,'Chinese') !== false){echo 'checked';}; ?> >&nbsp;
			<label>Other</label> <input type="checkbox" id="languageCheckbox" name="language[]" value="Other "<?php $langauge =$row['language'];  if(strpos($langauge,'Other') !== false){echo 'checked';}; ?> >
		        
		  
		    <br> <br> 
		      
			<input type="submit" class="mapBtns" id="updateMap" name="updateMap" value="Add School To Map">
			
			<br> <br><br>
		    <hr>    
		    <br> <br> 
			
			<label>School ID </label><br>
			
			<input type="text" name="schoolNo" class="schoolNo" size="3" value="<?php echo $row['id'];?>">
			
			<br><br>
			
			<input type="submit" class="mapBtns mapBtnsOpacity" id="updateSchool" name="updateSchool" value="Update School">
				 
			<input type="submit" class="mapBtns mapBtnsOpacity" id="findSchool" name="findSchool" value="Retrieve School">	
			
			<input type="submit" class="mapBtns mapBtnsOpacity" id="deleteSchool" name="deleteSchool" value="Delete School">
			
			<input type="button" class="mapBtns mapBtnsOpacity" id="clearFieldBtn" name="clear" onclick="clearFields();" value="Clear Fields">
			<br>			
		</form>

	</div>
	
	<div class="containerIntro" id="containerIntro">
			<form> 
				<label>Header</label> <br>   
				<input type="text"><br>
				<label>Body</label> <br>  
		    	<textarea  name="about" class="about" id="aboutfrm"><?php echo $row['about'];?></textarea>
			</form>
	</div>
</div>	

<div class="mapReturn"><h21>Go to map</h21></div>
<div id="schoolListField">
	<ul class="scrollAreaLn">
	<?php echo displaySchoolNames(); ?>
	</ul>
</div>
    </body>

</html>