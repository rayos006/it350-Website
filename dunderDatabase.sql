CREATE TABLE Users (
    Username varchar(255) PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Password BINARY(64),
    Email varchar(255)
)

CREATE TABLE Customers (
    Username varchar(255) FOREIGN KEY REFERENCES Users(Username),
    CompanyId int FOREIGN KEY REFERENCES Company(CompanyId),
    CustomerId int
)

CREATE TABLE Employee (
    Username varchar(255) FOREIGN KEY REFERENCES Users(Username),
    BranchId int
)

CREATE TABLE Company (
    CompanyId int PRIMARY KEY,
    MailingAddress varchar(255),
    Name varchar(255)
)

CREATE TABLE PaymentOption (
    AccountId int PRIMARY KEY,
    CompanyId int FOREIGN KEY REFERENCES Company(CompanyId)
)

CREATE TABLE Card (
    AccountId int FOREIGN KEY REFERENCES 
)