<?php
class Cart extends Model
{
    public function CountCartItem($customerid)
    {
        $query = "SELECT COUNT(*) as totalcartitem FROM Cart c 
                    JOIN CartItem ci ON c.ID = ci.CartId 
                    JOIN Product p 
                    ON ci.ProductId = p.ID 
                    WHERE c.CustomerId = $customerid";
        return $this->select($query);
    }
    public function GetCartItemByUser($customerid)
    {
        $query = "SELECT ci.ID , ci.Quantity, ci.Price, p.ProductName, p.ImageURL, ci.ProductId
                    FROM Cart c
                    JOIN CartItem ci ON c.ID = ci.CartId
                    JOIN Product p ON ci.ProductId = p.ID
                    WHERE c.CustomerId = $customerid";
        return $this->select($query);
    }

    public function DeleteCartItem($customerId, $cardItemId)
    {
        $query = "DELETE FROM cartitem 
                    WHERE CartId = (SELECT ID  FROM Cart WHERE CustomerId = $customerId) 
                    AND ID = $cardItemId";
        return $this->execute($query);
    }

    public function GetArrDataCartItemsByUser($customerid)
    {
        $cartitems = $this->GetCartItemByUser($customerid);

        $totalAmount = array_reduce($cartitems, function ($carry, $item) {
            return $carry + ($item['Quantity'] * $item['Price']);
        }, 0);
        return [
            'cartitems' => $cartitems,
            'totalAmount' => $totalAmount
        ];
    }


    public function ChangeQuantityItem($customerId, $cardItemId, $quantity)
    {
        $query = "UPDATE cartitem set Quantity = $quantity 
                WHERE CartId = (SELECT ID  FROM Cart WHERE CustomerId = $customerId) 
                    AND ID = $cardItemId";
        return $this->execute($query);
    }


    public function GetOneCartItemByUser($customerid, $cardItemId)
    {
        $query = "SELECT * FROM cartitem 
                    WHERE CartId = (SELECT ID  FROM Cart WHERE CustomerId = $customerid) 
                    AND ID = $cardItemId";
        return $this->selectOne($query);
    }


    public function AddProductToCart($customerid, $pr_id, $qty = 1)
    {

        $rs = $this->CheckProducExists($customerid, $pr_id);

        $customerCart = $this->GetCustomerCartID($customerid);

        if ($rs) { //  exist = true
            $caritemID  = array_filter($customerCart, function ($item) use ($pr_id) {
                return $item['productid'] == $pr_id;
            });

            $caritemID = array_values($caritemID);

            $cartitemid = $caritemID[0]['cartitemid'];

            $query  = "UPDATE `cartitem` SET `Quantity`= Quantity + $qty WHERE ID = $cartitemid";
            return  $this->execute($query);
        } else {

            $cartid = $this->GetCartCustomer($customerid)['ID'];
            $product = $this->GetProduct($pr_id);
            $priceProduct = $product['PriceSale'] > 0 ? $product['PriceSale'] : $product['UnitPrice'];
            $query = "INSERT INTO `cartitem`(`CartId`, `ProductId`, `Quantity`, `Price`) 
                  VALUES ($cartid, $pr_id, $qty, $priceProduct)";

            return  $this->execute($query);
        }
    }

    public function CheckProducExists($customerid, $pr_id)
    {
        $arrCartItem = $this->GetCartItemByUser($customerid);

        $productIds = array_column($arrCartItem, 'ProductId');

        return in_array($pr_id, $productIds);
    }


    public function GetCustomerCartID($customerid)
    {
        $query = "SELECT c.id as cartid, ct.ProductId as productid, ct.ID as cartitemid
                    FROM cart c JOIN cartitem as ct 
                    ON ct.CartId = c.ID 
                    WHERE c.CustomerId = $customerid";
        return $this->select($query);
    }

    public function GetCartCustomer($customerid)
    {
        $query = "SELECT * from cart as c WHERE c.CustomerId = $customerid";
        return $this->selectOne($query);
    }

    public function GetProduct($prid)
    {
        $query = "SELECT * FROM product WHERE ID = $prid";
        return $this->selectOne($query);
    }

    public function AddNewCartForUser($customerid)
    {
        $datenow = date("Y-m-d H:i:s");
        $query = "INSERT INTO `cart`(`CustomerId`, `CreatedDate`) VALUES($customerid, '$datenow')";
        return $this->execute($query);
    }
}
