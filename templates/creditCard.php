<?php function creditCard(){ ?>
<head>
    <link rel="stylesheet" href="/../css/creditCard.css">
</head>
<div class="container">
  <h2 class="text-center">Credit Card Information</h2>
  <form action="/../actions/action_buy_cartItems.php" id="payment-form">
    <div class="form-group">
      <label for="cardName">Name on Card</label>
      <input type="text" class="form-control" id="cardName" placeholder="Name as it appears on the card" required>
    </div>
    <div class="form-group">
      <label for="cardNumber">Card Number</label>
      <input type="text" class="form-control" id="cardNumber" placeholder="Card number" required>
    </div>
      <div class="form-group col-md-6">
        <label for="expiryDate">Expiry Date</label>
        <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
      </div>
      <div class="form-group col-md-6">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
  </form>
</div>
<?php }?>
