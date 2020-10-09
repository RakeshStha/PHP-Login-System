<?php
$error=NULL;
session_start();

if(isset($_POST['submit'])){

	//Connect to the database
    $mysqli= mysqli_connect("localhost",'username','password',"dbname");
    //end

	$email=$_POST['user'];
	$password=$_POST['pass'];
	$password= md5($password);

	$sql ="SELECT * FROM accounts WHERE email = '$email' AND password = '$password' LIMIT 1";
        
    $resultSet = mysqli_query($GLOBALS['mysqli'],$sql);

    if($resultSet->num_rows !=0){
    //Process login
      $row = $resultSet->fetch_assoc();
      $verified = $row['verified'];
      $email = $row['email'];
      $date = $row['createdate'];
      $date = strtotime($date);
      $date = date('M d Y', $date);
	
	if($verified == 1){  
	    
	   
	        $username=$_POST['user'];
	        $_SESSION['users']= $email;
	        header("Location:profile.php");
	    
	         $_SESSION['passs']= $password;
		        header("Location:profile.php");
	}
	else{
	    $error = "This account has not yet been verified. An email was sent to $email on $date";
	}
	}
	else{

		 $error = "The username or password you entered is incorrect";


	}
	mysqli_close($mysqli);
}


?>
