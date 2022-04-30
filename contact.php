<?php
require("connetdb.php");
session_start();

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav>

    <div class="navhome">
<ul class="nav nav-pills">
<h1><div id="headerAuthor">JK ROWLING</div></h1>

  <li class="nav-item">
    <a class="nav-link " href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link "   href="books.php">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="news.php">News</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="cart.php">Cart</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="gallery.php">Gallery</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="about.php">About</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
  </li>
</ul>
</div>
</nav>
<main>


<div class="container">

<div class="headerHome"><h2>Connect with ROWLING</h2></div>

<form  method="post">

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">User Name</label>
  <input type="text" class="form-control" name="txtname" id="exampleFormControlInput1" placeholder="Danny Royals">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" name="txtemail" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Message</label>
  <textarea class="form-control" name="txtMessage" id="exampleFormControlTextarea1" rows="3"></textarea>

  <button type="submit" class="btn btn-primary" name="btnSave" id="btnSaverid">Send Messege</button>

  </form>

</div>
</div>


</main>


<?php

if(isset($_POST['btnSave']))
{
  
  $conn=Connection::GetConnection();
 // $query1="INSERT INTO `customer_manager`(`CName`, `CPNumber`, `CAddress`, `CEmail`) VALUES ('$_POST[txtCName]','$_POST[txtnumber]','$_POST[txtaddress]','$_POST[txtEmail]')"; 
  $query="INSERT INTO `contactinfo`(`name`, `email`, `message`) VALUES ('$_POST[txtname]',
  '$_POST[txtemail]','$_POST[txtMessage]')";

  $stmt=$conn->prepare($query);
  if($stmt->execute())
  {

  echo '<script>alert("Thank You For Your Feedback!!! ")</script>';
  echo' <script language="Javascript">';
  echo'  window.location = "home.php";';
  echo'  </script>';



}


}




?>







<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<style>
  #exampleFormControlInput1,#exampleFormControlTextarea1
    {
        background-color:#c6f2cd;
    }

#btnSaverid
{
    margin: 15px;
    float: right;
    background-color: #04AA6D;
}    

.headerHome
{
    margin: 20px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 1.5em;

} 

main
{
    margin-bottom: 50px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 1.5em;
}

.navhome
{
    height: 8%;
    background-color:#d0d3d2;
    font-size: 1.5em ;
    color: white;
    text-decoration: lightgoldenrodyellow;   
} 


#headerAuthor
{
    float: left;
    color: black;
    font-size: 1em;
   /* margin-left: 50%;*/
    margin-right: 350px;
    padding: 5px;
    font-family: 'Times New Roman', Times, serif;
    font:italic;
}

footer
    {
      
        width: 100%;
        height: 5%;
        background-color: #d0d3d2;
        color: darkslategrey;
        text-align: center;
        font-size: 1.5em;
        font-family: 'Times New Roman', Times, serif;
        position: fixed;
        left: 0;
        bottom: 0;
    }



</style>