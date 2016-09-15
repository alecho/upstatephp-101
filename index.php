<?php
$gameName = 'War';

class Deck
{

    private $suits = ['S', 'H', 'C', 'D'];
    private $indices = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
    protected $deck = [];

    public function __construct()
    {
      $this->create();
    }

    /**
     * Returns and array of arrays representing cards
     * in a specific order.
     */
    public function create()
    {
      $this->deck = [];
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
    private function createCard($suit, $index)
    {
      return ['suit' => $suit, 'index' => $index];
    }

    /**
     * Iterate through a deck and print each card.
     * Returns void.
     * NOTE: This function name won't work on < PHP 7
     * This is because `print` is a reserved word. In
     * PHP 7 it seems that PHP is smart enough to realize
     * that it's a function name and not a keyword.
     */
    public function printPreformatted()
    {
      echo '<pre>';
      foreach($this->deck as $card) {
        $this->printCard($card);
      }
      echo '</pre>';

      return $this;
    }

    /**
     * Shuffles a deck regardless of the deck's current
     * state and reutns the shuffled deck;
     */
    public function shuffle()
    {
      shuffle($this->deck);

      return $this;
    }

    /**
     * Return the number of cards the deck
     */
    public function size()
    {
      return count($this->deck);
    }

    /**
     * Return the last card from the deck, shortening
     * the deck by one card. With a face down deck this
     * is equivalant to dealing a single card.
     */
    public function pop()
    {
      return array_pop($this->deck);
    }

    /**
     * Add a card to the end of a deck. With a face down
     * deck this is equivalant to putting a card back on
     * top of the deck.
     */
    public function push($card)
    {
      return array_push($this->deck, $card);
    }

    /**
     * Remove and return the first card in the deck. With
     * a face down deck this is equivalant to dealing the
     * bottom card.
     */
    public function shift()
    {
      return array_shift($this->deck);
    }

    /**
     * Prepends a card to the beginning of the deck. With
     * a face down deck this is equivalant putting the card
     * on the bottom of the deck.
     */
    public function unshift($card)
    {
      return array_unshift($this->deck, $card);
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

    public function cardSort()
    {
      if ($this->deck->size() == 52) {
        return $this->create();
      }
    }

    public function deal($cardsPerHand = 1, $hands = [])
    {
      for ($i=0; $i < $cardsPerHand; $i++) {
        foreach ($hands as $hand) {
          $hand->push($this->pop());
        }
      }
    }
}

class Hand extends Deck
{
    public function __construct()
    {
      $this->create();
    }

    /**
     * Returns and array of arrays representing cards
     * in a specific order.
     */
    public function create()
    {
      return $this;
    }

    public function cardSort()
    {
      return array_multisort($this->deck);
    }

}

/**
 * Returns an array with $hands number of new Deck
 * class objects with no more than $limit cards per
 * hand.
 */
function deal($deck, $hands = 2, $limit = null)
{
  // We don't need 'hands' and 'deck' keys here but we
  // should return an array. Try renaming $out to $hands
  // in this method.
  $out = ['hands' => [], 'deck' => null];
  if ($limit == null) {
    $limit = count($deck);
  }

  for($i=0; $i<$limit; $i++) {
    // This looks a lot like out new `pop()` method
    $topAndDeck = getTopCardFromDeck($deck);
    // We won't need to keep track of the deck here
    $deck = $topAndDeck['deck'];
    // Hmm... Hands seems a lot like decks. We should be
    // able to return an array of decks
    $out['hands'][($i % $hands)][] = $topAndDeck['card'];
  }

  // We don't need to return the deck. Our `$deck` property
  // keeps track of it for us.
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
      <h3>New Deck:</h3>
      <?php
        $realDeck = (new Deck())->shuffle();
        $hand = new Hand();
        $realDeck->deal(7, [$hand]);
        $deck = $hand;
        $deck->printPreformatted();
      ?>
      <h3>Pop:</h3>
      <?php
        $card = $deck->pop();
        $deck->printPreformatted();
      ?>
      <h3>Push (our poped card):</h3>
      <?php
        $deck->push($card);
        $deck->printPreformatted();
      ?>
      <h3>Shift:</h3>
      <?php
        $card = $deck->shift();
        $deck->printPreformatted();
      ?>
      <h3>Unshift (our shifted card):</h3>
      <?php
        $deck->unshift($card);
        $deck->printPreformatted();
      ?>
      <h3>Shuffle</h3>
      <?php
        $deck->shuffle();
        $deck->printPreformatted();
      ?>
        <h3>Sort</h3>
      <?php
        $deck->cardSort();
        $deck->printPreformatted();
      ?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
