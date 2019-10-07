<?php

// we start by setting up the WordGame object
include "class.php";
$wordgame = new WordGame;

// we use a session variable to remember the random string of letters to find words in, ie. the "baseword". a session array also stores the top 10 longest successful words found
// ..so if the session variables are empty, the WordGame sets up a new game, otherwise it will continue with the current game
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Word Game</title>
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

<p class="my-4 my-sm-5">See how many words you can find in the following letters:</p>

<!-- display the base word that the user has to find other words in -->
<div class='text-center mb-sm-5'>
<?php echo "<span class='bg-dark text-white p-2' style='font-size:170%;'>" . $_SESSION["base_word"] . "</span>"; ?>
</div>

<p class="my-4">
<?php
// check if a word has been submitted by the user (in the querystring)
if (isset($_GET["submitted_word"])) {

// send the word to the submitWord function - it will check to see if the word passes the tests
  switch ($wordgame->submitWord($_GET["submitted_word"])) {
// if the function returns 0, no error, word is submitted to the ranking and user congratulated in message
    case '0':
      echo "Well done ! <b>\"" . htmlentities($_GET["submitted_word"]) . "\"</b> is good";
      break;

// 1 - fail, the letters in the submitted word aren't in the base word
    case '1':
      echo "Sorry, <b>\"" . htmlentities($_GET["submitted_word"]) . "\"</b> isn't in the above letters.";
      break;

// 2 - fail, the word is not in the wordlist.txt list of acceptable words
    case '2':
      echo "Sorry, <b>\"" . htmlentities($_GET["submitted_word"]) . "\"</b> isn't in the dictionary.";
      break;
  }

// check to see if the submitted word passes the tests but has already been submitted, so won't appear in the rankings session array
// if the word has not already been submitted then the setUpWordRanking function will add it to the word_ranking session array (as long as it is long enough to be in the top 10 longest words)
  if ($wordgame->submitWord($_GET["submitted_word"]) == 0 && $wordgame->setUpWordRanking() == 1) {
    echo " but it has already been already submitted.";
    }
  else {
    echo ".";
  }
}
?>
</p>

<div class="row form-group mt-0">
  <div class="col-12 col-sm-6">
    <input type="text" class="form-control my-2" name="submitted_word" maxlength="20" placeholder="find word.." required autofocus>
  </div>

  <div class="col-12 col-sm-6 my-2">
    <input type="submit" class="form-control bg-primary text-white border border-dark" value="SUBMIT">
  </div>
</div>

<br>

<?php

// display the word ranking session array
// it contains the top ten successful words submitted in order of word length
if (isset($_SESSION['word_ranking'])) {
  echo "<p style='font-size:120%'; class=''>Results so far:</p>";
  echo "<table class='table'>";

  for ($i = 0; $i < count($_SESSION['word_ranking']); $i++) {
    echo "<td><b>";
    echo $_SESSION['word_ranking'][$i];
    echo "</b></td>";

    echo "<td>(<b>";
    echo strlen($_SESSION['word_ranking'][$i]);
    echo "</b> letters)";
    echo "</td>";
    echo "</tr>";
    echo "</p>";
  }

  echo "</table>";
}
?>


<br><br>
</div>
</form>
</body>
</html>
