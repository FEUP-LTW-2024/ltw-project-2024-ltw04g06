<?php function shippingForm(){ ?>
<head>
    <link rel="stylesheet" href="../css/shippingForm.css">
</head>
<main class="shipping"> 

<h1><i class="fa-solid fa-truck"> Shipping</i></h1>
<div class="profile-setting">
        <form action="/../actions/action_edit_profile.php" method="post">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
            <h2><i class="fa-solid fa-person"></i> Personal infos</h2>
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Enter your first name">
            <br>
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Enter your last name">
            <br>
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your last phone number">
            <br>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">
            <br>
            <h2><i class="fa-solid fa-location-dot"></i> Delivery location</h2>
            <label for="address">Address</label>
            <input type="text" id="Address" name="Address" placeholder="Enter your adress">
            <br>
            <label for="Postal">Postal/Zip Code</label>
            <input type="text" id="Postal" name="Postal" placeholder="Enter your zip code">
            <br>
            <h2><i class="fa-solid fa-money-check-dollar"></i> Payment</h2>
            <p>  > Choose one of the methodes to pay </p>
            <label for="MbWay">MbWay</label>
            <input type="text" id="MbWay" name="MbWay" placeholder="Enter your number for Mbway Payment">
            <br>
            <label for="bank">Bank Account</label>
            <input type="text" id="bank" name="bank" placeholder="Enter your bank account number">
            <br>
            <br><br>
            <input type="submit" value="Buy">
        </form>
    </div>

</main>
<?php } ?>