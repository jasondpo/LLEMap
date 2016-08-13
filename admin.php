<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <title>LLE Admin</title> 
        <meta http-equiv="content-type" content="text/html;charset=utf-8" /> 
        
   <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
   <link rel="stylesheet" href="./css/main.css"

    </head>
    
 <body>
<?php include 'functions.php';?>
<?php
if($_SESSION["planet"]=="pluto" && $_SESSION["food"]=="chocolate"){
//echo "start page, pluto";
}else{
echo"<script>window.open('loginRedirect.php','_self');</script>";
exit(); 
}		
?>
        
        <?php
   
          if ( isset($_POST['createTables'])){
	           if(($_POST['insertPass'])!=($_POST['retypePass'])){
			   echo "Passwords do not match";  
	  			}else{
		  		echo "Creating tables"; 
		  		$db = createTables();
          		}                 
         	}          
        ?>
     <form action="admin.php" method="POST">
	     <label>New Username</label><br>
	     <input type="text" name="insertName" value=""/>
	     <br>
	     <br>
	     <label>Set password first</label><br>
	     <input type="password" name="insertPass" value=""/>
	     <br>
	     <br>
	     <label>Retype password</label><br>
	     <input type="password" name="retypePass" value=""/>
	     <br>
	     <br>
	     
        <input type="submit" id = "createTables" name = "createTables" value="Create Tables">
     </form>
        
    </body>

</html>