<?php
    //connect to information of database
    include('connectionData.txt');
    
    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
    or die('Error connecting to MySQL server.');
    Location:register_error
    $tbl_name=“chatdata”; // Table name
    $state = $_POST['state'];
    $manu= $_POST['manu'];
    if (empty($state)){
        
        header("Location:register_error");
        exit();
    }
    if(empty($manu)){
       header("Location:register_error"); 
        exit();
    } 
    if (empty($state) && empty($manu)){
        header("Location:register_error");
        exit();
    } 
    
    //This is the query for check the user is exits or not
    $query2 = "SELECT * FROM $tbl_name WHERE username='$state'";
    //connect "select" query to database table
    
    $result2 = mysqli_query($conn, $query2);
    if (!result2) {
		header("Location:register_error");
		exit();		
	}
   
    //count how many rows of this user ( if row number is 0, means first time login
    //other wise there should be have row of this user exits, no need to add new information
    $count=mysqli_num_rows($result2);
    
    //if count row number of this user is 0, means this user is first time to login
    //so insert his/her information into the table, and redirect to next page
 
    if($count==0){
        $query= "INSERT INTO `members` VALUES (null,'$state', '$manu')";
        $result1 = mysqli_query($conn, $query);
		if (!result1) {
			header("Location:register_error");
			exit();		
		}        
        $count1=mysqli_num_rows($result1);
      
        if($count1==0){
     		header(“Location:index.php”);
        }
    }
    //if the count row number of this user more than 0,
    //means this user have the previous infomtaion inside datbase table so
    //edirect to next page
   
    else if($count>0){
        header("Location:register_error");
    }
    
    ob_end_flush();
    
    mysqli_close($conn);
    
?>






