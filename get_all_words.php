<?php

// this page relies on some of the methods in the WordGame object.
// it finds all the possible words that can be found in the base string by looping through the wordlist.txt file that contains 65,000 english words

include "class.php";
$wordgame = new WordGame;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>get all words: Word Game</title>
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

<!-- display the base word -->
<div class='text-center my-5'>
  <?php echo "<span class='bg-dark text-white p-2' style='font-size:170%;'>" . $_SESSION["base_word"] . "</span>"; ?>
</div>

<?php

// set up the variables before looping through each word in wordlist.txt
$word_count = 0; // counting the number of words found
$list_of_anagrams = ""; // single string of comma separated words

// open the text file that has all the English words
$wordfile = fopen("wordlist.txt", "r");
$wordlist = fread($wordfile, filesize("wordlist.txt"));

// loop through each word in the text file
foreach(preg_split("/((\r?\n)|(\r\n?))/", $wordlist) as $line) {
  // check to see if the letters in the word are in the base_word, using the test_anagram function
  if ($wordgame->test_anagram($line) == 0 && $line != "") {
    // if it is, we concatenate it to the string of words
    if ($list_of_anagrams !== "") {
      $list_of_anagrams .= ", ";
    }
    $list_of_anagrams .= $line;
    $word_count++;
  }
}

fclose($wordfile);

// display results
echo "<h3><b>$word_count</b> words have been found in the above string of letters :</h3>";

echo "<br><br>";
echo $list_of_anagrams;
echo "<br><br>";
?>



</div>
</body>
</html>
