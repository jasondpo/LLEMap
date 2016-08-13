<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>LLE | Home</title>

<?php include 'include/header.html';?>


</head>

<body>
	
	<!--NavBar Start-->
	    <div id="navBar"> 
	        <div id="homeBtnWrapper"></div>
	    </div>
	<!--NavBar End--> 
	
	<div class="overlay">
			
	<div class="closeOverlay"></div>
	
	<div class="signInBox">
			<table>
				
				<form action="" method="post" autocomplete="off">
					<label>name</label><br>
					<input type="text" name="userNm" />
					<br><br>
					<label>password</label><br>
					<input type="password" name="password"/>
					<br>
					<br>
					<input type="submit" name="login" value="enter"/>
				</form>	
						
			</table>			
		</div>
		
	</div>
	
	<!--Intro Start--> 
	<div id="introCover">
		<div id="cover1" class="coverClass">
			<div class="featured">
				Featured school 8s
				<br><br>
				Name<br>
				London High School
				<br><br>
				Location<br>
				Britain
			</div>
		</div>
	    <div id="cover2" class="coverClass">
		    <div class="featured">
			    Featured school 16s
				<br><br>
				Name<br>
				London High School
				<br><br>
				Location<br>
				Britain
			</div>
	    </div>
	    <div id="cover3" class="coverClass">
		    <div class="featured">
			    Featured school 24s
				<br><br>
				Name<br>
				London High School
				<br><br>
				Location<br>
				Britain
			</div>
	    </div>
	    <div id="discBar">
	        <h14><span></span></h14>
	            
	             <div id="introContent">                
	                    <?php 
	                    $storedContent = file_get_contents("mapData.txt");
	                    echo $storedContent;
	                    ?>
	            </div>
	            
	        <div id="signIn">
	            <span onclick="enterMap()"><h11>SIGN IN</h11></span>
	        </div>
	    </div>
	</div>
	<!--Intro End-->

</body>
</html>