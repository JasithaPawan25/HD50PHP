
<?php
include("BO/newsbo.php");

session_start();






?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
    <a class="nav-link active" aria-current="page" href="news.php">News</a>
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
    <a class="nav-link"  href="contact.php">Contact</a>
  </li>
</ul>
</div>
</nav>
<main>

<div class="container">
  <!-- Content here -->
  
  <div class="headerHome" ><a href="news.php" <h4 class="card-headnews-title"><< Back to News </h4> </a> <!--a href="news.php"><< Back to News</a></h4-->

<style>



.card-headnews-title
  {
    text-decoration: none;
  }

</style>

  <!--
  <div class="card mb-3">
  <img src="jk/jk4.jpg" class="card-img-top" alt="..." width="100" height="100">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div> -->

  <form method="post">

      <?php
      if(isset($_GET['PID']))
      {
     //   echo $_GET['PID'];
        $POID =$_GET['PID'];

        

        $products =News::GetNewsDes($POID);
        $row=0;
        foreach($products as $news)
        {



  echo ' <div class="card" style="width: 30rem;">';
  echo '  <img src="'.$news->GetNCover().'" width="200" height="500" class="card-img-top" alt="...">';
  echo ' <div class="card-body">';
  echo ' <h5 class="card-title">'.$news->GetNTitle().'</h5>';
  echo ' <p class="card-text"><small class="text-muted">'.$news->GetNdate().'</small></p>';

  echo '   <p class="card-text">'.$news->GetNDescription().'</p>';
  echo ' </div>';
  echo '</div>';

  echo '</div>';
        }

      }
?>


</form>

</div>

</main>


<footer>All rights Received by Jasitha Pawan 2021</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

<style>

    .card
    {
        margin-left: 25%;
        margin-top: 5%;
    }


.headerHome
{
    margin: 20px;
    font-family: 'Times New Roman', Times, serif;
    font-size: 1.5em;
    text-decoration: none;

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