<?php
class Order extends Model
{
    // public function GetOrdersByUserID($userid)
    // {
    //     $query = "SELECT * FROM `order` WHERE 1";
    //     return $this->select($query);
    // }


    public function countOrderPending()
    {
        $query = "SELECT COUNT(*) AS numberorderpending FROM `order` WHERE OrderStatus = 'pending'";
        return $this->selectOne($query)['numberorderpending'];
    }


    public function GetOrdersByUserID($userid)
    {
        $query = "SELECT * FROM `order` WHERE CustomerId = $userid ORDER BY OrderDate DESC";
        return $this->select($query);
    }

    public function GetOrdersByOrdercode($ordercode, $userid)
    {
        $query = "SELECT * FROM `order` WHERE CustomerId = $userid and OrderCode = '$ordercode'";
        return $this->selectOne($query);
    }
    public function GetOrdersDetailByOrdercode($ordercode)
    {
        $query = "SELECT * FROM `orderdetail` WHERE OrderCode = '$ordercode'";
        return $this->select($query);
    }


    public function CancleOrder($ordercode)
    {
        $query = "UPDATE `order` set `OrderStatus` = 'Cancelled' WHERE OrderCode = '$ordercode'";
        return $this->execute($query);
    }



    public function orderCodeExists($orderCode)
    {
        $query = "SELECT COUNT(*) as count FROM `order` WHERE OrderCode = '$orderCode'";
        $count = $this->selectOne($query)['count'];
        return $count > 0;
    }

    public function CreateNewOrder($params)
    {
        $query = "INSERT INTO `order`(`OrderCode`, `CustomerId`, `OrderDate`, `TotalAmount`, `OrderStatus`, `ShippingAddress`) 
                VALUES (?,?,?,?,?,?)";
        $types = "sisdss";
        return $this->executeByParams($query, $params, $types);
    }


    public function CreateOrderDetails($params)
    {
        $query = "INSERT INTO `orderdetail`(`OrderCode`, `ProductId`, `Price`, `Quantity`, `ProductName`, `UnitPrice`, `ImageUrl`) 
                VALUES (?,?,?,?,?,?,?)";
        $types = "sidisds";
        return $this->executeMultipleRecords($query, $params, $types);
    }

    public function UpdateTotalAmount()
    {
        $query = "UPDATE orderdetail
                    SET Price = CASE 
                        WHEN PriceSale IS NOT NULL THEN PriceSale * Quantity
                        ELSE UnitPrice * Quantity
                    END
                ";
        return $this->execute($query);
    }


    public function countAllOrder($params = null)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;
        $query = "SELECT COUNT(*) AS numberorder FROM `order`";
        if ($strsearch !== null) {
            $query .= "WHERE OrderCode LIKE '%{$strsearch}%'";
        }
        return $this->selectOne($query)['numberorder'];
    }

    public function getOrdersCurrentPageForAdmin($limit, $offset, $params)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;


        $query = "SELECT * FROM `order` O INNER JOIN `customer` cu ON o.CustomerId = cu.ID ";

        if ($strsearch !== null) {
            $query .= "WHERE OrderCode LIKE '%{$strsearch}%'";
        }

        $query .= "ORDER BY OrderDate DESC LIMIT $limit OFFSET $offset";
        return $this->select($query);
    }

    public function getOrderDetailbyOrdercodeAdmin($orderCode)
    {
        $query =    "SELECT * FROM `order` o
                    INNER JOIN `customer` cu ON cu.ID = o.CustomerId
                    INNER JOIN `orderdetail` od ON o.OrderCode = od.OrderCode
                    WHERE o.OrderCode = '$orderCode'";
        return $this->select($query);
    }

    public function confirmOrder($orderCode)
    {
        $query = "UPDATE `order` set `OrderStatus` = 'Completed' WHERE OrderCode = '$orderCode'";
        return $this->execute($query);
    }
}
