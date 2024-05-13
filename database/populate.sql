
INSERT OR IGNORE INTO User (userID, username, password, name, email, role, profilePicture, aboutMe, address, phoneNumber, wishlistID,shoppingCartID)
VALUES 

    (1, 'john_doe', '$2y$12$NASz60qmC5EAA4h3M600MuASJS/MSR6u/RQxw84wqgubP.WI3WQGa', 'John Doe', 'john@example.com', 'Admin', '/../images/profilePictures/pp2.jpg','sou o john_doe!', 'rua das bolachas ,4760-666,Portugal',910532024, 1, 1), /*john_doe1*/
    (2, 'jane_doe', '$2y$12$xHXoLY8wiUABnGk.31CSR.zcH7w.g5YxNwmwqdK8w/Z3Rs9jFAY8S', 'Jane Doe', 'jane@example.com', 'User',  '/../images/profilePictures/pp1.jpg','sou a jane_doe!', 'rua dos donuts, 1234-567,Portugal',919191919, 2, 2),/*jane_doe1*/
    (3, 'Toze', '$2y$12$6J33f9haGmoQgUzn5InhwuZb5K7Iq9yogx5nGddwwoDGkmUhZDucm', 'Toze', 'jane2@example.com', 'User',  '/../images/profilePictures/pp1.jpg','sou o Toze!', 'rua dos alecrins, 8005-332,Portugal',910000019, 3, 3);/*Toze_pt1*/

INSERT OR IGNORE INTO Wishlist (wishlistID)
VALUES 
    (1),
    (2),
    (3);

INSERT OR IGNORE INTO ShoppingCart (shoppingCartID)
VALUES 
    (1),
    (2),
    (3);

INSERT OR IGNORE INTO Item (itemID,name, sellerID, categoryID, brand, model, sizeID, conditionID, description, price, images, statusID)
VALUES 
    (1,'Used Unicorn Shirt', 1, 1, 'Gucci', '', 6, 3, 'Cool shirt! :D', 9999999.99, 'images/unicorn_dab_shirt.png', 1),
    (2,'Vintage Plushies', 1, 2, 'Lacoste', '', 0, 1, '  Hello! I am selling 5 vintage plushies from 1914 very good, very good condition, very good shape, very good price.', 2000.00, 'images/plushies_0.png,images/plushies_1.png,images/plushies_2.png', 1),
    (3,'Colegas de turma', 3, 5, 'Chineses', 'Falhados', 1, 4, 'Colegas de Turma muito usados', 0.01, 'images/ola.png,images/ola1.png,images/ola2.png', 1),
    (4,'Used Unicorn Shirt2', 2, 1, 'Gucci', '', 6, 3, 'Cool shirt! :D', 9999999.99, 'images/unicorn_dab_shirt.png', 1);

    

INSERT OR IGNORE INTO ShippingForm (shippingFormID, itemID, sellerID, buyerID, description, date)
VALUES 
    (1, 1, 1, 2, 'very good item. very fragile! transport carefully.', '2022-04-18'),
    (2, 2, 1, 2, 'not fragile. FedEx. estimated arrival : 2025-04-19', '2022-04-19');

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
    (11, 2, 1,'Obrigado','2022-04-18 10:21:00'),
    (12, 1, 3,'Ok','2022-04-18 10:21:00');


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
    (3, 3);

INSERT OR IGNORE INTO ShoppingCartItem (shoppingCartID, itemID)
VALUES 
    (1, 1),
    (2, 2),
    (3, 3);

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
    (5,2),
    (6,1),
    (6,2),
    (7,1),
    (7,2),
    (8,1),
    (8,2),
    (9,1),
    (9,2),
    (10,1),
    (10,2),
    (11,1),
    (11,2),
    (12,1),
    (12,3);

