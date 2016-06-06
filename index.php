<?php
$gameName = 'War';

class Deck
{

    public $suits = ['S', 'H', 'C', 'D'];
    public $indices = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    public $deck = [];

    /**
    public function __construct()
    {
      $this->create();
    }
     */

    /**
     * Returns and array of arrays representing cards
     * in a specific order.
     */
    public function create()
    {
      foreach($this->suits as $suit) {
        foreach($this->indices as $index) {
          $this->deck[] = $this->createCard($suit, $index);
        }
      }

      return $this;
    }

    /**
     * Return an array with indices for _properties_
     * of a playing card.
     */
    public function createCard($suit, $index)
    {
      return ['suit' => $suit, 'index' => $index];
    }

    /**
     * Iterate through a deck and print each card.
     * Returns void.
     */
    public function print()
    {
      echo '<pre>';
      foreach($this->deck as $card) {
        $this->printCard($card);
      }
      echo '</pre>';
    }

    /**
     * Echo a card suitable for HTML display
     */
    public function printCard($card)
    {
      $suit = '';
      if ($card['suit'] == 'S') {
        $suit = '&spades;';
      }
      if ($card['suit'] == 'D') {
        $suit = '&diams;';
      }
      if ($card['suit'] == 'C') {
        $suit = '&clubs;';
      }
      if ($card['suit'] == 'H') {
        $suit = '&hearts;';
      }
      echo $card['index'] . $suit . "\n";
    }

}

$deck1 = new Deck();
$deck1 = $deck1->create();
$deck2 = new Deck();
$deck3 = new Deck();
$deck1->print();
exit;

/**
 * Suffles a deck regardless of the deck's current
 * state and reutns the shuffled deck;
 */
function shuffleDeck($deck = [])
{
  shuffle($deck);
  return $deck;
}

/**
 * Returns an array with 'card' and 'deck'.
 */
function getTopCardFromDeck($deck)
{
  $card = array_pop($deck);
  return ['card' => $card, 'deck' => $deck];
}


/**
 * Returns an array with $hands number of arrays
 * with no more than $limit cards per hand under
 * 'hands' key and the remaining cards in the deck
 * in the 'deck' key.
 */
function deal($deck, $hands = 2, $limit = null)
{
  $out = ['hands' => [], 'deck' => null];
  if ($limit == null) {
    $limit = count($deck);
  }

  for($i=0; $i<$limit; $i++) {
    $topAndDeck = getTopCardFromDeck($deck);
    $deck = $topAndDeck['deck'];
    $out['hands'][($i % $hands)][] = $topAndDeck['card'];
  }

  $out['deck'] = $deck;

  return $out;
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
      <?php
      $deck = createDeck();
      printDeck($deck);
      $deck = shuffleDeck($deck);
      printDeck($deck);

      $result = deal($deck, 2);
      $hands = $result['hands'];
      foreach($hands as $num => $hand) {
        echo '<h2>Hand ' . $num. '</h2>';
        printDeck($hand);
      }
      ?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
