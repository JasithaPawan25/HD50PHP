<?php
error_reporting(0);
include ("BO/newsbo.php");

//require_once("classes.php");

include("BO/book.php");
include("BO/cartItem.php");

session_start();





?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<nav>

    <div class="navhome">
<ul class="nav nav-pills">
<h1><div id="headerAuthor">JK ROWLING</div></h1>

  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="books.php">Books</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="news.php">News</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="cart.php">Cart</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="gallery.php">Gallery</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="about.php">About</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="contact.php">Contact</a>
  </li>
</ul>
</div>
</nav>
<main>


  <?php
    echo '<form  method="post"> '; 
    echo '<div class="container">';
  echo ' <div class="headerHome"><h2>Latest Books</h2></div>';

  echo ' <div class="row row-cols-1 row-cols-md-4 g-4">';

  

  $books= Book::GetHomeBook();
  $row=0;
  foreach($books as $book)
  {
   // echo ' <div class="row row-cols-1 row-cols-md-5 g-4">';

  echo ' <div  class="col">  ';
  echo '  <div id="bookcolor" class="card h-100">';
  echo '    <img src="'.$book->GetCover().'" class="card-img-top" width="50" height="150" alt="...">';
  echo '    <div class="card-body">';
  echo '     <h5 class="card-title">'.$book->GetTitle().' (<h10>'.$book->GetYear().'</h10>)</h5>';
  echo '    <p class="card-text">'.$book->GetDescription().'This content is a little bit longer.</p>';
  echo '     <h5 class="card-title">$'.$book->GetPrice().'</h5>';

  echo ' <input type="hidden" name="Title[]" value="'.$book->GetTitle().'" >
  <input type="hidden" name="BID[]" value="'.$book->GetBID().'">
  <input type="hidden" name="Price[]" value="'.$book->GetPrice().'" >';


  echo '<input type="number" name="txtQty[]"  class="form-control" placeholder="quantity"><br> ';
  //echo '    <a href="#" class="btn btn-primary">Go somewhere</a>';
  echo '<button type="submit" name="btnAdd" class="btn btn-primary" value='.$row.'>Add to Cart</button>';
  echo ' </div>';  
  echo ' </div>'; 
  echo ' </div>'; 
 


  $row++;
}

echo ' </div>'; 
echo ' </div>'; 
//echo ' </div>'; 

  //echo '</div>

 echo '</form>';
  ?>


<?php
    // && isset($_POST["txtQty"])
      if(isset($_POST["btnAdd"])&&isset($_POST["txtQty"]))
      {
            $r=$_POST["btnAdd"];
            if(!isset($_SESSION["cart"]))
            {
                $mycart = array();
                $_SESSION["cart"] = $mycart;
            }

             $mycart= $_SESSION["cart"];
             $found = false;
             if(sizeof($mycart)!=0)
             {
                 foreach($mycart as $item)
                 {
                     $cartItem = new CartItem();
                     $cartItem = $item;
                     if($cartItem->BID ==$_POST["BID"][$r])
                     {
                         $qty = $cartItem->Qty;
                         $cartItem->Qty = $qty + $_POST["txtQty"][$r];
                         $found = true;
                         break;
                         
                         

                     }
                 } 
            }

                 if(!$found)
                 {
                    $cartItem = new CartItem();
                    $cartItem->BID = $_POST["BID"][$r];
                    $cartItem->Qty = $_POST["txtQty"][$r];
                    $cartItem->BookName = $_POST["Title"][$r];
                    $cartItem->Price = $_POST["Price"][$r];
                    array_push($mycart,$cartItem);


                 }else
                 {
                     
                     header("home.php");
                   //  exit();
                     

                 }

                 $_SESSION["cart"]=$mycart;
                 echo '<script>alert("Book Added to the Cart")</script>';;

                /* echo "Added to the Cart";*/
             
        }

        else{

                header("home.php");
              // exit();

           /*    try {
                    echo "Please Add Book Quntity to buy!!!";
                } catch (Exception $th) {
                    echo $th;
                }*/
               
            }

    ?>



  


