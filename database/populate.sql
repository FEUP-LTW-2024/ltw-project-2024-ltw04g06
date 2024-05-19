
INSERT OR IGNORE INTO User (userID, username, password, name, email, role, imageID, aboutMe, address, phoneNumber, wishlistID,shoppingCartID)
VALUES 

    (1, 'john_doe', '$2y$12$NASz60qmC5EAA4h3M600MuASJS/MSR6u/RQxw84wqgubP.WI3WQGa', 'John Doe', 'john@example.com', 'Admin', 22,'sou o john_doe!', 'rua das bolachas ,4760-666,Portugal',910532024, 1, 1), /*john_doe1*/
    (2, 'jane_doe', '$2y$12$xHXoLY8wiUABnGk.31CSR.zcH7w.g5YxNwmwqdK8w/Z3Rs9jFAY8S', 'Jane Doe', 'jane@example.com', 'User',  23,'sou a jane_doe!', 'rua dos donuts, 1234-567,Portugal',919191919, 2, 2),/*jane_doe1*/
    (3, 'Toze', '$2y$12$6J33f9haGmoQgUzn5InhwuZb5K7Iq9yogx5nGddwwoDGkmUhZDucm', 'Toze', 'jane2@example.com', 'User', 24, 'Silent but deadly funny!', 'rua dos alecrins, 8005-332,Portugal',910000019, 3, 3),/*Toze_pt1*/
    (4,'alice_wonderland', '$2y$12$ycs1DsuXiyEr500G1y6ig.fFs/yqYNZW7EEvsoMN70ewY0U4xnlbW', 'Alice Wonderland', 'alice@example.com', 'User', 25, 'I love adventures!', '123 Wonderland St, Wonderland', 123456789, 4, 4),/*alice_wonder1*/
    (5,'bob_builder', '$2y$12$saf6Zn3d/2boBnFCm93a8.7UFyx01afZuNBBN8RpjKOYlbbPUUTl.', 'Bob Builder', 'bob@example.com', 'User', 26, 'Can we fix it? Yes, we can!', '456 Construction Ave, Builderland', 987654321, 5, 5),/*bob_builder1*/
    (6,'charlie_chaplin', '$2y$12$SAFuJkl4jLcX60eq3U/uQusWxaxi7PvNncPZOVGjKnXiwhkrqcDp2', 'Charlie Chaplin', 'charlie@example.com', 'User', 27, 'Silent but deadly funny!', '789 Comedy Rd, Chaplinville', 246810975, 6, 6);/*charlie_chaplin1*/


INSERT OR IGNORE INTO Wishlist (wishlistID)
VALUES 
    (1),
    (2),
    (3),
    (4),
    (5),
    (6);                                                           

INSERT OR IGNORE INTO ShoppingCart (shoppingCartID)
VALUES 
    (1),
    (2),
    (3),
    (4),
    (5),
    (6);

