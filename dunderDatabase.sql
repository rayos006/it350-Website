CREATE TABLE Users (
    Username varchar(255) PRIMARY KEY NOT NULL,
    Name varchar(255) NOT NULL,
    Password varchar(255),
    Email varchar(255),
    loggedIn int
);

CREATE TABLE Customers (
    Username varchar(255) PRIMARY KEY,
    CompanyId int,
    CustomerId int UNIQUE
);

CREATE TABLE Employee (
    Username varchar(255) PRIMARY KEY,
    BranchId int,
    Admin int 
);

CREATE TABLE Company (
    CompanyId int PRIMARY KEY,
    MailingAddress varchar(255),
    Name varchar(255)
);

CREATE TABLE PaymentOption (
    AccountId int PRIMARY KEY,
    CompanyId int UNIQUE
);

CREATE TABLE Card (
    Id int PRIMARY KEY AUTO_INCREMENT,
    AccountId int,
    CardNumber int,
    CVV int,
    BillingAddress VARCHAR(255),
    CardName VARCHAR(255)
);

CREATE TABLE Bank (
    Id int PRIMARY KEY AUTO_INCREMENT,
    AccountId int,
    AccountNumber int,
    RoutingNumber int,
    TypeOfAccount VARCHAR(255)
);

CREATE TABLE Reviews(
    ReviewId int PRIMARY KEY,
    Date TIMESTAMP,
    Rating int,
    Text Text,
    CustomerId int,
    SupplyId int
);

CREATE TABLE Orders (
    OrderId int PRIMARY KEY,
    CompanyId int,
    AccountId int,
    Date TIMESTAMP,
    CustomerId int,
    Shipped int
);

CREATE TABLE OrderSupplyLookup (
    Id int PRIMARY KEY AUTO_INCREMENT,
    SupplyId int,
    OrderId int
);

CREATE TABLE Supplies(
    SupplyId int PRIMARY KEY,
    Name varchar(255),
    InStock int,
    Price int,
    Picture VARCHAR(255) 
);

CREATE TABLE StickyQuips(
    SupplyId int PRIMARY KEY,
    Color VARCHAR(255),
    Size VARCHAR(2)
);

CREATE TABLE OfficeSupplies(
    SupplyId int PRIMARY KEY,
    Type VARCHAR(255),
    Brand VARCHAR(255),
    Color VARCHAR(255),
    Size VARCHAR(255)
);

CREATE TABLE Printers(
    SupplyId int PRIMARY KEY,
    Size VARCHAR(255),
    TonerType VARCHAR(255),
    Brand VARCHAR(255)
);

CREATE TABLE PrintToner(
    SupplyId int PRIMARY KEY,
    Type VARCHAR(255),
    Size VARCHAR(255),
    Brand VARCHAR(255),
    Color VARCHAR(255)
);

CREATE TABLE Paper(
    SupplyId int PRIMARY KEY,
    Color VARCHAR(255),
    Size VARCHAR(255),
    Weight int
);

