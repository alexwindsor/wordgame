<?php
// just for fun I wrote a script that looped through the contents of wordlist.txt looking for palindromes (words that spell the same backwards as forwards) and there's surprisingly few

// (we don't need the WordGame object here)
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>all the palindromes: Word Game</title>
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
<h1 class="my-4">All the Palindromes</h1>
<?php
// loop through wordlist.txt and check each word to see if it is a palindrome, ie. see if the word is the same as the reverse of the word
$count = 0; // counting the number of palindromes found
$palindromes = ""; // comma separated string of all palindromes concatenated

// open wordlist.txt
$wordfile = fopen("wordlist.txt", "r");
$wordlist = fread($wordfile, filesize("wordlist.txt"));

// start the loop
foreach(preg_split("/((\r?\n)|(\r\n?))/", $wordlist) as $line) {
  // check if it is a palindrome
  if (strrev($line) === $line) {
    if ($palindromes !== "") {
      $palindromes .= ", ";
    }
    // add the palindrome to the string with a comma
    $palindromes .= $line;
    $count++;
    }
}
fclose($wordfile);

echo "<h3><b>$count</b> palindromes have been found in the wordlist.txt file :</h3>";

echo "<br>";
echo $palindromes;
echo "<br><br>";

?>
<a href="index.php" class="button">wordgame</a>  <a href="wordlist.txt" class="button">word list text file (1.5mb)</a>

</body>
</html>