INSERT OR IGNORE INTO Item (itemID,name, sellerID, categoryID, brand, model, sizeID, conditionID, description, price, imageID, statusID)
VALUES 
    (1,'Used Unicorn Shirt', 1, 1, 'Gucci', '', 6, 3, 'Cool shirt! :D', 9999999.99, 1, 1),
    (2,'Vintage Plushies', 1, 2, 'Lacoste', '', 0, 1, '  Hello! I am selling 5 vintage plushies from 1914 very good, very good condition, very good shape, very good price.', 2000.00, 2, 1),
    (3,'Used Unicorn Shirt2', 2, 1, 'Gucci', '', 6, 3, 'Cool shirt! :D', 9999999.99, 3, 2),
    (4,'Fancy Dress', 4, 1, 'Dior', '', 4, 1, 'Perfect for any party!', 499.99, 4, 1),
    (5,'Wooden table', 5, 4, 'BobsBuilds', '', 0, 2, 'Classic table for the BEST builders!', 99.99, 5, 1),
    (6,'iPhone X', 1, 3, 'Apple', 'iPhone X', 0, 3, 'Slightly used, good condition.', 599.99, 6, 1),
    (7,'Lego Millennium Falcon', 2, 5, 'Lego', 'Star Wars', 0, 1, 'Build your own Star Wars adventure!', 799.99, 7, 1),
    (8,'Leather Jacket', 4, 1, 'Versace', '', 3, 2, 'Stylish and durable.', 299.99, 8, 1),
    (9,'Beatifull bow', 4, 2, 'Zara', '', 0, 3, '  Hello! I am  selling my beatifull bow.', 20.00, 9, 1),
    (10,'Vintage Watch', 2, 2, 'Rolex', 'Submariner', 0, 2, 'Classic vintage timepiece.', 4999.99, 10, 1),
    (11,'PlayStation 5', 1, 3, 'Sony', 'PS5', 0, 1, 'Brand new in box.', 599.99, 11, 1),
    (12,'Antique Chair', 5, 4, 'Victorian', '', 0, 3, 'Beautifully crafted antique chair.', 299.99, 12, 1),
    (13,'Designer Handbag', 4, 2, 'Louis Vuitton', '', 0, 1, 'Luxurious designer handbag.', 999.99, 13, 1),
    (14,'Gaming PC', 3, 3, 'Custom Build', '', 0, 1, 'Powerful gaming rig.', 1499.99, 14, 1),
    (15,'Smartwatch', 2, 3, 'Apple', 'Watch Series 6', 0, 2, 'Stay connected with this smartwatch.', 399.99, 15, 2),
    (16,'Vintage Vinyl Records', 5, 5, 'Various', '', 0, 2, 'Collection of classic vinyl records.', 99.99, 16, 1),
    (17,'Designer Sunglasses', 4, 2, 'Ray-Ban', '', 0, 1, 'Stylish sunglasses for any occasion.', 149.99, 17, 2),
    (18,'Digital Camera', 3, 3, 'Canon', 'EOS Rebel T7', 0, 1, 'Capture your memories with this camera.', 599.99, 18, 1),
    (19,'Electric Guitar', 6, 5, 'Fender', 'Stratocaster', 0, 2, 'Rock out with this electric guitar.', 799.99, 19, 1),
    (20,'Collectible Action Figures', 1, 2, 'Hasbro', '', 0, 1, 'Rare collectible action figures set.', 299.99, 20, 2),
    (21,'Smart Home Security Camera', 1, 3, 'Ring', 'Doorbell Pro', 0, 1, 'Monitor your home with this smart security camera.', 199.99, 21, 2);


    

INSERT OR IGNORE INTO ShippingForm (shippingFormID, itemID, sellerID, buyerID, date)
VALUES 
    
    (1, 3, 2, 1, '2022-04-19'),
    (2, 15, 2, 3, '2024-05-13'),
    (3, 17, 4, 1, '2024-05-13'),
    (4, 20, 1, 5, '2024-05-13'),
    (5, 21, 1, 4, '2024-05-13');


INSERT OR IGNORE INTO Message (messageID, senderID, recipientID, content, time)
VALUES 
    (1, 1, 2, 'Hello, Jane!', '2022-04-18 10:00:00'),
    (2, 2, 1, 'Hi, John!', '2022-04-18 10:05:00'),
    (3, 1, 2,'How are you?','2022-04-18 10:10:00'),
    (4, 2, 1, 'Very good!', '2022-04-18 10:20:00'),
    (5, 1, 2,'Ok','2022-04-18 10:21:00'),
    (6, 1, 2,'Ok','2022-04-18 10:21:00'),
    (7, 1, 2,'Ok','2022-04-18 10:21:00'),
    (8, 1, 2,'Ok','2022-04-18 10:21:00'),
    (9, 1, 2,'Ok','2022-04-18 10:21:00'),
    (10, 1, 2,'Ok','2022-04-18 10:21:00'),
    (11, 1, 2,'Ok','2022-04-18 10:21:00'),
    (11, 2, 1,'Thanks','2022-04-18 10:21:00'),
    (12, 1, 3,'Ok','2022-04-18 10:21:00'),
    (13, 3, 1, 'Hey there!', '2024-05-13 08:00:00'),
    (14, 1, 3, 'Hello Charlie!', '2024-05-13 08:05:00'),
    (15, 3, 1, 'Interested in buying your leather jacket.', '2024-05-13 08:10:00'),
    (16, 1, 3, 'Sure, let me know if you have any questions.', '2024-05-13 08:15:00'),
    (17, 1, 4, 'Hi Alice Im very interested in your fancy dress!.', '2024-05-13 08:16:00'),
    (18, 4, 1, 'Oh really what a pleasure! Its at a very fair price take your chance please! If theres anything you would like to know about it let me know', '2024-05-13 08:17:00'),
    (19, 2, 3, 'Hey Toze, interested in your iPhone X.', '2024-05-13 08:30:00'),
    (20, 3, 2, 'Hi. Im interested in your item', '2024-05-13 08:35:00'),
    (21, 3, 4, 'Hi Alice, Im interested in your fancy dress!', '2024-05-13 08:40:00'),
    (22, 4, 3, 'Thanks for your interest! Feel free to ask anything.', '2024-05-13 08:45:00'),
    (23, 1, 4, 'Yes Im going to feel so pretty in it will surely buy it! <3', '2024-05-13 08:50:00'),
    (24, 5, 1, 'Your items are very interesting! If you want Im selling a gaming PC! My kids dont like to play anymore and an old and hard working builder like me doesnt have the time for games... So im looking for someone who would appreciate it and you look like just the guy!', '2024-05-13 08:55:00'),
    (25, 1, 6, 'Hi Charlie, interested in your electric guitar.', '2024-05-13 09:00:00'),
    (26, 6, 1, 'Feel free to ask any questions about it!', '2024-05-13 09:05:00'),
    (27, 3, 1, 'Hey John, hows the PlayStation 5?', '2024-05-13 09:10:00'),
    (28, 1, 3, 'Its great! Works perfectly.', '2024-05-13 09:15:00'),
    (29, 1, 4, 'I love all your items SO MUCH!! ', '2024-05-15 08:50:00'),
    (30, 1, 5, 'Hi Bob, Im interested in your gaming PC.', '2024-05-15 08:50:00');






