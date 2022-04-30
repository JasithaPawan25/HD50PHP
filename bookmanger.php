
<?php

require("BO/book.php");
require("sessionscheck.php");
/*session_start();*/

$books = Book::GetBooks();
$bookUpdate = new Book(null,null,null,null,null,null);

if (isset($_POST["btnUpdate"])) {

$bookUpdate =$books[$_POST["btnUpdate"]];
//echo $_POST["btnUpdate"];
$_SESSION["book"]=$bookUpdate;
}
elseif(isset($_POST["btnDelete"]))
{
//echo $_POST["btnDelete"];
try {
  Book::Delete($_POST["btnDelete"]);
  header("location:bookmanger.php");
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

$books = array();
if(isset($_SESSION["book"]))
{
  $books=$_SESSION["book"];
}



$newName="./bookimages/default.jpg";
$info="";
if(isset($_FILES["txtCover"]))
{
if(!$_FILES["txtCover"]['error']== UPLOAD_ERR_NO_FILE)
{
$name = $_FILES["txtCover"]['name'];
$info= new SplFileInfo($name);
//	$newname = "./bookimages/".$_POST["txtISBN"].'.'.$info->getExtension();
//	move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newname);
}	

}


$book = new Book($_POST["txtISBN"],
         $_POST["txtTitle"],
         $_POST["txtYear"],
         $_POST["txtPrice"],
         $newName,
         $_POST["txtDescription"]);


try {

  if(!isset($_SESSION["book"]))
  {	
    
    $newName = "./bookimages/".$_POST["txtISBN"].'.'.$info->getExtension();
    //$BID = $book->GetBID();
    $book->SetCover($newName);
    $BID = $book->Add();
    move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newName);
 //   echo "Book Added";

    echo '<script>alert("Book Added")</script>';
    //unset($_SESSION["book"]);
    $books = Book::GetBooks();

  }
  else
  {
    $book->SetBID($_SESSION["book"]->GetBID());
    //if(!isset($_FILES["txtCover"]))
    $BID = $book->GetBID();
          if($_FILES["txtCover"]['error'] == UPLOAD_ERR_NO_FILE)
      {
        $book->SetCover($_SESSION["book"]->GetCover());
      }
      else{
    
        $name = $_FILES["txtCover"]['name'];
        $info = new SplFileInfo($name);
        $newName= "./Bookimages/".$BID.'.'.$info->getExtension();
        $book->SetCover( $newName);
        move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newName);
      
      
      
      
      
      
      
      }	
      $book->SetBID($_SESSION["book"]->GetBID());
      
      $book->Update();
      $BID=$book->GetBID();
      
      echo '<script>alert("Book Updated")</script>';
      unset($_SESSION["book"]);
      $books = Book::GetBooks();
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
    <title>BookManger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav>
    <div class ="navhome">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="bookmanger.php">Book Manager</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="newsmanager.php">News Manager</a>
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
      <input type="text" class="form-control" placeholder="ISBN" name="txtISBN" id="inputName3"
      require 
			value="<?php 
				if($bookUpdate->GetISBN()!=null)
				{
					echo $bookUpdate->GetISBN();
				}
			
			?>"
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--label for="inputPassword3" class="col-sm-2 col-form-label">Password</label><br-->
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="Book Title" name="txtTitle" id="inputbookTitle"
      require
		value="<?php 
				if($bookUpdate->GetTitle()!=null)
				{
					echo $bookUpdate->GetTitle();
				}
			
			?>"
      
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="year" class="form-control" placeholder="Year" name="txtYear" id="inputYear"
      
      require
		value="<?php 
				if($bookUpdate->GetYear()!=null)
				{
					echo $bookUpdate->GetYear();
				}
			
			?>"
      
      >
    </div>
  </div>
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <input type="number" class="form-control" placeholder="Price" name="txtPrice" id="inputPrice"
      
      require
		value="<?php 
				if($bookUpdate->GetPrice()!=null)
				{
					echo $bookUpdate->GetPrice();
				}
			
			?>"
      
      
      >
    </div>
  </div>


<!-- btn-primary-->

  <input type="file" class=" btn " name="txtCover" id="btnnImageChooser"> 
 
  <?php
		if($bookUpdate->GetCover()!=null)
		{
		echo '<img src="'.$bookUpdate->GetCover().'" 
		width="70px" height="70px">'
		;

		}
		?>		
		
 
 
  <div class="row mb-3">
    <!--div id="head1"> <h1> Login to Admin site</h1></div>
  
    <label for="inputName3" class="col-sm-2 col-form-label">User Name</label-->
    <div class="col-sm-10">
      <textarea  class="form-control" cols="40" rows="10" placeholder="Description" name="txtDescription" id="inputDescription">
      <?php 
if($bookUpdate->GetDescription()!=null)
{
	echo $bookUpdate->GetDescription();
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
  <div class="container">

<?php
 
  if(sizeof($books)>0)
  {


  echo ' <form method="post">
  <br><br>
  <table class="table">';
   echo ' <thead>
      <tr>
        <th scope="col">ISBN</th>
        <th scope="col">Title</th>
        <th scope="col">Year</th>
        <th scope="col">Price</th>
        <th scope="col">Image</th>
        <th scope="col">Description</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>';
 
  $r =0;

  foreach($books as $b)
  {

 echo ' <tr>
     
<td>'.$b->getISBN().' </td>
<td> '.$b->getTitle().' </td>
<td>'.$b->getYear().'</td>
<td>'.$b->getPrice().'</td>
<td><img src="'.$b->getCover().'" width="100px" height="100px"></td>
<td>'.$b->getDescription().'</td>
 

        <td><button type="submit" name="btnUpdate" id="btnUpdateColor" value="'.$r.'">Update</button></td>
        <td><button type="submit"  name="btnDelete" id="btnUpdateColor" value="'.$b->GetBID().'"
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
	//}

		?>


  <form  method="post">
<!--button id="myBtn" title="Go to Login">Logout</button>  <a href="backlogin.php">  </a-->
<input type="submit" id="myBtn" value="Logout" name="btnLOut">
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