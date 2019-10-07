<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>code: Word Game</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style>
  .nav-link {
    color: black !important;
  }
  .nav-link:hover {
    text-decoration:underline;
  }
  </style>

</head>
<body style="font-family: 'Oxygen', sans-serif;">
<form action="index.php" method="get">

<div class="jumbotron rounded-0 m-0 py-4"><h1>Word Game</h1></div>

<nav class="navbar navbar-expand-sm sticky-top navbar-light m-0" style="background-color:rgba(0,0,0,0.2);">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span></button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <b><a class="nav-link" href="index.php">HOME</a></b>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reset.php">Reset game</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="get_all_words.php">Show all correct answers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="palindromes.php">Show all paindromes in word list</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="wordlist.txt">Word list text file (1.5mb)</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">View Code</a>
        <div class="dropdown-menu p-0">
        <a class="dropdown-item py-0" href="code.php?file=<?php echo basename($_SERVER["PHP_SELF"]); ?>">This page</a>
        <a class="dropdown-item py-0" href="code.php">All files</a></div>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="../../">Back to Alex Windsor portfolio</a>
      </li>
    </ul>
  </div>
</nav>


<div class="container">

  <div class="container">
  <br>
  <h1>View Server Code</h1>


  <?php
  // if there is a filename in the querystring, we display the contents of the file here
  if (isset($_GET["file"]) && file_exists($_GET["file"])) {
    echo "<h3>" . $_GET["file"] . "</h3>";
    ?>
    <br>
    [<a href="code.php">View All Files</a>]
    <hr>
    <?php
    // display contents of file with php highlighting
    echo highlight_string(file_get_contents($_GET["file"]), true);
    ?>
    <br>
    <hr>
    [<a href="code.php">View All Files</a>]
    <?php
  }


  // otherwise we list all the files including in classes and includes subfolder
  else {
    foreach (glob("*", GLOB_ONLYDIR) as $folder) {
      echo "/" . $folder . "<br>";
      $files = glob($folder . "/*.*");
      foreach ($files as $file) {
      ?>
        <a href="code.php?file=<?php echo $file ?>" style="margin-left:40px;"><?php echo $file ?></a><br>
      <?php
      }
    }

    echo "<br>";
    $files = glob("*.*");

    foreach ($files as $file) {
      ?>
      <a href="code.php?file=<?php echo $file ?>"><?php echo $file ?></a><br>
      <?php
    }
  }

  echo "<br><br>";
   ?>


  </div>


</div>
</body>
</html>
