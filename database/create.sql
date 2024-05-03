.headers on
.mode columns
PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS ShippingForm;
DROP TABLE IF EXISTS Message; 
DROP TABLE IF EXISTS Status; 
DROP TABLE IF EXISTS Category; 
DROP TABLE IF EXISTS Size; 
DROP TABLE IF EXISTS Condition;

CREATE TABLE Status (
    statusID INTEGER PRIMARY KEY AUTOINCREMENT,
    date TEXT,
    name VARCHAR(255)
);

CREATE TABLE Category (
    categoryID INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255)
);

CREATE TABLE Size (
    sizeID INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255)
);

CREATE TABLE Condition (
    conditionID INTEGER PRIMARY KEY AUTOINCREMENT,
    usage VARCHAR(255)
);

CREATE TABLE User (
    userID INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(255) UNIQUE NOT NULL,   
    password VARCHAR(255) NOT NULL,                 
    name VARCHAR(255),                       
    email VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    profilePicture TEXT,
    aboutMe TEXT,
    address TEXT,
    phoneNumber INT,
    wishlistID INT NOT NULL,
    shoppingCartID INT NOT NULL,
    FOREIGN KEY (wishlistID) REFERENCES Wishlist(wishlistID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Wishlist (
    wishlistID INTEGER PRIMARY KEY AUTOINCREMENT
);

CREATE TABLE ShoppingCart (
    shoppingCartID INTEGER PRIMARY KEY AUTOINCREMENT
);


CREATE TABLE Item (
    itemID INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    sellerID INT NOT NULL,
    categoryID INT NOT NULL,
    sizeID INT,
    conditionID INT NOT NULL,
    statusID INT,
    brand VARCHAR(255),
    model VARCHAR(255),
    description TEXT,
    price REAL NOT NULL,
    images TEXT,
    FOREIGN KEY (sellerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (categoryID) REFERENCES Category(categoryID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (sizeID) REFERENCES Size(sizeID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (conditionID) REFERENCES Condition(conditionID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (statusID) REFERENCES Status(statusID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE WishlistItem (
    wishlistID INT,
    itemID INT,
    PRIMARY KEY (wishlistID, itemID),
    FOREIGN KEY (wishlistID) REFERENCES wishlist(wishlistID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (itemID) REFERENCES Item(itemID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ShoppingCartItem (
    shoppingCartID INT,
    itemID INT,
    PRIMARY KEY (shoppingCartID, itemID),
    FOREIGN KEY (shoppingCartID) REFERENCES ShoppingCart(shoppingCartID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (itemID) REFERENCES Item(itemID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ShippingForm (
    shippingFormID INTEGER PRIMARY KEY AUTOINCREMENT,
    itemID INT,
    sellerID INT,
    buyerID INT,
    description TEXT,
    date TEXT,
    FOREIGN KEY (itemID) REFERENCES Item(itemID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (sellerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (buyerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE UserShippingForm (
    userID INT,
    shippingFormID INT,
    PRIMARY KEY (userID, shippingFormID),
    FOREIGN KEY (userID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (shippingFormID) REFERENCES ShippingForm(shippingFormID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Message (
    messageID INTEGER PRIMARY KEY AUTOINCREMENT,
    senderID INT,
    recipientID INT,
    content TEXT,
    time TEXT,
    FOREIGN KEY (senderID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (recipientID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE MessageUser (
    messageID INT,
    userID INT,
    PRIMARY KEY (messageID, userID),
    FOREIGN KEY (messageID) REFERENCES Message(messageID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (userID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Triggers for Item deletion
CREATE TRIGGER delete_from_wishlistitem
AFTER DELETE ON Item
FOR EACH ROW
BEGIN
    DELETE FROM WishlistItem WHERE itemID = OLD.itemID;
END;

CREATE TRIGGER delete_from_shoppingCartItem
AFTER DELETE ON Item
FOR EACH ROW
BEGIN
    DELETE FROM ShoppingCartItem WHERE itemID = OLD.itemID;
END;


-- Triggers for user deletion
CREATE TRIGGER delete_from_wishlist
AFTER DELETE ON User
FOR EACH ROW
BEGIN
    DELETE FROM Wishlist WHERE wishlistID = OLD.wishlistID;
END;
CREATE TRIGGER delete_from_shoppingCart
AFTER DELETE ON User
FOR EACH ROW
BEGIN
    DELETE FROM ShoppingCart WHERE shoppingCartID = OLD.shoppingCartID;
END;

CREATE TRIGGER delete_from_shippingform_user
AFTER DELETE ON User
FOR EACH ROW
BEGIN
    DELETE FROM ShippingForm WHERE sellerID = OLD.userID OR buyerID = OLD.userID;
END;

CREATE TRIGGER delete_from_usershippingform_user
AFTER DELETE ON User
FOR EACH ROW
BEGIN
    DELETE FROM UserShippingForm WHERE userID = OLD.userID;
END;
