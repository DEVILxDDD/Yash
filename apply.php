<?php
$host="localhost";
$user="root";
$pass="";
$db="apply";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}

if(isset($_POST['apply'])){
    $fName=$_POST['fname'];
    $lName=$_POST['lname'];
    $father=$_POST['father'];
    $mother=$_POST['mother'];
    $gmail=$_POST['gmail'];
    $age=$_POST['age'];
    $noc=$_POST['noc'];
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];
    $dob=$_POST['dob'];
    $mq=$_POST['mq'];


     $checkgmail="SELECT * From student where gmail='$gmail'";
     $result=$conn->query($checkgmail);
     if($result->num_rows>0){
        ?>
        <script>
            window.alert("gmail Address Already Exists !")
        </script>
              ;
              <?php
     }
     else{
        $insertQuery="INSERT INTO student(fName,lName,father,mother,gmail,age,name_of_course,gender,address,phone_no,dob,meximum_qualification)
                       VALUES ('$fName','$lName','$father','$mother','$gmail','$age','$noc','$gender','$address','$phone','$dob','$mq')";
            if($conn->query($insertQuery)==TRUE){

                header("location: apply success.html");
                
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




?>