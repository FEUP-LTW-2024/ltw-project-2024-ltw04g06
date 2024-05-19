<?php function creditCard($session){ ?>
<head>
    <link rel="stylesheet" href="/../css/creditCard.css">
</head>
<div class="container">
  <h2 class="text-center">Credit Card Information</h2>
  <form action="/../actions/action_buy_cartItems.php" method ="post" id="payment-form"  onsubmit="encodeAndSendMessage(event, 'payment-form', '/../actions/action_buy_cartItems.php')">
    <div class="form-group">
      <label for="cardName">Name on Card</label>
      <input type="text" class="form-control" id="cardName" name = "cardName" placeholder="Name as it appears on the card" required>
    </div>
    <div class="form-group">
      <label for="cardNumber">Card Number</label>
      <input type="text" class="form-control" id="cardNumber" name="cardNumber"  placeholder="Card number" required>
    </div>
      <div class="form-group col-md-6">
        <label for="expiryDate">Expiry Date</label>
        <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
      </div>
      <div class="form-group col-md-6">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" name="cvv" placeholder="CVV" required>
    </div>
    <?php 
            $session->displayMessages();
            ?>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
  </form>
</div>
<?php }?>
