<?php

class Card
{

  protected $suit = null;

  protected $value = null;

  public function __construct($suit, $value)
  {
    $this->suit = $suit;
    $this->value = $value;
  }

  public function printHtml()
  {
    echo '<span class="' . $this->color() . '" style="color: ' . $this->color() . ';">';
    echo $this->prettyValue() . $this->htmlSuit() . "\n";
    echo '</span>';
  }

  private function htmlSuit()
  {
    $suitHtmlMap = [
      'S' => '&spades;',
      'D' => '&diams;',
      'C' => '&clubs;',
      'H' => '&hearts;',
    ];

    return $suitHtmlMap[$this->suit];
  }

  private function prettyValue()
  {
    $valueMap = [
      1  => 'A',
      11 => 'J',
      12 => 'K',
      13 => 'Q',
    ];

    if (array_key_exists($this->value, $valueMap)) {
      return $valueMap[$this->value];
    }

    return $this->value;
  }

  private function color()
  {
    $color = 'black';
    if ($this->suit == 'H' || $this->suit == 'D') {
      $color = 'red';
    }
    return $color;
  }
}