INSERT OR IGNORE INTO Status (statusID, date, name)
VALUES 
    (1, '2022-04-18', 'Available'),
    (2, '2022-04-19', 'Sold');

INSERT OR IGNORE INTO Category (categoryID, name)
VALUES 
    (1, 'Clothing'),
    (2, 'Accessories'),
    (3, 'Electronics'),
    (4, 'Furniture'),
    (5, 'Toys');

INSERT OR IGNORE INTO Size (sizeID, name)
VALUES 
    (0, '-'),
    (1, 'XS'),
    (2, 'S'),
    (3, 'M'),
    (4, 'L'),
    (5, 'XL'),
    (6, 'XXL');

INSERT OR IGNORE INTO Condition (conditionID, usage)
VALUES 
    (1, 'Not used'),
    (2, 'Barely used'),
    (3, 'Used'),
    (4, 'Very used');

INSERT OR IGNORE INTO WishlistItem (wishlistID, itemID)
VALUES 
    (1, 1),
    (1, 2),
    (2, 3),
    (3, 3),
    (4, 1),
    (5, 2),
    (6, 3),
    (6, 4),
    (6, 5),
    (2, 4),
    (3, 6),
    (4, 7),
    (5, 8),
    (6, 9),
    (6, 10);

INSERT OR IGNORE INTO ShoppingCartItem (shoppingCartID, itemID)
VALUES 
    (2, 2),
    (3, 3),
    (4, 2),
    (5, 3),
    (6, 4),
    (1, 4),
    (2, 5),
    (3, 6),
    (4, 7),
    (5, 8),
    (6, 9);

INSERT OR IGNORE INTO UserShippingForm (userID, shippingFormID)
 VALUES 
    (3, 1), 
    (15, 2),
    (17, 3),  
    (20, 4),
    (21, 5);  



