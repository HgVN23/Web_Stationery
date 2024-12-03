<?php

class Product extends Model
{

    public function countProduct($params = null)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;
        $query = "SELECT COUNT(*) AS numbeproduct FROM Product";
        if ($strsearch !== null) {
            $query .= " WHERE ProductName LIKE '%{$strsearch}%'";
        }
        return $this->selectOne($query)['numbeproduct'];
    }

    public function getProductCurrentPage($limit, $offset, $params)
    {

        $categoryID = isset($params['categoryid']) ? $params['categoryid'] : null;
        $strsearch = isset($params['search']) ? $params['search'] : null;
        $sort = isset($params['sort']) ? $params['sort'] : null;


        $query = "SELECT * FROM Product";


        $conditions = [];
        if ($categoryID !== null) {
            $conditions[] = "CategoryId = $categoryID";
        }
        if ($strsearch !== null) {
            $conditions[] = "ProductName LIKE '%{$strsearch}%'";
        }

        // Nếu có điều kiện nào, thêm chúng vào truy vấn
        if (!empty($conditions)) {
            $conditions[] = "StockQuantity > 0";
            $query .= " WHERE " . implode(" AND ", $conditions);
        } else {
            $query .= " WHERE StockQuantity > 0";
        }

        if ($sort !== null) {
            if ($sort == 'asc') {
                $query .= " ORDER BY UnitPrice ASC";
            } else {
                $query .= " ORDER BY UnitPrice DESC";
            }
        }

        // Thêm giới hạn và bù trừ
        $query .= " LIMIT $limit OFFSET $offset";

        return $this->select($query);
    }

    public function getCountProduct($params)
    {

        $categoryID = isset($params['categoryid']) ? $params['categoryid'] : null;
        $strsearch = isset($params['search']) ? $params['search'] : null;

        // Khởi tạo câu truy vấn cơ bản
        $query = "SELECT COUNT(*) AS total FROM Product";

        // Xây dựng điều kiện WHERE tùy thuộc vào tham số
        $conditions = [];
        if ($categoryID !== null) {
            $conditions[] = "CategoryId = $categoryID";
        }
        if ($strsearch !== null) {
            $conditions[] = "ProductName LIKE '%{$strsearch}%'";
        }

        $conditions[] = "StockQuantity > 0";

        if (!empty($conditions)) {
            $conditions[] = "StockQuantity > 0";
            $query .= " WHERE " . implode(" AND ", $conditions);
        } else {
            $query .= " WHERE StockQuantity > 0";
        }

        return $this->selectOne($query);
    }

    public function getProduct($productid)
    {
        $query = "SELECT * FROM Product WHERE ID = {$productid}";
        return $this->selectOne($query);
    }

    // Hàm lấy tất cả sản phẩm
    public function getAllProducts()
    {
        $query = "SELECT * FROM `product` WHERE StockQuantity > 0";
        return $this->select($query);
    }

    public function getProductsByCategory($categoryID = null)
    {
        $query = "SELECT * FROM Product WHERE CategoryId = $categoryID AND StockQuantity > 0";
        return $this->select($query);
    }


    public function searchproduct($strsearch)
    {
        $query = "SELECT * FROM `product` WHERE StockQuantity > 0 AND ProductName like '%{$strsearch}%'";
        return $this->execute($query);
    }


    public function getStock($productId)
    {
        $query = "SELECT StockQuantity FROM product WHERE ID = $productId";
        return $this->selectOne($query)['StockQuantity'];
    }

    public function UpdateStock($productId, $quantity)
    {
        $query = "UPDATE `product` SET `StockQuantity`= `StockQuantity` -'$quantity' WHERE ID = $productId";
        return $this->execute($query);
    }
    public function UpdateStockPlus($productId, $quantity)
    {
        $query = "UPDATE `product` SET `StockQuantity`= `StockQuantity` +'$quantity' WHERE ID = $productId";
        return $this->execute($query);
    }

    public function ProductsNew()
    {
        $query = "SELECT * FROM product ORDER BY Created_at DESC LIMIT 10";
        return $this->execute($query);
    }

    public function ProductsHot()
    {
        $query = "SELECT *  FROM `product` WHERE `IsHot` = 1 LIMIT 10";
        return $this->execute($query);
    }



    // Hàm thêm sản phẩm mới
    public function addProduct($CategoryId, $ProductName, $UnitPrice, $PriceSale, $Description, $imageFile, $StockQuantity, $IsHot)
    {
        $ImageURL = saveImage($imageFile);
        if ($ImageURL) {
            $Created_at = date('Y-m-d H:i:s');
            $Updated_at = $Created_at;
            $query = "INSERT INTO `product`(`CategoryId`, `ProductName`, `UnitPrice`, `PriceSale`, `Description`, `ImageURL`, `StockQuantity`,  `IsHot`, `Created_at`, `Updated_at`) 
            VALUES ('$CategoryId','$ProductName', $UnitPrice, '$PriceSale','$Description', '$ImageURL', $StockQuantity, '$IsHot', '$Created_at', '$Updated_at')";
            return $this->execute($query);
        } else {
            return false;
        }
    }

    public function updateProduct($productId, $CategoryId, $ProductName, $UnitPrice, $PriceSale, $Description, $imageFile, $StockQuantity, $IsHot)
    {

        $Updated_at = date('Y-m-d H:i:s');
        if ($imageFile['error'] !== UPLOAD_ERR_NO_FILE) {
            $ImageURL = saveImage($imageFile);
            if ($ImageURL) {
                $query = "UPDATE `product` 
                SET 
                    `CategoryId` = '$CategoryId', 
                    `ProductName` = '$ProductName', 
                    `UnitPrice` = $UnitPrice, 
                    `PriceSale` = '$PriceSale', 
                    `Description` = '$Description', 
                    `ImageURL` = '$ImageURL', 
                    `StockQuantity` = $StockQuantity, 
                    `IsHot` = '$IsHot',
                    `Updated_at` = '$Updated_at' 
                WHERE `ID` = '$productId'";
                return $this->execute($query);
            } else {
                return false;
            }
        } else {
            $query = "UPDATE `product` 
                SET 
                    `CategoryId` = '$CategoryId', 
                    `ProductName` = '$ProductName', 
                    `UnitPrice` = $UnitPrice, 
                    `PriceSale` = '$PriceSale', 
                    `Description` = '$Description', 
                    `StockQuantity` = $StockQuantity, 
                    `IsHot` = '$IsHot',
                    `Updated_at` = '$Updated_at' 
                WHERE `ID` = '$productId'";
            return $this->execute($query);
        }
    }

    public function deleteProduct($productId)
    {
        $query = "DELETE FROM `product` WHERE ID = '$productId'";
        return $this->execute($query);
    }

    public function getProductCurrentPageForAdmin($limit, $offset, $params)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;

        // Bắt đầu với câu truy vấn cơ bản
        $query = "SELECT * FROM product ";

        if ($strsearch !== null) {
            $query .= "WHERE ProductName LIKE '%{$strsearch}%'";
        }

        // Thêm giới hạn và bù trừ
        $query .= " LIMIT $limit OFFSET $offset";
        return $this->select($query);
    }

    public function getproductdetail($productId)
    {
        $query = "SELECT p.*, c.CategoryName FROM `product` p INNER JOIN `category` c ON p.CategoryId = c.ID AND p.ID = $productId";
        return $this->selectOne($query);
    }

    public function UpdateIsHot($productId, $isHot)
    {
        $query = "UPDATE product SET IsHot = '$isHot' WHERE ID = '$productId'";
        return $this->execute($query);
    }

    // Hàm đóng kết nối
    public function close()
    {
        parent::close(); // Đóng kết nối của lớp cha
    }
}
