# wordGame
find words in a random string of letters

This is another coding challenge of medium difficulty, written in object oriented PHP, and doesn't use any database - it saves the parameters of a game - the baseword and the user score - in session variables. The game is reset by going to reset.php which deletes the session variables. Then when the WordGame class is called in the index page, if the sessions are empty, it knows to set up a new game.

It starts by creating a random string of letters (baseword session variable) and the user has to submit words they can find in the baseword. The submitted word is checked to see if it is an anagram and also against wordlist.txt to see if it is an English word.

It also maintains a list of successful words that have been submitted, in order of length of the word - the aim of the game being to find the longest word possible in the baseword.

Just for fun, I added pages to the game that search through wordlist.txt looking for all possible anagrams of the baseword and also prints out all the palindromes it can find.

I'd really like to rewrite this project in object oriented Javascript, just for the purposes of trying out oo Javascript.
