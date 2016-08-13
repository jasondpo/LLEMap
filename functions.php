<?php	
session_start();

	
if(isset($_POST['login'])){
		$db = openDB();
		$username = strip_tags($_POST['userNm']);  // input from index/login page
		$password = strip_tags($_POST['password']); // input from index/login page
		
		$username = stripslashes($username);
		$password = stripslashes($password);		
		
		$sql = "SELECT userName, password FROM user WHERE id='1'";
		
		$ds = $db->query($sql); 
        $cnt = $ds->rowCount(); 
        $row = $ds->fetch(); 
        
		$db_password = $row['password']; // password stored in database
		$db_username = $row['userName']; // username stored in database		
			
		if($username==$db_username){
			$_SESSION["food"] = "chocolate";			
		}else{
			//do nothing;
		}
		
		if($password==$db_password){
			$_SESSION["planet"] = "pluto";			
			echo"<script>window.open('map.php','_self');</script>";
			exit();
		}else{
			echo"<script>window.open('map.php','_self');</script>";
			//echo "Password is NOT correct";
		}
	}
	
if(isset($_POST['logout'])){
	session_unset();
	session_destroy();		
}
	

function openDB(){
        $user = 'root';
        $pass = 'root';     
        $db = new PDO("mysql:host=localhost;dbname=map", $user, $pass);
        if ( $db != true){
            die("Unable to open DB ");
        }
        // ECHO "DB OPENED<br>";
        return($db);           
}

function createTables(){
    $db=openDB();
    		
	    $sql ="DROP TABLE IF EXISTS user, mapInfo";
	      $result = $db->query($sql);
	            If ( $result != true){
	                die("Unable to create user table");
	            }
	            else{
	              ECHO "<br>User Table Dropped<br>";                
	            }
	            
	            
	    $sql="CREATE TABLE user ("
	    ."id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
	    ."userName VARCHAR(30) NOT NULL ,"
	    ."password TEXT NOT NULL );"   
	    ."INSERT INTO user (password, userName)"
	    ." VALUES"."( '".$_POST['insertPass']."','".$_POST['insertName']."');";      
	    
	       
		$result=$db->query($sql);
	    if($result != true){
	        die("<br>Unable to create user table");  
	    } 
	    else{
	        ECHO "<br>User Table Created<br>";                
	     }
	   
	              
	  
	    $sql="CREATE TABLE mapInfo ("
	    ."id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,"
	    ."lat VARCHAR(10) NOT NULL ,"
	    ."lng VARCHAR(10) NOT NULL ,"
	    ."title VARCHAR(50) NOT NULL ,"
	    ."country VARCHAR(50) NOT NULL ,"
	    ."infoBox TEXT NOT NULL ,"
	    ."about TEXT NOT NULL ,"
	    ."language VARCHAR(75) NOT NULL ,"
	    ."education TEXT NOT NULL );"; 
	   
	    
		$result=$db->query($sql);
	    if($result != true){
	        die("<br>Unable to create mapInfo table");
	   }
	   else{
	        ECHO "<br>mapInfo Table Created<br>";                
	     }
		   
		}
		


