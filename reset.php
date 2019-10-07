<?php

// reset the game by unsetting the baseword and the word_ranking array

session_start();

if (isset($_SESSION["word_ranking"])){
  session_unset();
}

if (isset($_SESSION["base_word"])){
  session_unset();
}

// return to the index page where the WordGame object will set up a new game

header("Location: index.php");
