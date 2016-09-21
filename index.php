<?php
include 'deck.php';
include 'hand.php';
include 'card.php';

$gameName = 'War';
$post = $_SERVER['REQUEST_METHOD'] == 'POST';

if ($post) {

  $deck = (new Deck())->shuffle();
  $hands = [];
  for($i=0; $i < $_POST['number_of_players']; $i++) {
    $hands[] = new Hand();
  }
  $deck->deal(7, $hands);
  #$deck = $hand;

}

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
        <label for="number_of_players">Number of Players</label>
        <input
          id="number_of_players"
          name="number_of_players"
          type="email"
        >
        <button type="submit">Submit</button>
      </form>

      <?php foreach ($hands as $num => $hand) {
        echo 'Hand #' . ($num + 1);
        $hand->printPreformatted();
      } ?>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