<?php

echo '<form  method="post"> '; 

 echo '<div class="container">';
//<!-- Content here -->
 
echo '<div class="headerHome"><h2>Latest News</h2></div>';

echo '<div class="row row-cols-1 row-cols-md-1 g-4">';
//<!--div class="col"-->
$newss= News::GetHomeNews();
  $row=0;
  foreach($newss as $news)
  {
    $newscon=$news->GetNDescription();

    $string = strip_tags($newscon);
    if(strlen($string)>500)
    {
      $stringCut = substr($string,0,500);
      $openStr =substr($string,201,5000);
      $endPoint= strpos($stringCut,' ');
      $string=$endPoint?substr($stringCut,0,200):substr($stringCut,100);
 //     $string=$endPoint?substr($stringCut,0,$endPoint):substr($stringCut,100);
      $string.='...<a  href="newspage.php?PID='.$news->GetNID().'">readmore</a>';
  }
    else
    {
      //echo
       $string;

    }

    if(isset($_POST['readmore']))
    {
     $newscon;
    }


   
echo ' <div id="newscolor" class="card mb-3" style="max-width: auto;">';
echo ' <div class="row g-0">';
echo ' <div class="col-md-1">';
echo '  <img src="'.$news->GetNCover().'" width="100" height="100" class="img-fluid rounded-start" alt="...">';
echo '</div>';
echo ' <div class="col-md-10">';
echo ' <div class="card-body">';
echo ' <a  href="newspage.php?PID='.$news->GetNID().'"<h2 class="card-headnews-title">'.$news->GetNTitle().'</h2></a>';
echo '  <p class="card-text">  '. $string.' 

</p>';

if(isset($_POST['readmore']))
{
 echo $newscon;
}


echo ' <p class="card-text"><small class="text-muted">'.$news->GetNdate().'</small></p>';
echo '  </div>';
echo ' </div>';
echo '</div>';
echo '</div>';


$row++;
}



echo '</div>';



//'.$news->GetNDescription().'



echo '</form>';

?>


<style>

  .card-headnews-title
  {
    text-decoration: none;
  }
</style>




<div class="container">
  <!-- Content here  "jk/jk10.jpg" -->

  <div class="headerHome"><h2>About ROWLING</h2></div>

  <div class="row row-cols-1 row-cols-md-1 g-4">
  <!--div class="col"-->

  
  <div class="card mb-3" style="max-width: auto;">
  <div class="row g-0">
    <div class="col-md-7">
      <img src="jk/jk4.jpg" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-5">
      <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text">
        Joanne Rowling (born 31 July 1965), better known by her pen name J. K. Rowling, is a British author, philanthropist, film producer, television producer, and screenwriter. She is best known for writing the Harry Potter fantasy series, which has won multiple awards and sold more than 500 million copies, becoming the best-selling book series in history.The books are the basis of a popular film series, over which Rowling had overall approval on the scripts and was a producer on the final films. She also writes crime fiction under the pen name Robert Galbraith.
Born in Yate, Gloucestershire, Rowling was working as a r
esearcher and bilingual secretary for Amnesty International in 1990 when she conceived the 
idea for the Harry Potter series while on a delayed train from Manchester to London.The 
seven-year period that followed saw the death of her mother, birth of her first child, 
divorce from her first husband, and relative poverty until the first novel in the series, Harry Potter
 and the Philosopher's Stone, was published in 1997. There were six sequels, of which the last 
 was released in 2007.
        </p>
        <p class="card-text"><small class="text-muted"></small></p>
      </div>
    </div>
  </div>
 </div>


</div>






</main>


<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>












<style>

#newscolor
{
background-color:#EEEEEE; /*  #D6E6F2;*/
}

#bookcolor
{
  background-color: #E3F8FF;
}

.card-textid
{
  margin-top: 30%;
  font-family: 'Times New Roman', Times, serif;
  font-size: 1.5em;
  
  font: bolder;
  color: black;
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