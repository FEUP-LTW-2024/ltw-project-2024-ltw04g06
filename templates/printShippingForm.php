<?php function printShippingForm(PDO $db, User $seller, int $itemID){ 
    $item = Item::getItem($db, $itemID);
    $condition = Condition::getCondition($db, $item->conditionID);
    $size = Size::getSize($db, $item->sizeID);
    $category = Category::getCategory($db, $item->categoryID);
    $shipForm = ShippingForm::getShippingFormByItemID($db, $itemID);
    $buyerID = $shipForm->buyerID;
    $buyer = User::getUser($db, $buyerID);
    ?>
<head>
    <link rel="stylesheet" href="../css/shippingForm.css">
</head>
<main class="shipping"> 

<h1><i class="fa-solid fa-truck"> Shipping</i></h1>
<h4>Transaction done at : <?= $shipForm->date?></h4>
    <div class="divisor">
            <h2><i class="fa-solid fa-person"></i> Buyer</h2>
            <div class="line"> <label for="fname">Name : </label>
            <?= $buyer->name ?></div>
            <div class="line"><label for="phone">Phone : </label>
            <?= $buyer->phoneNumber ?></div>
            <div class="line"><label for="email">Email : </label>
            <?= $buyer->email ?></div>
            <h2><i class="fa-solid fa-person"></i> Seller</h2>
            <div class="line"> <label for="fname">Name : </label>
            <?= $seller->name ?></div>
            <div class="line"> <label for="email">Email : </label>
           <?= $seller->email ?>.com</div>
            <h2><i class="fa-solid fa-cart-shopping"></i> Product</h2>
            <div class="line">
                <div class="divisor">
                    <div class="line"><label for="name">Name : </label><?= $item->name ?> </div>
                    <div class="line"><label for="condition">Condition : </label><?= $condition->usage?> </div>
                    <div class="line"><label for="category">Category : </label><?= $category->name ?></div>
                    <div class="line"><label for="size">Size : </label><?= $size->name ?></div>
                    <div class="line"><label for="brand">Brand : </label><?= $item->brand ?> </div>
                    <div class="line"><label for="model">Model : </label> <?= $item->model ?></div>
                </div>
                
                    
                <img src="<?=Item::getImagePic($db, $item)?>" alt="">
        </div>
            <h2><i class="fa-solid fa-location-dot"></i> Delivery location</h2>
            <div class="line"><label for="address">Address : </label>
            <?= $buyer->address?></div>
            <h2><i class="fa-solid fa-money-check-dollar"></i> Payment : </h2>
            <div class="line">
                Paid <?= $item->price?> <i class="fa-solid fa-euro-sign"></i> with Credit Card
            </div>
            <button onclick="window.print();" type="submit" class="print">Print Ship Form</button>
    </div>

</main>
<?php } ?>