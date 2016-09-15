<?php

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
