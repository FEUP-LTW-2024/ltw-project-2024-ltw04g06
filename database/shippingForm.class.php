<?php

declare(strict_types = 1);

  class ShippingForm {
    private int $id;
    private int $itemId;
    private int $sellerId;
    private int $buyerId;
    private string $address;
    private string $date;


    public function __construct(int $id, int $itemId, int $sellerId, int $buyerId, string $address, string $date) {
      $this->id = $id;
      $this->itemId = $itemId;
      $this->sellerId = $sellerId;
      $this->buyerId = $buyerId;
      $this->address = $address;
      $this->date = $date;
    }
  }

?>