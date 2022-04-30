<?php
//require("connetdb.php");
require("BO/gallery.php");
session_start();

if(isset($_POST['btnLOut']))
{
  unset($_SESSION["un"]);
  header("location:backlogin.php");
}



?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<nav>
    <div class ="navhome">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link "  href="bookmanger.php">Book Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="newsmanager.php">News Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link "  href="gallerymanager.php">Gallery Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="messeger.php">Messager</a>
  </li>

  <h1><div id="headerAuthor">JK ROWLING</div></h1>

</ul> 
</div>
</nav> 
<main>
  <br><br>

  <div class="container">

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Messege</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <form  method="post">

  <?php
				$conn =Connection::GetConnection();
				$query="SELECT * FROM `contactinfo` ORDER BY CoID DESC";
				$stmt=$conn->prepare($query);
				$stmt->execute();
				$result = $stmt-> fetchAll();
				foreach($result as $value)
				{
          $coid=$value['CoID'];

   echo ' <tr>
      <th>'.$value['CoID'].'</th>
      <td>'.$value['name'].'</td>
      <td>'.$value['email'].'</td>
      <td>'.$value['message'].'</td>
      <td><button type="submit" id="btnUpdateColor"  name="btnDelete" value="'.$coid.'"
									>Delete</button></td>
    </tr>';
        }

//'.$b->GetBID().'

?>

</form>
<!--

    <tr>
      <th>2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td><button type="submit" id="btnUpdateColor" name="btnDelete" value="'.$b->GetBID().'"
									>Delete</button></td>
    </tr>
    <tr>
      <th>3</th>
      <td>Larry the Bird</td>
      <td>@twitter</td>
      <td>sdsd</td>
      <td><button type="submit" id="btnUpdateColor" name="btnDelete" value="'.$b->GetBID().'"
									>Delete</button></td>
    </tr>-->
  </tbody>
</table>


<?php

if(isset($_POST["btnDelete"]))
{

//Product::Delete($_POST["btnDelete"]);


//	echo '<script>alert("Product Deleted")</script>';
try {
gallery::DeleteMessage($_POST["btnDelete"]);

echo '<script>alert("Message Deleted")</script>';
echo' <script language="Javascript">';
echo'  window.location = "messeger.php";';
echo'  </script>';
} catch (Exception $th) {
echo $th;
}


}

?>



<form method="POST">
<!--a href="backlogin.php" </a> -->
<input type="submit" name="btnLOut" id="myBtn" value="Logout">
</form>
</div>
</main>


<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>    
</body>
</html>



<style>

#btnUpdateColor
    {
        border: none;
        outline: none;
        background-color:  #04AA6D;
        color: white;
        cursor: pointer;
        border-radius: 4px;
        padding: 7px;

    }

  
 /*padding: 15px;
 border-radius: 4px;*/



#btnUpdateColor:hover {
 /*background-color: #555;*/
 background-color: white ;
        color: #04AA6D;
        border: 2px solid #04AA6D;
}



#myBtn {
 
 position: fixed;
 bottom: 35px;
 right: 30px;
 z-index: 99;
 font-size: 18px;
 border: none;
 outline: none;
 background-color:  #555555;
 color: white;
 cursor: pointer;
 padding: 15px;
 border-radius: 4px;

}

#myBtn:hover {
  background-color: white ;
        color: #555555;
        border: 2px solid #555555;
}






    main
    {
        height: auto;
        position: relative;
    }

    footer
    {
      
        width: 100%;
        height: 5%;
        background-color: darkslategrey;
        color: blanchedalmond;
        text-align: center;
        font-size: 1.5em;
        font-family: 'Times New Roman', Times, serif;
        position: fixed;
        left: 0;
        bottom: 0;
    }
.navhome
{
    height: 10%;
    background-color: #e8e8e8;
    font-size: 2em ;
    color: white;
    
} 

aside
{
    width: 25%;
    float: left;
}
main
{
    margin-top: 10px;
    width: 70%;
    float: none;
    left: 75;
    margin-bottom: 50px;
}
#loginform 
 {
    /* width: 40%;*/
    margin-top: 2%;
    margin-left: 5%; 
    border: 2px solid;
    padding: 40px;
    padding-left: 5px;
    border-radius: 15px;
    background-color:whitesmoke ;
    } 

#headerAuthor
{
    float: left;
    color: #110d32;
    font-size: 1.5em;
    margin-left: 20px;
    padding: 5px;
    font-family: 'Times New Roman', Times, serif;
    font:italic;
}
input
{
    margin-left: 15px;
}
#inputDescription
{
    
    margin-left: 15px;
}


#btnImageChooser
{
    margin-bottom: 8px;
    margin-left: 100px;
   
}


</style>