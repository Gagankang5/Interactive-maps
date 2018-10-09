<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maroondah's_health_professionals";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
 
if(isset($_POST['username'])){
    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="select * from login where username='".$uname."'AND Password='".$password."' limit 1";
    
    $result=mysqli_query($conn , $sql);
    
    if(mysqli_num_rows($result) > 0){
        echo"You have successfully logged in";

       header("Location: registration_page.html");
    }
    else{
        echo " You Have Entered Incorrect Password";
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel ="stylesheet" href= "login.css"/>
<body>
	<h2>Admin Login Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method = "post" action="login.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="https://www.logolynx.com/images/logolynx/4e/4e0664c4184e0b071036d3bd7b58a2b1.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit">Login</button>
      
    </div>

    <div class="container" style="background-color:#f1f1f1  ">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      
    
     

    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</head>
</html>

