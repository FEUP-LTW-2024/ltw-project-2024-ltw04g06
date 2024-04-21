<?php

declare(strict_types = 1);

  class ShippingForm {
    private int $shippingFormID;
    private int $itemID;
    private int $sellerID;
    private int $buyerID;
    private string $address;
    private string $date;


    public function __construct(int $shippingFormID, int $itemID, int $sellerID, int $buyerID, string $address, string $date) {
      $this->shippingFormID = $shippingFormID;
      $this->itemID = $itemID;
      $this->sellerID = $sellerID;
      $this->buyerID = $buyerID;
      $this->address = $address;
      $this->date = $date;
    }
  }

?>