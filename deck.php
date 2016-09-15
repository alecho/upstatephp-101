<?php
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
      return new Card($suit, $index);
    }

    /**
     * Iterate through a deck and print each card.
     * Returns void.
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
      $card->printHtml();
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
