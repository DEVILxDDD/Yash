<?php 
$host="localhost";
$user="root";
$pass="";
$db="login";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}

if(isset($_POST['signin'])){
    $firstName=$_POST['fname'];
    $lastName=$_POST['lname'];
    $gmail=$_POST['gmail'];
    $password=$_POST['password'];
    $password=sha1($password);

     $checkgmail="SELECT * From users where gmail='$gmail'";
     $result=$conn->query($checkgmail);
     if($result->num_rows>0){
        echo "<script>
          window.location.herf = 'signup.html';
          alert('This gmail is already taken')
          </script>";
     }
     else{
        $insertQuery="INSERT INTO users(firstName,lastName,gmail,password)
                       VALUES ('$firstName','$lastName','$gmail','$password')";
            if($conn->query($insertQuery)==TRUE){
                echo "<script>
                          
                          alert('Account create sucsessfully')
                          window.location.herf = 'index.html';
                      </script>";
            }
            else{
                ?>
        <script>
            window.alert( "Error:".$conn->error)
        </script>
              ;
              <?php
            }
     }
   

}


// For login page 
if(isset($_POST['login'])){
   $gmail=$_POST['gmail'];
   $password=$_POST['password'];
   $password=sha1($password) ;
   
   $sql="SELECT * FROM users WHERE gmail='$gmail' && password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['gmail']=$row['gmail'];
    echo "<script>
            alert('Your successfully logind ')
         </script>";
         header("Location: afterlogin.php");
    exit();
   }
   else{
    echo "<script>
          window.location.herf = 'Login_Page.html';
          alert('Not Found, Incorrect gmail or Password')
          </script>";
   }

}
?>