INSERT OR IGNORE INTO MessageUser (messageID, userID)
 VALUES
    (1, 1),  -- Message 1 sent by John Doe
    (1, 2),  -- Message 1 received by Jane Doe
    (2, 2),  -- Message 2 sent by Jane Doe
    (2, 1),  -- Message 2 received by John Doe
    (3, 1),  -- Message 3 sent by John Doe
    (3, 2),  -- Message 3 received by Jane Doe
    (4, 2),  -- Message 4 sent by Jane Doe
    (4, 1),  -- Message 4 received by John Doe
    (5, 1),  -- Message 5 sent by John Doe
    (5, 2),  -- Message 5 received by Jane Doe
    (6, 1),  -- Message 6 sent by John Doe
    (6, 2),  -- Message 6 received by Jane Doe
    (7, 1),  -- Message 7 sent by John Doe
    (7, 2),  -- Message 7 received by Jane Doe
    (8, 1),  -- Message 8 sent by John Doe
    (8, 2),  -- Message 8 received by Jane Doe
    (9, 1),  -- Message 9 sent by John Doe
    (9, 2),  -- Message 9 received by Jane Doe
    (10, 1), -- Message 10 sent by John Doe
    (10, 2), -- Message 10 received by Jane Doe
    (11, 1), -- Message 11 sent by John Doe
    (11, 2), -- Message 11 received by Jane Doe
    (12, 1), -- Message 12 sent by John Doe
    (12, 3), -- Message 12 received by Toze
    (13, 3), -- Message 13 sent by Toze
    (13, 1), -- Message 13 received by John Doe
    (14, 1), -- Message 14 sent by John Doe
    (14, 3), -- Message 14 received by Toze
    (15, 3), -- Message 15 sent by Toze
    (15, 1), -- Message 15 received by John Doe
    (16, 1), -- Message 16 sent by John Doe
    (16, 3), -- Message 16 received by Toze
    (17, 1), -- Message 17 sent by John Doe
    (17, 4), -- Message 17 received by Alice Wonderland
    (18, 4), -- Message 18 sent by Alice Wonderland
    (18, 1), -- Message 18 received by John Doe
    (19, 2), -- Message 19 sent by Jane Doe
    (19, 3), -- Message 19 received by Toze
    (20, 3), -- Message 20 sent by Toze
    (20, 2), -- Message 20 received by Jane Doe
    (21, 4), -- Message 21 sent by Alice Wonderland
    (21, 3), -- Message 21 received by Toze
    (22, 3), -- Message 22 sent by Toze
    (22, 4), -- Message 22 received by Alice Wonderland
    (23, 1), -- Message 23 sent by John Doe
    (23, 4), -- Message 23 received by Alice Wonderland
    (24, 4), -- Message 24 sent by Alice Wonderland
    (24, 1), -- Message 24 received by John Doe
    (25, 1), -- Message 25 sent by John Doe
    (25, 6), -- Message 25 received by Charlie Chaplin
    (26, 6), -- Message 26 sent by Charlie Chaplin
    (26, 1), -- Message 26 received by John Doe
    (27, 3), -- Message 27 sent by Toze
    (27, 1), -- Message 27 received by John Doe
    (28, 1), -- Message 28 sent by John Doe
    (28, 3), -- Message 28 received by Toze
    (29, 1), -- Message 29 sent by John Doe
    (29, 4), -- Message 29 received by Alice Wonderland
    (30, 1), -- Message 30 sent by John Doe
    (30, 5); -- Message 30 recieved by Bob Builder

INSERT OR IGNORE INTO Image (link, imageID)
    VALUES
    ('/../images/logo.jpg', 0),
    ('/../images/items/unicorn_dab_shirt.png', 1),
    ('/../images/items/plushies_0.png', 2),
    ('/../images/items/unicorn_dab_shirt.png', 3),
    ('/../images/items/fancy_dress.png', 4),
    ('/../images/items/wooden_table.png', 5),
    ('/../images/items/iphone_x.png', 6),
    ('/../images/items/millenium_falcon.png', 7),
    ('/../images/items/leather_jacket.png', 8),
    ('/../images/items/bow.png', 9),
    ('/../images/items/vintage_watch.png', 10),
    ('/../images/items/ps5.png', 11),
    ('/../images/items/antique_chair.png', 12),
    ('/../images/items/designer_handbag.png', 13),
    ('/../images/items/gaming_pc.png', 14),
    ('/../images/items/smartwatch.png', 15),
    ('/../images/items/vinyl_records.png', 16),
    ('/../images/items/sunglasses.png', 17),
    ('/../images/items/digital_camera.png', 18),
    ('/../images/items/electric_guitar.png', 19),
    ('/../images/items/action_figures.png', 20),
    ('/../images/items/security_camera.png', 21),
    ('/../images/profilePictures/john_pp.jpg', 22),
    ('/../images/profilePictures/jane_pp.jpg', 23),
    ('/../images/profilePictures/toze_pp.jpg', 24),
    ('/../images/profilePictures/alice_pp.jpg', 25),
    ('/../images/profilePictures/bob_pp.jpg', 26),
    ('/../images/profilePictures/charlie_pp.jpg', 27),
    ('/../images/profilePictures/default.jpg', 28);
    
