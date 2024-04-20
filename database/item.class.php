<?php

declare(strict_types = 1);

  class Item {
    public int $id;
    public int $sellerId;
    public int $categoryId;
    public int $sizeId;
    public int $conditionId;
    public int $statusId;
    public float $price;
    public string $brand;
    public string $model;
    public string $description;
    public string $images;

    public function __construct(int $id, int $sellerId, int $categoryId, int $sizeId, int $conditionId, int $statusId, float $price, string $brand, string $description, string $images) {
      $this->id = $id;
      $this->sellerId = $sellerId;
      $this->categoryId = $categoryId;
      $this->sizeId = $sizeId;
      $this->conditionId = $conditionId;
      $this->statusId = $statusId;
      $this->price = $price;
      $this->brand = $brand;
      $this->description = $description;
      $this->images = $images;
    }
  }

?>