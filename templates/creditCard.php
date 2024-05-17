<?php function creditCard(){ ?>
<head>
    <link rel="stylesheet" href="/../css/creditCard.css">
</head>
<div class="container">
  <h2 class="text-center">Informações do Cartão de Crédito</h2>
  <form action="/../actions/action_buy_cartItems.php" id="payment-form">
    <div class="form-group">
      <label for="cardName">Nome no Cartão</label>
      <input type="text" class="form-control" id="cardName" placeholder="Nome como aparece no cartão" required>
    </div>
    <div class="form-group">
      <label for="cardNumber">Número do Cartão</label>
      <input type="text" class="form-control" id="cardNumber" placeholder="Número do cartão" required>
    </div>
      <div class="form-group col-md-6">
        <label for="expiryDate">Data de Validade</label>
        <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA" required>
      </div>
      <div class="form-group col-md-6">
        <label for="cvv">CVV</label>
        <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
  </form>
</div>
<?php }?>