<?php function editShippingForm(User $user, Session $session){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/shippingForm.css">
    <title>Edit Shipping Form</title>
</head>
<body>
<main class="shipping"> 

<h1><i class="fa-solid fa-truck"></i> Shipping</h1>
<div class="">

<div class="divisor">
    <form action="/../actions/action_edit_shippingForm.php" method="post" onsubmit="encodeAndSendMessage(event, 'edit-ship-form', '/../actions/action_edit_shippingForm.php')">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <h2><i class="fa-solid fa-person"></i> Buyer</h2>
            <div class="line">
                <label for="fname">Name:</label>
                <input type="text" name="name" placeholder="<?= htmlspecialchars($user->name, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="line">
                <label for="phone">Phone:</label>
                <input type="number" name="phone">
            </div>
            <div class="line">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="<?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <h2><i class="fa-solid fa-location-dot"></i> Delivery location</h2>
            <div class="line">
                <label for="address">Address:</label>
                <input type="text" name="address">
            </div>
            <h2><i class="fa-solid fa-money-check-dollar"></i> Payment:</h2>
            <div class="line">
                <label for="creditcard">CreditCard number:</label>
                <input type="number" name="creditcard">
            </div>
            <?php 
            $session->displayMessages();
            ?>
            <input type="submit" value="Buy">
        </form>
    </div>

</main>
</body>
</html>
<?php } ?>
