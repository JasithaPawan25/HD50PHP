<?php

session_start();
include('connetdb.php');

if (isset($_POST["submit"]))
{
  $conn = Connection::GetConnection();
  $uname = $_POST['name'];
  $password=$_POST['password'];
  $sql = "select * from `login` where `userName`='".$uname."' AND `userPassowrd`='".$password."' limit 1";
  $stmt = $conn->prepare($sql);
         $stmt->execute();

         $count = $stmt->rowCount();  
                if($count > 0)  
                {  
                     $_SESSION["un"] = $_POST["name"];  
                     
                     header("location:bookmanger.php");  
                     echo "<script>alert('Welcome to the Admin site');</script>";
                }  
                else  
                {  
                  echo "<script>alert('Invalid Details');</script>";
                }  

}






?>














<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>



<form method="POST" id="loginform">
  <div class="row mb-3">
    <div id="head1"> <h1> Login to Admin site</h1></div>
    <label for="inputName3" class="col-sm-4 col-form-label">User Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="inputName3">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3">
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">LOGIN</button>
</form>

<style>
 #loginform 
 {
     width: 40%;
    margin-top: 20%;
    margin-left: 25%; 
    border: 2px solid;
    padding: 40px;
    border-radius: 15px;
    background-color:whitesmoke ;
    }  

    #head1
    {
        padding: 6px;
        text-align: center;
    }

    body {
     /* background-color: white;*/
	background-image: url("../images/background/bk6.jpg")
	}
</style>



 


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
