<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="profile.css">
    <title>Document</title>
</head>
<body>
    <header><?php include('topo.php')?></header>
    <main>
        <div class="info">
            <img src="images/leetcode.png" alt="">
            <div class="text">
                <h1>PixelPrincess</h1>
                <h3>Ana Martins</h3>
                <h3>pixelprincess.martins@example.com</h3>
            </div>
            <button>Edit profile</button>
        </div>
        <div class="choice">
            <button><h3>My items</h3></button>
            <button><h3>Analytics</h3></button>
        </div>
        <div class="myItems">
            <div class="condicion">
                <select name="condition">
                    <option value="Active">Active</option>
                    <option value="Sold" selected>Sold</option>
                </select>
            </div>
        </div>
    </main>
</body>
</html>