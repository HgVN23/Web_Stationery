CREATE TABLE `Cart`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerId` INT NOT NULL,
    `CreatedDate` DATETIME NOT NULL,
    `IsCheckedOut` BOOLEAN NOT NULL
);
CREATE TABLE `Customer`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerName` VARCHAR(255) NOT NULL,
    `Email` INT NOT NULL,
    `Phone` VARCHAR(255) NOT NULL,
    `Address` VARCHAR(255) NOT NULL,
    `UserID` INT NOT NULL
);
CREATE TABLE `Category`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CategoryName` VARCHAR(255) NOT NULL,
    `Description` VARCHAR(255) NOT NULL,
    `IsFeature` BOOLEAN NOT NULL DEFAULT '0'
);
CREATE TABLE `User`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Username` VARCHAR(255) NOT NULL,
    `PasswordHash` VARCHAR(255) NOT NULL,
    `Role` VARCHAR(255) NOT NULL,
    `IsActive` BOOLEAN NOT NULL
);
ALTER TABLE
    `User` ADD UNIQUE `user_username_unique`(`Username`);
CREATE TABLE `Contact`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerName` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Phone` VARCHAR(255) NULL,
    `Message` TEXT NOT NULL,
    `ContactDate` DATETIME NOT NULL,
    `IsReplied` BOOLEAN NOT NULL
);
CREATE TABLE `CartItem`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CartId` INT NOT NULL,
    `ProductId` INT NOT NULL,
    `Quantity` INT NOT NULL,
    `Price` DECIMAL(8, 2) NOT NULL
);
CREATE TABLE `Order`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CustomerId` INT NOT NULL,
    `OrderDate` DATETIME NOT NULL,
    `TotalAmount` DECIMAL(8, 2) NOT NULL,
    `OrderStatus` VARCHAR(255) NOT NULL COMMENT '\"Pending\", \"Completed\", \"Cancelled\"',
    `ShippingAddress` TEXT NOT NULL
);
CREATE TABLE `Product`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `CategoryId` INT NOT NULL,
    `ProductName` VARCHAR(255) NOT NULL,
    `UnitPrice` DECIMAL(8, 2) NOT NULL,
    `PriceSale` DECIMAL(8, 2) NOT NULL,
    `Description` TEXT NULL,
    `ImageURL` VARCHAR(255) NOT NULL,
    `StockQuantity` BIGINT NOT NULL,
    `IsAvailable` BOOLEAN NOT NULL DEFAULT '1',
    `IsHot` BOOLEAN NOT NULL DEFAULT '0',
    `Created_at` DATETIME NOT NULL,
    `Updated_at` DATETIME NOT NULL
);
CREATE TABLE `OrderDetail`(
    `ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `OrderId` INT NOT NULL,
    `ProductId` INT NOT NULL,
    `Price` DECIMAL(8, 2) NOT NULL,
    `Quantity` INT NOT NULL,
    `ProductName` VARCHAR(255) NOT NULL,
    `UnitPrice` DECIMAL(8, 2) NOT NULL,
    `PriceSale` DECIMAL(8, 2) NOT NULL,
    `ImageUrl` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Product` ADD CONSTRAINT `product_categoryid_foreign` FOREIGN KEY(`CategoryId`) REFERENCES `Category`(`ID`);
ALTER TABLE
    `Order` ADD CONSTRAINT `order_customerid_foreign` FOREIGN KEY(`CustomerId`) REFERENCES `Customer`(`ID`);
ALTER TABLE
    `Customer` ADD CONSTRAINT `customer_userid_foreign` FOREIGN KEY(`UserID`) REFERENCES `User`(`ID`);
ALTER TABLE
    `Cart` ADD CONSTRAINT `cart_customerid_foreign` FOREIGN KEY(`CustomerId`) REFERENCES `Customer`(`ID`);
ALTER TABLE
    `CartItem` ADD CONSTRAINT `cartitem_id_foreign` FOREIGN KEY(`ID`) REFERENCES `Cart`(`ID`);
ALTER TABLE
    `OrderDetail` ADD CONSTRAINT `orderdetail_orderid_foreign` FOREIGN KEY(`OrderId`) REFERENCES `Order`(`ID`);