<?php
include 'deck.php';
include 'hand.php';
include 'card.php';

$gameName = 'War';

$realDeck = (new Deck())->shuffle();
$hand = new Hand();
$realDeck->deal(7, [$hand]);
$deck = $hand;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $gameName ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1><?= $gameName ?></h1>
      <form action="index.php" method="POST" name="game-setup">
        <input name="number_of_players" type="text">
        <button type="submit">Submit</button>
      </form>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
