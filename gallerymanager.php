
<?php


require("BO/gallery.php");
require("sessionscheck.php");
/*session_start();*/

$gallerys = gallery::GetGallery();
$galleryUpdate = new gallery(null,null,null,null);

if (isset($_POST["btnUpdate"])) {

$galleryUpdate =$gallerys[$_POST["btnUpdate"]];
//echo $_POST["btnUpdate"];
$_SESSION["gallery"]=$galleryUpdate;
}
elseif(isset($_POST["btnDelete"]))
{
//echo $_POST["btnDelete"];
try {
  gallery::Delete($_POST["btnDelete"]);
  header("location:gallerymanager.php");
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

$gallerys = array();
if(isset($_SESSION["gallery"]))
{
  $gallerys=$_SESSION["gallery"];
}



$newName="./galleryimages/default.jpg";
$info="";
if(isset($_FILES["txtGCover"]))
{
if(!$_FILES["txtGCover"]['error']== UPLOAD_ERR_NO_FILE)
{
$name = $_FILES["txtGCover"]['name'];
$info= new SplFileInfo($name);
//	$newname = "./bookimages/".$_POST["txtISBN"].'.'.$info->getExtension();
//	move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newname);
}	

}


$gallery = new gallery($_POST["txtGcode"],
         $_POST["txtGYear"],
         $newName,
         $_POST["txtGDescription"]);


try {

  if(!isset($_SESSION["gallery"]))
  {	
    
    $newName = "./galleryimages/".$_POST["txtGcode"].'.'.$info->getExtension();
    //$BID = $book->GetBID();
    $gallery->SetImage($newName);
    $GID = $gallery->Add();
    move_uploaded_file($_FILES["txtGCover"]['tmp_name'],$newName);
 //   echo "Book Added";

    echo '<script>alert("Added to the Gallery")</script>';
    //unset($_SESSION["book"]);
    $gallerys = gallery::GetGallery();

  }
  else
  {
    $gallery->SetGID($_SESSION["gallery"]->GetGID());
    //if(!isset($_FILES["txtCover"]))
    $GID = $gallery->GetGID();
          if($_FILES["txtGCover"]['error'] == UPLOAD_ERR_NO_FILE)
      {
        $gallery->SetImage($_SESSION["gallery"]->GetImgae());
      }
      else{
    
        $name = $_FILES["txtGCover"]['name'];
        $info = new SplFileInfo($name);
        $newName= "./galleryimages/".$GID.'.'.$info->getExtension();
        $gallery->SetImage( $newName);
        move_uploaded_file($_FILES["txtGCover"]['tmp_name'],$newName);
      
      
      
      
      
      
      
      }	
      $gallery->SetGID($_SESSION["gallery"]->GetGID());
      
      $gallery->Update();
      $GID=$gallery->GetGID();
      
      echo '<script>alert("Updated")</script>';
      unset($_SESSION["gallery"]);
      $gallerys = gallery::GetGallery();
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
    <title>GalleryManager</title>
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
    <a class="nav-link active" aria-current="page" href="gallerymanager.php">Gallery Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="messeger.php">Messager</a>
  </li>

  <h1><div id="headerAuthor">JK ROWLING</div></h1>

</ul> 
</div>
</nav> 

<aside>
  <br><br>
<div class="container">
<form id="loginform"  method="POST" enctype="multipart/form-data" novalidate>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="text" name="txtGcode" class="form-control" placeholder="Gallery Code" id="inputName3"
      require 
			value="<?php 
				if($galleryUpdate->Getcode()!=null)
				{
					echo $galleryUpdate->Getcode();
				}
			
			?>"
     
     
      >
    </div>
  </div>
 
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="number" name="txtGYear" class="form-control" placeholder="Year" id="inputYear"
      
      require 
			value="<?php 
				if($galleryUpdate->GetSGN()!=null)
				{
					echo $galleryUpdate->GetSGN();
				}
			
			?>"

      >
    </div>
  </div>
 
  
  <input type="file"  class=" btn " name="txtGCover" id="btnnImageChooser"> 
 
  <?php
		if($galleryUpdate->GetImgae()!=null)
		{
		echo '<img src="'.$galleryUpdate->GetImgae().'" 
		width="70px" height="70px">'
		;

		}
		?>
  
  
  
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <textarea name="txtGDescription" type="text" class="form-control" cols="40" rows="10" placeholder="Description" id="inputDescription">

      <?php 
if($galleryUpdate->GetDescription()!=null)
{
	echo $galleryUpdate->GetDescription();
}			
?>


      </textarea>
    </div>
  </div>
 
  <input type="submit" class="btn btn-primary" id="btnSaver" name="btnSave" value="Save">

</form>

</div>
</aside>

<main>


  <br><br>

  <div class="container">

  <?php
 
  if(sizeof($gallerys)>0)
  {

    echo ' <form method="post">
<table class="table">';
 echo ' <thead>
    <tr>
      <th scope="col">Gallery Code</th>
      <th scope="col">Year</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>';

  $r=0;
  foreach($gallerys as $g)
  {
    echo '<tr>
      <td>'.$g->Getcode().' </td>
      <td> '.$g->GetSGN().' </td>
      <td><img src="'.$g->GetImgae().'" width="100px" height="100px"></td>
      <td>'.$g->getDescription().'</td>
      <td><button type="submit" name="btnUpdate" id="btnUpdateColor" value="'.$r.'">Update</button></td>
      <td><button type="submit"  name="btnDelete" id="btnUpdateColor" value="'.$g->GetGID().'"
									>Delete</button></td>
    </tr>';
    

    $r++;
  }
 echo ' </tbody>
</table>

</form>';

}
else{
  echo "No data to display";
}
//}

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
}


#btnImageChooser
{
    margin-bottom: 8px;
    margin-left: 100px;
   
}
#btnSaver
{
    width: fit-content;
    margin-left: 25px;
}


</style>