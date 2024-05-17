<?php

declare(strict_types = 1);

  class ShippingForm {
    public int $shippingFormID;
    public int $itemID;
    public int $sellerID;
    public int $buyerID;
    public string $date;


    public function __construct(int $shippingFormID, int $itemID, int $sellerID, int $buyerID,  string $date) {
      $this->shippingFormID = $shippingFormID;
      $this->itemID = $itemID;
      $this->sellerID = $sellerID;
      $this->buyerID = $buyerID;
      $this->date = $date;
    }

    static function getShippingForm(PDO $db, int $shippingFormID) {
      $preparedStmt = $db->prepare('SELECT * FROM ShippingForm WHERE shippingFormID = ?');
      $preparedStmt->execute([$shippingFormID]);
      $shippingFormData = $preparedStmt->fetch();
  
      if (!$shippingFormData) {
          throw new Exception("Shipping form not found with ID: $shippingFormID");
          return null;
      }
  
      return new ShippingForm(
          $shippingFormData['shippingFormID'],
          $shippingFormData['itemID'],
          $shippingFormData['sellerID'],
          $shippingFormData['buyerID'],
          $shippingFormData['date']
      );
  }

  static function getShippingFormByItemID(PDO $db, int $itemID) {
    $preparedStmt = $db->prepare('SELECT * FROM ShippingForm WHERE itemID = ?');
    $preparedStmt->execute([$itemID]);
    $shippingForm = $preparedStmt->fetch();

    if (!$shippingForm) {
        throw new Exception("Shipping form not found for itemID: $itemID");
        return null;
    }

    return self::getShippingForm($db, $shippingForm['shippingFormID']);
  }



  static function addShippingForm(PDO $db,int $itemID, int $sellerID, int $buyerID, $currentTime){
    $preparedStmt = $db->prepare("INSERT INTO ShippingForm (itemID, sellerID, buyerID, date ) VALUES ( ?, ?, ?, ?)");
    if ($preparedStmt->execute([ $itemID, $sellerID, $buyerID, $currentTime])) {
      return true;
    } else {
        return false;
    }


  }

    /*--Edit--*/


    /*
  static function editDescription(PDO $db, int $shippingFormID, string $newDescription) {
    $shippingForm = self::getShippingForm($db, $shippingFormID);
    if ($shippingForm->description == $newDescription) {
        return false;
    }
    $preparedStmt = $db->prepare("UPDATE ShippingForm SET description = :newDescription WHERE shippingFormID = :shippingFormID");
    $preparedStmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
    $preparedStmt->bindParam(':shippingFormID', $shippingFormID, PDO::PARAM_INT);
    $preparedStmt->execute();

    if ($preparedStmt->rowCount() > 0) {
      return true;
        //return array("success" => true, "message" => "Description updated successfully for shippingFormID: $shippingFormID");
    } else {
      return false;
        //return array("success" => false, "message" => "Failed to update description for shippingFormID: $shippingFormID");
    }
  }*/


  

  }

?>