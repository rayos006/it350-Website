CREATE TABLE Users (
    Username varchar(255) PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Password BINARY(64),
    Email varchar(255)
);

CREATE TABLE Customers (
    Username varchar(255) PRIMARY KEY,
    CompanyId int,
    CustomerId int
);

CREATE TABLE Employee (
    Username varchar(255) PRIMARY KEY,
    BranchId int
);

CREATE TABLE Company (
    CompanyId int PRIMARY KEY,
    MailingAddress varchar(255),
    Name varchar(255)
);

CREATE TABLE PaymentOption (
    AccountId int PRIMARY KEY,
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
    ReviewId int PRIMARY KEY,
    Date TIMESTAMP,
    Rating int,
    Text VARCHAR(MAX),
    CustomerId int,
    SupplyId int
);

CREATE TABLE Orders (
    OrderId int PRIMARY KEY,
    CompanyId int,
    AccountId int,
    Date TIMESTAMP,
    SupplyId int,
    CustomerId int,
    Shipped BIT,
);

CREATE TABLE Supplies(
    SupplyId int PRIMARY KEY,
    Name varchar(255),
    InStock BIT,
    Price int,
    Picture varbinary(MAX)  
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

