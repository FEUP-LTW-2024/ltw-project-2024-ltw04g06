
INSERT OR IGNORE INTO User (userID, username, password, name, email, role, profilePicture, wishlistID)
VALUES 
    (1, 'john_doe', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'John Doe', 'john@example.com', 'Admin', 'images/pp2', 1),
    (2, 'jane_doe', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Jane Doe', 'jane@example.com', 'User',  'images/pp1', 2);

INSERT OR IGNORE INTO Wishlist (wishlistID)
VALUES 
    (1),
    (2);

INSERT OR IGNORE INTO Item (itemID,name, sellerID, categoryID, brand, model, sizeID, conditionID, description, price, images, statusID)
VALUES 
    (1,'Used Unicorn Shirt', 1, 1, 'Gucci', NULL, 6, 3, 'Cool shirt! :D', 9999999.99, 'images/unicorn_dab_shirt.png', 1),
    (2,'Vintage Plushies', 1, 2, 'Lacoste', NULL, 0, 1, '  Hello! I am selling 5 vintage plushies from 1914 very good, very good condition, very good shape, very good price.', 2000.00, 'images/plushies_0.png,images/plushies_1.png,images/plushies_2.png', 1),
    (3,'', 2, 2, 'Brand C', 'Model Z', 3, 3, 'Description of item 3', 300.00, 'image_url_7,image_url_8,image_url_9', 2);

INSERT OR IGNORE INTO ShippingForm (shippingFormID, itemID, sellerID, buyerID, address, date)
VALUES 
    (1, 1, 1, 2, '123 Main St, City, Country', '2022-04-18'),
    (2, 2, 1, 2, '456 Elm St, City, Country', '2022-04-19');

INSERT OR IGNORE INTO Message (messageID, senderID, recipientID, content, time)
VALUES 
    (1, 1, 2, 'Hello, Jane!', '2022-04-18 10:00:00'),
    (2, 2, 1, 'Hi, John!', '2022-04-18 10:05:00'),
    (3, 1, 2,'How are you?','2022-04-18 10:10:00'),
    (4, 2, 1, 'Very good!', '2022-04-18 10:20:00'),
    (5, 1, 2,'Ok','2022-04-18 10:21:00');


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
    (2, 3);

INSERT OR IGNORE INTO UserShippingForm (userID, shippingFormID)
 VALUES 
    (1, 1),
    (2, 2);



INSERT OR IGNORE INTO MessageUser (messageID, userID)
 VALUES
    (1,1),
    (1,2),
    (2,1),
    (2,2),
    (3,1),
    (3,2),
    (4,1),
    (4,2),
    (5,1),
    (5,2);

