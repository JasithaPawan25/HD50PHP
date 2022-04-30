<?php
error_reporting(0);
require("BO/book.php");
include("BO/cartItem.php");
session_start();

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
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
    <a class="nav-link active" aria-current="page"  href="books.php">Books</a>
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
  echo ' <div class="headerHome"><h2>Book Collection</h2></div>';

  echo ' <div class="row row-cols-1 row-cols-md-4 g-4">';

  

  $books= Book::GetBooks();
  $row=0;
  foreach($books as $book)
  {
   // echo ' <div class="row row-cols-1 row-cols-md-5 g-4">';

  echo ' <div class="col">  ';
  echo '  <div id="bookcolor" class="card h-100">';
  echo '    <img src="'.$book->GetCover().'" class="card-img-top" width="50" height="150" alt="...">';
  echo '    <div class="card-body">';
  echo '     <h5 class="card-title">'.$book->GetTitle().'(<h10>'.$book->GetYear().'</h10>)</h5> ';
  echo '    <p class="card-text">'.$book->GetDescription().'This content is a little bit longer.</p>';
  echo '     <h5 class="card-title">$'.$book->GetPrice().'</h5>';


  echo ' <input type="hidden" name="Title[]" value="'.$book->GetTitle().'" >
  <input type="hidden" name="BID[]" value="'.$book->GetBID().'">
  <input type="hidden" name="Price[]" value="'.$book->GetPrice().'" >';


  echo '<input type="number" name="txtQty[]" class="form-control" placeholder="quantity"><br> ';
  //echo '    <a href="#" class="btn btn-primary">Go somewhere</a>';
  echo '<button type="submit" name="btnAdd" class="btn btn-primary" value='.$row.'>Add to Cart</button>';
 

 // echo '    <a href="#" class="btn btn-primary">Go somewhere</a>';
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



</main>


<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<style>

#bookcolor
{
  background-color: #E3F8FF;
}


h7
{
  float: right;
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