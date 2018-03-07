CREATE TABLE Users (
    Username varchar(255) PRIMARY KEY NOT NULL,
    Name varchar(255) NOT NULL,
    Password varchar(255),
    Email varchar(255),
    loggedIn BIT
);

CREATE TABLE Customers (
    Username varchar(255) PRIMARY KEY,
    CompanyId int,
    CustomerId int UNIQUE
);

CREATE TABLE Employee (
    Username varchar(255) PRIMARY KEY,
    BranchId int,
    Admin BIT 
);

CREATE TABLE Company (
    CompanyId int PRIMARY KEY AUTO_INCREMENT,
    MailingAddress varchar(255),
    Name varchar(255)
);

CREATE TABLE PaymentOption (
    AccountId int PRIMARY KEY AUTO_INCREMENT,
    CompanyId int
);

CREATE TABLE Card (
    AccountId int PRIMARY KEY,
    CardNumber int,
    CVV int,
    BillingAddress VARCHAR(255),
    CardName VARCHAR(255)
);

CREATE TABLE Bank (
    AccountId int PRIMARY KEY,
    AccountNumber int,
    RoutingNumber int,
    TypeOfAccount VARCHAR(255)
);

CREATE TABLE Reviews(
    ReviewId int PRIMARY KEY AUTO_INCREMENT,
    Date TIMESTAMP,
    Rating int,
    Text Text,
    CustomerId int,
    SupplyId int
);

CREATE TABLE Orders (
    OrderId int PRIMARY KEY AUTO_INCREMENT,
    CompanyId int,
    AccountId int,
    Date TIMESTAMP,
    SupplyId int,
    CustomerId int,
    Shipped BIT
);

CREATE TABLE Supplies(
    SupplyId int PRIMARY KEY AUTO_INCREMENT,
    Name varchar(255),
    InStock BIT,
    Price int,
    Picture VARCHAR(255) 
);

CREATE TABLE StikyQuips(
    SupplyId int PRIMARY KEY,
    Name VARCHAR(255),
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

