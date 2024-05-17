<?php function editShippingForm(User $user){ ?>
<head>
    <link rel="stylesheet" href="../css/shippingForm.css">
</head>
<main class="shipping"> 

<h1><i class="fa-solid fa-truck"> Shipping</i></h1>
<div class="">
<div class="divisor">
    <form action="/../actions/action_edit_shippingForm.php" method="post">
            <h2><i class="fa-solid fa-person"></i> Buyer</h2>
            <div class="line"> <label for="fname">Name : </label>
            <input type="text" name="name" placeholder="<?php $user->name?>"></div>
            <div class="line"><label for="phone">Phone : </label>
            <input type="number" name="phone" placeholder="<?php $user->phoneNumber?>"></div>
            <div class="line"><label for="email">Email : </label>
            <input type="email" name="email" placeholder="<?php $user->email?>"></div>
            <h2><i class="fa-solid fa-location-dot"></i> Delivery location</h2>
            <div class="line"><label for="address">Address : </label>
            <input type="text" name="address"></div>
            <h2><i class="fa-solid fa-money-check-dollar"></i> Payment : </h2>
            <div class="line">
                <label for="address">CreditCard number : </label>
                <input type="number" name="email"></div>
            </div>
            <input type="submit" value="Buy">
        </form>
    </div>

</main>
<?php } ?>