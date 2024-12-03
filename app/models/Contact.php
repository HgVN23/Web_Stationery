<?php
class Contact extends Model
{
    public function InsertMessage($params)
    {
        $datenow = date('Y-m-d H:i:s');
        $query = "INSERT INTO `contact`(`CustomerName`, `Email`, `Message`, `ContactDate`, `IsReplied`) 
                        VALUES ('{$params['fullname']}', '{$params['email']}', '{$params['message']}', '$datenow', '0')";

        return $this->execute($query);
    }

    public function countAllMessages($params = null)
    {
        $query = "SELECT COUNT(*) as numbermessage FROM `contact`";
        return $this->selectOne($query)['numbermessage'];
    }

    public function getMessagesCurrentPageForAdmin($limit, $offset, $params = null)
    {
        $query = "SELECT * FROM `contact` ORDER BY ContactDate DESC  LIMIT $limit OFFSET $offset";
        return $this->select($query);
    }

    public function getDetailMessagesAdmin($contactid)
    {
        $query = "SELECT * FROM `contact` WHERE ID = $contactid";
        return $this->selectOne($query);
    }

    public function UpdateStatusMessage($contactid)
    {
        $query = "UPDATE `contact` SET IsReplied = 1 WHERE ID = $contactid";
        return $this->execute($query);
    }

    public function DeleteMessage($contactid)
    {
        $query = "DELETE FROM `contact` WHERE ID = $contactid";
        return $this->execute($query);
    }
}
