

<?php

require("BO/newsbo.php");
require("sessionscheck.php");
/*session_start();*/

$newss = News::GetNews();
$newsUpdate = new News(null,null,null,null,null);

if (isset($_POST["btnUpdate"])) {

$newsUpdate =$newss[$_POST["btnUpdate"]];
//echo $_POST["btnUpdate"];
$_SESSION["news"]=$newsUpdate;
}
elseif(isset($_POST["btnDelete"]))
{
//echo $_POST["btnDelete"];
try {
  News::Delete($_POST["btnDelete"]);
  header("location:newsmanager.php");
} catch (Exception $th) {
  echo $th;
}



}	

elseif(isset($_POST["btnLOut"]))
{
  unset($_SESSION["un"]);
  header("location:backlogin.php");
}



elseif (isset($_POST["btnSave"]))
{

$newss = array();
if(isset($_SESSION["news"]))
{
  $newss=$_SESSION["news"];
}



$newName="./newsimages/default.jpg";
$info="";
if(isset($_FILES["txtNCover"]))
{
if(!$_FILES["txtNCover"]['error']== UPLOAD_ERR_NO_FILE)
{
$name = $_FILES["txtNCover"]['name'];
$info= new SplFileInfo($name);
//	$newname = "./bookimages/".$_POST["txtISBN"].'.'.$info->getExtension();
//	move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newname);
}	

}


$news = new News($_POST["txtNcode"],
         $_POST["txtNTitle"],
         $_POST["txtNdate"],
         $newName,
         $_POST["txtNDescription"]);


try {

  if(!isset($_SESSION["news"]))
  {	
    
    $newName = "./newsimages/".$_POST["txtNcode"].'.'.$info->getExtension();
    //$BID = $book->GetBID();
    $news->SetCover($newName);
    $NID = $news->Add();
    move_uploaded_file($_FILES["txtNCover"]['tmp_name'],$newName);
 //   echo "Book Added";

    echo '<script>alert("News Added")</script>';
    //unset($_SESSION["book"]);
    $newss = News::GetNews();

  }
  else
  {
    $news->SetNID($_SESSION["news"]->GetNID());
    //if(!isset($_FILES["txtCover"]))
    $NID = $news->GetNID();
          if($_FILES["txtNCover"]['error'] == UPLOAD_ERR_NO_FILE)
      {
        $news->SetCover($_SESSION["news"]->GetNCover());
      }
      else{
    
        $name = $_FILES["txtNCover"]['name'];
        $info = new SplFileInfo($name);
        $newName= "./newsimages/".$NID.'.'.$info->getExtension();
        $news->SetCover( $newName);
        move_uploaded_file($_FILES["txtNCover"]['tmp_name'],$newName);
      
      
      
      
      
      
      
      }	
      $news->SetNID($_SESSION["news"]->GetNID());
      
      $news->Update();
      $NID=$news->GetNID();
      
      echo '<script>alert("News Updated")</script>';
      unset($_SESSION["news"]);
      $newss = News::GetNews();
  }
    
  

} catch (Exception $th) {
  throw $th;
}


//array_push($books,$book);	
//$_SESSION["book"]=$books;	

//echo "Book Added";

}




?>






<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NewsManger</title>
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
    <a class="nav-link active" aria-current="page" href="newsmanager.php">News Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="gallerymanager.php">Gallery Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messeger.php">Messager</a>
  </li>

  <h1><div id="headerAuthor">JK ROWLING</div></h1>

</ul> 
</div>
</nav>  
<aside>
<div class="container">
  <br><br>
<form id="loginform" method="POST" enctype="multipart/form-data" novalidate>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="NewsCode" name="txtNcode" id="inputName3"
      
      require 
			value="<?php 
				if($newsUpdate->GetNcode()!=null)
				{
					echo $newsUpdate->GetNcode();
				}
			
			?>"
      
      
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--label for="inputPassword3" class="col-sm-2 col-form-label">Password</label><br-->
    <div class="col-sm-10">
      <input type="text" class="form-control" name="txtNTitle" placeholder="News Title" id="inputbookTitle"
      
      require
		value="<?php 
				if($newsUpdate->GetNTitle()!=null)
				{
					echo $newsUpdate->GetNTitle();
				}
			
			?>"
      
      
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="datetime-local" name="txtNdate" class="form-control" placeholder="Date" id="inputYear"
      
      require
		value="<?php 
				if($newsUpdate->GetNdate()!=null)
				{
					echo $newsUpdate->GetNdate();
				}
			
			?>"
      
      
      
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    
    <input type="file"  class=" btn " name="txtNCover" id="btnnImageChooser">
 
<?php
		if($newsUpdate->GetNCover()!=null)
		{
		echo '<img src="'.$newsUpdate->GetNCover().'" 
		width="100px" height="100px">'
		;

    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
   
    
		}
    
		?>



  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <textarea type="text" name="txtNDescription" class="form-control" cols="40" rows="10" placeholder="News Description" id="inputDescription"  require >
    
<?php 
if($newsUpdate->GetNDescription()!=null)
{
echo $newsUpdate->GetNDescription();
}
?>
    
    </textarea>
    </div>
  </div>
    
  <input type="submit" class="btn btn-primary" id="btnSaver" name="btnSave" value="Save">
  <input type="reset" class="btn btn-primary" id="btnSaver">

</form>
</div>
</aside>
<main>
  <br><br>

<div class="container">


<?php

if(sizeof($newss)>0)
{

 echo '<form method="post">

<table class="table">';
echo ' <thead>
    <tr>
      <!--th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th-->
        <th  scope="col">News Code</th>
        <th  scope="col">News Title</th>
        <th  scope="col">Date</th>
        <th  scope="col">Image</th>
        <th  scope="col">News Description</th>
        <th  scope="col">Edit</th>
        <th  scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>';

  $r =0;

  foreach($newss as $n)
  {

    echo ' <tr>
     
    <td>'.$n->GetNcode().' </td>
    <td> '.$n->GetNTitle().' </td>
    <td>'.$n->GetNdate().'</td>
    <td><img src="'.$n->GetNCover().'" width="100px" height="100px"></td>
    <td>'.$n->GetNDescription().'</td>
      <td><button type="submit" name="btnUpdate" id="btnUpdateColor" value="'.$r.'">Update</button></td>
        <td><button type="submit"  name="btnDelete" id="btnUpdateColor" value="'.$n->GetNID().'"
									>Delete</button></td>
    </tr>';

    $r++;
  }
   
 echo' </tbody>
</table>
</form>';

}
else{
  echo "No data to display";
}


?>

<form  method="post">
<!--button id="myBtn" title="Go to Login">Logout</button>  <a href="backlogin.php">  </a-->
<input type="submit" id="myBtn" value="Logout" name="btnLOut">
</form></div>
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
    margin-bottom: 50px;
}
main
{
    margin-top: 10px;
    width: 70%;
    float: right;
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
    width: 110%;
}

/*tr,td,th
{
    border: solid 2px;
    width: auto;
}*/
#btnImageChooser
{
    margin-bottom: 8px;
    margin-left: 100px;
    width: fit-content;
   
}
#btnSaver
{
    width: fit-content;
    margin-left: 25px;
}


</style>