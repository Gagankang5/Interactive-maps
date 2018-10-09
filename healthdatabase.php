<?php
require("phpsqlajax_dbinfo.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysqli_connect ('localhost', $username, $password,$database);
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

// Set the active MySQL database


// Select all the rows in the clinic table
/*$query = "SELECT c.CID,c.Name, c.Street, c.Suburb, c.State, c.Postcode,c.Website, c.Latitude, c.Longitude, c.Phone, c.Type, a.AID, a.Monday, a.Tuesday, a.Wednesday, a.Thursday, a.Friday, a.Saturday, a.Sunday, f.Fname, cf.CID, cf.FID, f.Fname FROM clinic c JOIN availability a ON c.AID = a.AID 
  JOIN clinicfacility cf ON c.CID = cf.CID
  JOIN facility f ON cf.FID = f.FID";*/
  $query = "SELECT * FROM clinic";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<clinic>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<clinic ';
  echo 'CID="' . $row['CID'] . '" ';
  echo 'Name="' . parseToXML($row['Name']) . '" ';
  echo 'Street="' . parseToXML($row['Street']) . '" ';
  echo 'Suburb="' . parseToXML($row['Suburb']) . '" ';
  echo 'State="' . parseToXML($row['State']) . '" ';
  echo 'Postcode="' . parseToXML($row['Postcode']) . '" ';
  echo 'Website="' . parseToXML($row['Website']) . '" ';
  echo 'Latitude="' . $row['Latitude'] . '" ';
  echo 'Longitude="' . $row['Longitude'] . '" ';
  echo 'Phone="' . parseToXML($row['Phone']) . '" ';
  echo 'Type="' . $row['Type'] . '" ';
  echo 'AID="' . $row['AID'] . '" ';

  $availability = "";
    $query3 = "SELECT a.Monday,a.Tuesday,a.Wednesday,a.Thursday,a.Friday,a.Saturday,a.Sunday 
      FROM availability a, clinic c
      WHERE a.AID = c.CID
      AND c.CID = ".$row['CID'];
  $result3 = mysqli_query($connection, $query3);
  if (!$result3) {
    $availability.="No  availablility";
  }
  else{
      while ($row3 = @mysqli_fetch_assoc($result3)){
      echo 'Monday="' . parseToXML($row3['Monday']) . '" ';
  echo 'Tuesday="' . parseToXML($row3['Tuesday']) . '" ';
  echo 'Wednesday="' . parseToXML($row3['Wednesday']) . '" ';
  echo 'Thursday="' . parseToXML($row3['Thursday']) . '" ';
  echo 'Friday="' . parseToXML($row3['Friday']) . '" ';
  echo 'Saturday="' . parseToXML($row3['Saturday']) . '" ';
  echo 'Sunday="' . parseToXML($row3['Sunday']) . '" ';
    }
  }
  
 
  
  $facility = "";
    $query2 = "SELECT Fname 
      FROM facility f, clinic c, clinicfacility cf
      WHERE cf.CID = c.CID
      AND cf.FID = f.FID
      AND c.CID = ".$row['CID'];
  $result2 = mysqli_query($connection, $query2);
  if (!$result2) {
    $facility.="No facility available";
  }
  else{
      while ($row2 = @mysqli_fetch_assoc($result2)){
      $facility .= $row2['Fname']."\n";
    }
  }
  echo 'Fname="' . parseToXML($facility) . '" ';

  //echo 'FID="' . $row['FID'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</clinic>';
?>