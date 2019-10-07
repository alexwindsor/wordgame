<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>about: Word Game</title>
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
  <br>
  <h1>About</h1>
  <br>

  <p>This is another coding challenge of medium difficulty, written in object oriented PHP, and doesn't use any database - it saves the parameters of a game - the baseword and the user score - in session variables. The game is reset by going to reset.php which deletes the session variables. Then when the WordGame class is called in the index page, if the sessions are empty, it knows to set up a new game.</p>

  <p>It starts by creating a random string of letters (baseword session variable) and the user has to submit words they can find in the baseword. The submitted word is checked to see if it is an anagram and also against <a href="wordlist.txt">wordlist.txt</a> to see if it is an English word.</p>

  <p>It also maintains a list of successful words that have been submitted, in order of length of the word - the aim of the game being to find the longest word possible in the baseword.</p>

  <p>Just for fun, I added pages to the game that search through wordlist.txt looking for <a href="get_all_words.php">all possible anagrams of the baseword</a> and also prints out all the <a href="palindromes.php">palindromes</a> it can find.</p>

  <p>I'd really like to rewrite this project in object oriented Javascript, just for the purposes of trying out oo Javascript.</p>

</div>
</body>
</html>
