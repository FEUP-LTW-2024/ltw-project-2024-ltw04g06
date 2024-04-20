.headers on
.mode columns
PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS ShippingForm;
DROP TABLE IF EXISTS Messages; 
DROP TABLE IF EXISTS Status; 
DROP TABLE IF EXISTS Category; 
DROP TABLE IF EXISTS Size; 
DROP TABLE IF EXISTS Condition;

CREATE TABLE Status (
    statusID INT PRIMARY KEY,
    date TEXT,
    name VARCHAR(255)
);

CREATE TABLE Category (
    categoryID INT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE Size (
    sizeID INT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE Condition (
    conditionID INT PRIMARY KEY,
    usage VARCHAR(255)
);

CREATE TABLE User (
    userID INT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,   
    password VARCHAR(255) NOT NULL,                 
    name VARCHAR(255),                       
    email VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    profilePicture TEXT,
    wishlistID INT,
    FOREIGN KEY (wishlistID) REFERENCES Wishlist(wishlistID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Wishlist (
    wishlistID INT PRIMARY KEY,
    itemID INT,
    FOREIGN KEY (itemID) REFERENCES Item(itemID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Item (
    itemID INT PRIMARY KEY,
    sellerID INT,
    categoryID INT,
    sizeID INT,
    conditionID INT,
    statusID INT,
    brand VARCHAR(255),
    model VARCHAR(255),
    description TEXT,
    price REAL,
    images TEXT,
    FOREIGN KEY (sellerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (categoryID) REFERENCES Category(categoryID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (sizeID) REFERENCES Size(sizeID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (conditionID) REFERENCES Condition(conditionID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (statusID) REFERENCES Status(statusID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE ShippingForm (
    shippingFormID INT PRIMARY KEY,
    itemID INT,
    sellerID INT,
    buyerID INT,
    address TEXT,
    date TEXT,
    FOREIGN KEY (itemID) REFERENCES Item(itemID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (sellerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (buyerID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE Messages (
    messageID INT PRIMARY KEY,
    senderID INT,
    recipientID INT,
    content TEXT,
    time TEXT,
    FOREIGN KEY (senderID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (recipientID) REFERENCES User(userID) ON UPDATE CASCADE ON DELETE SET NULL
);