function displayMapInfo(){ 
	$x=1;
    $db = openDB();               
    $query = "SELECT lat,lng, title, country, infoBox, about,language,education FROM mapInfo;" ; //sql does not care about letter casing
    $ds = $db->query($query);
    $cnt = $ds->rowCount();
    if ($cnt == 0){
       // echo "<span> No contacts found </span>";
        return; // No contacts 
    } 
// populate map             

    foreach ($ds as $row){
       	
       	echo "var point = new google.maps.LatLng(",$row['lat'],",",$row['lng'],");\n var marker = createMarker(point,'', '",$row['title'],"','<h99>",$row["infoBox"],"</h99>', '",$row["education"],"', '",$x++,"','",$row["about"],"', '",$row["language"],"','",$row["country"],"')\n \n ";
       	            
    }

} 

   if (isset($_POST["updateMap"])){
	   
	   if (empty($_POST["schoolName"])) {
	   		echo "<script>alert('School Name field is empty');</script>";
	   			 echo"<script>window.open('dashBoard.php','_self');</script>";
  		} else {
  			// Do nothing;
  		}
	   
	   
        $db = openDB();
            $sql ="INSERT INTO mapInfo (lat, lng, title, country, infoBox, about, language, education )"
                      ." VALUES " 
                    ."( '"
                    .$_POST['latitude']."','"
                    .$_POST['longitude']."','"
                    .$_POST['schoolName']."','"
                    .$_POST['country']."','"
                    .$_POST['mapDisc']."','"
                    .$_POST['about']."','"
                    .substr(str_replace(" ",", ",implode("",$_POST['language'])),0,-2)."','"
                    .$_POST['education']."' );"; 
            $result = $db->query($sql);
            if ( $result != true){
                ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Unable to save School info</h102></div></div>";
             //  LogMsg("contacts.php insert contacts", $sql);
            }
            else{
                ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>School info saved</h102></div></div>";
            }
          // initSession();  
 
    }
     if ( isset($_POST["updateSchool"])){
        $db = openDB();
            $sql ="UPDATE `mapInfo`"
                    . " SET `lat` = '".$_POST['latitude']."',"
                    . "`lng` =  '".$_POST['longitude']."',"
                    . "`title` =  '".$_POST['schoolName']."',"
                    . "`country` =  '".$_POST['country']."',"                    
                    . "`infoBox` = '".$_POST['mapDisc']."',"
                    . "`about` = '".$_POST['about']."',"
                    . "`language` ='".substr(str_replace(" ",", ",implode("",$_POST['language'])),0,-2)."', "
                    . "`education` = '".$_POST['education']."' "
                    . "WHERE id = ". "'".$_POST['schoolNo']."'";               
    
            $result = $db->query($sql);
            if ( $result != true){
                
              ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>Could not update school info</h102></div></div>";
            }
            else{
                ECHO "<div class='alertBoxWrapper'><div class='alertBox'><h102>school updated</h102></div></div>";
            }
      }
      
   if ( isset($_POST["deleteSchool"])){
        $db = openDB();
            $sql ="DELETE FROM `mapInfo` WHERE id = "."'".$_POST['schoolNo']."'"; 
            $result = $db->query($sql);
            if ( $result != true){           
               ECHO "<div class='alertBox'><h102>School could not be deleted</h102></div>";
            }
            else{
                ECHO "<div class='alertBox'><h102>School deleted</h102></div>";
            }
    } 
    
if ( isset($_POST["findSchool"])){
	$db = openDB();
    $sql = "SELECT id, lat, lng, title, country, infoBox, about, language, education FROM mapInfo WHERE id = "."'".$_POST['schoolNo']."'"; 
    $ds = $db->query($sql);
    $cnt = $ds->rowCount();  
        
        $row = $ds->fetch(); // Get data row
		    
	if ( $row != true){                
               ECHO "<div class='alertBoxWrapper'><div class='alertBox'></h102>Could not retrieve school<h102></div></div>";
            }
            else{
                ECHO "<div class='alertBoxWrapper'><div class='alertBox'></h102>School Retrieved<h102></div></div>";
            }
    } 
    
    
function displaySchoolNames(){
    
    $db = openDB();               
    $query = "SELECT id,title FROM mapInfo order by title" ;
    $ds = $db->query($query);
     $cnt = $ds->rowCount();
    if ($cnt == 0){
        echo "<span> No schools found </span>";
        return; // No contacts 
    } 
    // Fill scroll area             

    foreach ($ds as $row){
        echo '<li><a href="dashBoard.php?contactId=',$row["id"],'">',$row["id"],'&nbsp;&nbsp',$row['title'],'</a> </li>';
    }

}
    
?>
