
<?php
require("BO/gallery.php");
session_start();



?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
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
    <a class="nav-link active" aria-current="page" href="gallery.php">Gallery</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="about.php">About</a>
  </li>
  <li class="nav-item">
    <a class="nav-link"  href="contact.php">Contact</a>
  </li>
</ul>
</div>
</nav>
<main>


<?php

 echo '<form  method="post">';
 echo '<div class="container">';

 echo '<div class="headerHome"><h2>ROWLING s Gallery</h2></div>';

 echo '<div class="row row-cols-1 row-cols-md-2 g-4">';


 $gallerys= gallery::GetGallery();
 $row=0;
 foreach($gallerys as $gallery)
 {

 echo ' <div class="col">';
 echo ' <div class="card">';
 echo '  <img src="'.$gallery->GetImgae().'" class="card-img-top" alt="...">';
 echo '   <div class="card-body">';
 echo '     <h5 class="card-title">'.$gallery->GetSGN().'</h5>';
 echo '      <p class="card-text">'.$gallery->GetDescription().'
</p>';
 echo '    </div>';
 echo '  </div>';
 echo ' </div>';



$row++;
 }

 echo ' </div>';
 echo ' </div>';

 echo ' </form>';

  ?>

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



</style>