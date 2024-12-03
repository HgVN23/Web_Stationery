<?php
class Customer  extends Model
{
    public function UpdateInfo($params)
    {
        $query = sprintf(
            "UPDATE `customer` SET `Phone`='%s', `Email`='%s', `Address`='%s' WHERE ID = %d",
            $params['phone'],
            $params['email'],
            $params['address'],
            $params['userid']
        );
        return $this->execute($query);
    }

    public function AddNewCustomer($params)

    {
        $query = sprintf(
            "INSERT INTO `customer` (`CustomerName`, `Phone`, `Email`, `Address`, `UserID`) 
            VALUES ('%s', '%s', '%s', '%s', %d)",
            $params['fullname'],
            $params['phone'],
            $params['email'],
            $params['address'],
            $params['userid']
        );

        return $this->execute($query);
    }


    public function GetCustomerByuserId($userid)
    {
        $query = "SELECT * from `customer` where UserID = $userid";
        return $this->selectOne($query);
    }
}
