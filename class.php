<?php


class WordGame {

	public $base_word;
	public $submitted_word;
	public $errorflag;
	public $word_ranking;


	function __construct() {

		session_start();

		// check first to see if there is a base word in the session variables
		// if not then we set up a new game with a new base_word - a random sequence of letters for the user to find valid english words in
		if (!isset($_SESSION["base_word"])) {

			$this->base_word = "";

			// generate random number between 9 and 16 for a varied length for string of random letters
			$rand_word_length = rand(9, 16);

			//add random letters between a and z to the string of random letters
			for ($i = 0; $i <= $rand_word_length; $i++) {
			$this->base_word = $this->base_word . chr(rand(97,122));
		}

		// to make the game a bit more realistic, we add four random vowels to the string of random letters
		$extravowels = "";

		for ($i = 0; $i <= 3; $i++) {
			$vowel = rand(1,5);
			switch ($vowel) {
				case 1: $extravowels = $extravowels . "a"; break;
				case 2: $extravowels = $extravowels . "e"; break;
				case 3: $extravowels = $extravowels . "i"; break;
				case 4: $extravowels = $extravowels . "o"; break;
				case 5: $extravowels = $extravowels . "u"; break;
			}
		}

		$this->base_word = $this->base_word . $extravowels;
		session_unset();
		$_SESSION["base_word"] = $this->base_word;
		}

		// return the randomly generated string of characters

	} // end of __construct function


	public function submitWord($word) {
		// this function takes a word submitted by the user and checks if it is valid. if it is valid, it returns 0, or if it isn't valid, it returns 1 if it is not an anagram of the baseword and 2 if it is an anagram but not a word in the wordlist.txt file

		$this->submitted_word = $word;

		$this->base_word = $_SESSION["base_word"];
		$word_ranking = "";
		// set up the variables we will need for the test
		$this->errorflag = 0; // 0 = no error, 1 = word not an anagram, 2 = word not in dictionary
		$score = 0; // score is length of submitted word if it passes the two tests

		// make everything lowercase for comparison
		$this->submitted_word = strtolower($this->submitted_word);




		// =====
		// first test to see if the submitted word is an anagram of the string of random letters

		// we call the function test_anagram that returns a 1 if it fails the test, 0 if it passes
		$this->errorflag = $this->test_anagram($this->submitted_word);

		// check to see if submitted word passed the first test (is anagram of base_word)
		if ($this->errorflag === 0) {
			// ===========
			// second test to see if submitted_word is in wordlist.txt

			$wordfile = fopen("wordlist.txt", "r");
			$wordlist = fread($wordfile, filesize("wordlist.txt"));

			foreach(preg_split("/((\r?\n)|(\r\n?))/", $wordlist) as $line) {
				if ($this->submitted_word == $line) {
					$score = strlen($this->submitted_word);
				}
			}

			fclose($wordfile);

			if ($score == 0) {
			// we didn't find the word in wordlist.txt so we flag the error
			$this->errorflag = 2;
			}
		}

		return $this->errorflag;

	} // end of submitWord function


	public function test_anagram($word) {

		// =====
		// first test to see if the submitted word is an anagram of the string of random letters
		$errorflag = 0;
		$chk_baseword = $_SESSION["base_word"]; // replicate the baseword to another variable so that each time a letter in the submitted word is found in the baseword, that character can then be removed (each letter can only be used once to make the anagram)

		// loop through each character in the submitted word
		for ($i = 0; $i < strlen($word); $i++) {

			// if the character cannot be found in the base string
			if (strpos($chk_baseword, substr($word, $i, 1)) === FALSE) {
				// flag the error and break out of the loop
				$errorflag = 1;
				break;
			}
			else {
				// the character is found in the string, so we remove that character from the base string before checking the next character
				$chk_baseword = substr_replace($chk_baseword, "", strpos($chk_baseword, substr($word, $i, 1)), 1);
			}

		} // end of loop

		return $errorflag;

	} // end of test_anagram function


	public function setUpWordRanking() {
	// if the word is successful then we add it to the ranking stored in the session variable

	$already = 0; // flags that submitted word can't be added because already in the list

	// check if there is no session
	if (!isset($_SESSION["word_ranking"])) {
	// there's no session so we create one, inserting the submitted word at the top
		$_SESSION['word_ranking'][0] = $this->submitted_word;
		$this->word_ranking = $_SESSION['word_ranking'];
	}

	else { // there's a session so we need to loop through it and see if we should insert the submitted word into the list

		// set the flag variables before looping through the contents of the session variable

		$inserted = 0; // indicates if submitted word has been already inserted


		// start looping through the session
		foreach($_SESSION['word_ranking'] as $rank=>$word) {
			// check if word is already on the list
			if ($word == $this->submitted_word) {
				// already on list so we copy the session to $word_ranking array and break out of the loop
				$this->word_ranking = $_SESSION['word_ranking'];
				$already = 1;
				break;
			}

			// check if submitted word is longer than the current word in the session array loop
			if (strlen($this->submitted_word) > strlen($word)) {
				// check to see if it has already been inserted
				if ($inserted == 0) {
					// so we add it to the list
					$this->word_ranking[$rank] = $this->submitted_word;
				}
				// indicate not to reinsert the word
				$inserted = 1;
			}

			// copy the session to $word_ranking array, incrementing if necessary to make way for new insertion
			$this->word_ranking[$rank + $inserted] = $word;
		} // end of loop


		// if submitted word has not yet been submitted then we can stick it on the end
		if ($already == 0 && $inserted == 0) {
			$this->word_ranking[count($_SESSION['word_ranking'])] = $this->submitted_word;
		}

		// we truncate the array to make it no more than 10 words long
		$this->word_ranking = array_slice($this->word_ranking, 0, 10);

		// copy the array to the session
		$_SESSION['word_ranking'] = $this->word_ranking;

		}

	return $already;


	} // end of setUpWordRanking function


} // end of WordGame class


?>
