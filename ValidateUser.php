<?php
	session_start();
    //connect to information of database
    include('connectionData.txt');
    
    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
    or die('Error connecting to MySQL server.');
    
    $tbl_name="members"; // Table name
    $state = $_POST['state'];
    $manu= $_POST['manu'];
    
    $query2 = "SELECT * FROM $tbl_name WHERE username='$state' and password='$manu'";
    
    //connect "select" query to database table
    
    $result2 = mysqli_query($conn, $query2);
	if (!result2) {
		header("location:../../index.php?page=login_error");
		exit();		
	}
    
    //count how many rows of this user ( if row number is 0, means first time login
    //other wise there should be have row of this user exits, no need to add new information
    $count=mysqli_num_rows($result2);
    
    //if count row number of this user is 0, means this user is first time to login
    //so insert his/her information into the table, and redirect to next page
    if($count==0){
       header("location:../../index.php?page=login_error");
    }

    //if the count row number of this user more than 0,
    //means this user have the previous infomtaion inside datbase table so edirect to next page
    else if($count>0){
	   $_SESSION['logged_in'] = 1;	
       header("location:../../index.php?page=upload");
    }
    else {
        //for testing the count of row must be 0 or postive number, otherwise system problem
        header("location:../../index.php?page=login_error");
    }
    
    ob_end_flush();
    
    mysqli_close($conn);
    
?>





