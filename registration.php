<?php
require("phpsqlajax_dbinfo.php");

// Opens a connection to a MySQL server
$connection=mysqli_connect ('localhost', $username, $password,$database);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}
if(isset($_POST['submit'])){
	print_r($_POST);
    $name=$_POST['name'];
    $street=$_POST['street'];
    $suburb=$_POST['suburb'];
    $state=$_POST['state'];
    $postcode=$_POST['postcode'];
    $website=$_POST['website'];
    $latitude=$_POST['lati'];
    $longitude=$_POST['longi'];
    $phone=$_POST['phone'];
    $type=$_POST['type'];
    $pathology=$_POST['Pathology'];
    $neurology=$_POST['Neurology'];
    $endoscopy=$_POST['Endoscopy'];
    $bulkbilling=$_POST['bulk'];
    $parking=$_POST['Parking'];
    $monday=$_POST['Monday'];
    $tuesday=$_POST['Tuesday'];
    $wednesday=$_POST['Wednesday'];
    $thursday=$_POST['Thursday'];
    $friday=$_POST['Friday'];
    $saturday=$_POST['Saturday'];
    $sunday=$_POST['Sunday'];

    $sql1 = "SELECT `AID` FROM `availability` ORDER BY AID DESC LIMIT 1";
    $result1=mysqli_query($connection , $sql1);
    $row = mysqli_fetch_assoc($result1);
    echo $sql1;
    $aid = $row['AID']+1;
    echo $aid;

    $sql2 = "INSERT INTO availability (AID, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday) VALUES ($aid,'$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday')";
    echo "<br />".$sql2;
     $result2=mysqli_query($connection , $sql2);


    $sql1 = "SELECT `CID` FROM `clinic` ORDER BY AID DESC LIMIT 1";
    $result1=mysqli_query($connection , $sql1);
    $row = mysqli_fetch_assoc($result1);
    //echo $sql1;
    $cid = $row['CID']+1;
    //echo $cid;

     $sql3="INSERT INTO clinic(CID,Name,Street,Suburb,State,Postcode,Website,Latitude,Longitude,Phone,Type, AID) VALUES ($cid,'$name','$street','$suburb','$state','$postcode','$website','$latitude','$longitude','$phone','$type',$aid)";
	echo "<br />".$sql3;

	$result3=mysqli_query($connection , $sql3);

	if($pathology === 'yes'){
		$sql4 = "INSERT INTO clinicfacility VALUES ($cid,1)";
		$result4 = mysqli_query($connection, $sql4);
	}
	if($neurology === 'yes'){
		$sql4 = "INSERT INTO clinicfacility VALUES ($cid,2)";
		$result4 = mysqli_query($connection, $sql4);
	}
	if($endoscopy === 'yes'){
		$sql4 = "INSERT INTO clinicfacility VALUES ($cid,3)";
		$result4 = mysqli_query($connection, $sql4);
	}
	if($bulkbilling === 'yes'){
		$sql4 = "INSERT INTO clinicfacility VALUES ($cid,4)";
		$result4 = mysqli_query($connection, $sql4);
	}
	if($parking === 'yes'){
		$sql4 = "INSERT INTO clinicfacility VALUES ($cid,5)";
		$result4 = mysqli_query($connection, $sql4);
	}
    
    /*if(mysqli_num_rows($result) > 0){
        echo "You have inserted correctly";
        exit();
        }
    else{
        echo " data is not inserted";
        exit();

    }*/

}
?>