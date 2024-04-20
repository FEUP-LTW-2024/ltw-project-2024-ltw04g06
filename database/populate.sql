-- Insert sample data into the User table
INSERT OR IGNORE INTO User (userID, username, password, name, email, role, profilePicture, wishlistID)
VALUES 
    (1, 'john_doe', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'John Doe', 'john@example.com', 'Admin', 'profile_picture_url', 1),
    (2, 'jane_doe', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Jane Doe', 'jane@example.com', 'User', NULL, 2);

-- Insert sample data into the Wishlist table
INSERT OR IGNORE INTO Wishlist (wishlistID)
VALUES 
    (1),
    (2);

-- Insert sample data into the Item table
INSERT OR IGNORE INTO Item (itemID, sellerID, categoryID, brand, model, sizeID, conditionID, description, price, images, statusID)
VALUES 
    (1, 1, 1, 'Brand A', 'Model X', 1, 1, 'Description of item 1', 100.00, 'image_url_1,image_url_2,image_url_3', 1),
    (2, 1, 2, 'Brand B', 'Model Y', 2, 2, 'Description of item 2', 200.00, 'image_url_4,image_url_5,image_url_6', 1),
    (3, 2, 2, 'Brand C', 'Model Z', 3, 3, 'Description of item 3', 300.00, 'image_url_4,image_url_5,image_url_6', 2);

-- Insert sample data into the ShippingForm table
INSERT OR IGNORE INTO ShippingForm (shippingFormID, itemID, sellerID, buyerID, address, date)
VALUES 
    (1, 1, 1, 2, '123 Main St, City, Country', '2022-04-18'),
    (2, 2, 1, 2, '456 Elm St, City, Country', '2022-04-19');

-- Insert sample data into the Messages table
INSERT OR IGNORE INTO Messages (messageID, senderID, recipientID, content, time)
VALUES 
    (1, 1, 2, 'Hello, Jane!', '2022-04-18 10:00:00'),
    (2, 2, 1, 'Hi, John!', '2022-04-18 10:05:00');

-- Insert sample data into the Status table
INSERT OR IGNORE INTO Status (statusID, date, name)
VALUES 
    (1, '2022-04-18', 'Available'),
    (2, '2022-04-19', 'Sold');

-- Insert sample data into the Category table
INSERT OR IGNORE INTO Category (categoryID, name)
VALUES 
    (1, 'Electronics'),
    (2, 'Clothing');

-- Insert sample data into the Size table
INSERT OR IGNORE INTO Size (sizeID, name)
VALUES 
    (1, 'XS'),
    (2, 'S');

-- Insert sample data into the Condition table
INSERT OR IGNORE INTO Condition (conditionID, usage)
VALUES 
    (1, 'New'),
    (2, 'Used');