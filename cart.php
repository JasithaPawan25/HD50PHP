<?php
require("BO/cartItem.php");
session_start();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
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


<div class="container">
<?php

if(isset($_SESSION['cart']))
        {
   //   echo ' <div class="headerHome"><h2>Your Cart</h2></div>';


      echo ' <form action="" method="POST">';
   
        
            $total=0;
            $cart =$_SESSION['cart'];
            if(isset($_POST["btnRemove"]))
            {
                $i=$_POST["btnRemove"];
                array_splice($cart,$i,1);
                $_SESSION['cart']=$cart;
            }

            if(isset($_POST["btnUpdate"]))
            {
                $i=$_POST["btnUpdate"];
               $cart[$i]->Qty = $_POST["qty"][$i];
               if($cart[$i]->Qty<=0)
               {
                   array_splice($cart,$i,1);
               }
                $_SESSION['cart']=$cart;
            }


            if(sizeof($cart)>0)
            {

              echo ' <div class="headerHome"><h2>Your Cart</h2></div>';

             
 echo '<table class="table">';
  echo '<thead>
    <tr>
      <th scope="col">BookID</th>
      <th scope="col">Book Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Value</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>

    </tr>
  </thead>
  <tbody> ';
  
              $r=0;
              foreach($cart as $i)
              {
                  $item = new CartItem();
                  $item = $i;
                  $cost = $item->Qty * $item->Price;
                  $total =$total+ $cost;

    
    echo '<tr>
    
      <td>'.$item->BID.'</td>
      <td>'.$item->BookName.'</td>
      <td><b>$'.$item->Price.'</b></td>
      <td><input type="number" id="xx" class="form-control" name="qty[]" value="'.$item->Qty.'">
      </td>
      <td><b>$'.$cost.'</b></td>
      <td><button type="submit" name="btnUpdate" value="'.$r.'" id="btnUpdateColor">Update</button></td>
      <td><button type="submit"  name="btnRemove" value="'.$r.'"
      id="btnUpdateColor">Delete</button></td>


    </tr>';

    $r++;

  }

 // echo '<tr><td colspan="4">Total</td><td>$'.$total.'</td></tr>';
  
   echo '</tbody>';
   echo '<tr><td colspan="4"><h3>Total</h3></td><td><h3>$'.$total.'</h3></td></tr>';


 echo '</table> ';

}
else
{
  echo ' <div class="headerHome"><h2>Your Cart is Empty</h2></div>';
}

}
else
{
  echo ' <div class="headerHome"><h2>Your Cart is Empty</h2></div>';
}



?>

</form>

<style>
  #xx
  {
    width: 100px;
  }
</style>

</div>






</main>


<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<style>

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




</style>