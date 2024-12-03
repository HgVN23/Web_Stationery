<?php
class User extends Model
{

    public function countUserCustomers($params = null)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;
        $query = "SELECT COUNT(*) AS numberusercustomer FROM `user` u INNER JOIN `customer` cu ON u.ID = cu.UserID ";

        if ($strsearch !== null) {
            $query .= "WHERE Username  LIKE '%{$strsearch}%' OR CustomerName  LIKE '%{$strsearch}%' AND role = 'customer'";
        }
        return $this->selectOne($query)['numberusercustomer'];
    }
    // check login
    public function findUser($params)
    {
        $username = $params['username'];
        $password = $params['password'];
        // $query = "SELECT * FROM user WHERE username = ? AND `role` = 'customer' AND IsActive = 1";
        $query = "SELECT * FROM user WHERE username = ? AND `role` = 'customer'";
        $user = $this->selectOneByParams($query, [$username], "s");
        if ($user && password_verify($password, $user['PasswordHash'])) {

            return $user;
        } else {

            return null;
        }
    }

    public function checkpassword($params)
    {
        $username = $params['username'];
        $currentpass = $params['currentpass'];
        $query =  "SELECT PasswordHash FROM user WHERE `Role` ='customer'  AND IsActive = 1 and  username = ?";
        $result = $this->selectOneByParams($query, [$username], "s");
        if ($result && password_verify($currentpass, $result['PasswordHash'])) {
            return true;
        } else {
            return false;
        }
    }


    public function UpdatePassword($params)
    {
        $username = $params['username'];
        $newpass = password_hash($params['newpass'], PASSWORD_DEFAULT);
        $query =  "UPDATE `user` SET PasswordHash = ? WHERE username = ? AND  `Role` = 'customer'  AND IsActive = 1";
        return $this->executeByParams($query, [$newpass, $username,], "ss");
    }

    public function CheckExistsUsername($username)
    {
        $query = "SELECT username FROM `user` WHERE username = ?";
        $result = $this->selectOneByParams($query, [$username], "s");
        return $result ? true : false;
    }


    public function getInfoUserById($params)
    {
        $user = $this->findUser($params);
        if ($user) {
            $id = $user['ID'];
            $query = "SELECT * FROM `customer` WHERE UserID = ?";
            $InfoUser = $this->selectOneByParams($query, [$id,], 'i');
            $InfoUser['username'] = $user['Username'];
            $InfoUser['IsActive'] = $user['IsActive'];
            return $InfoUser;
        }
        return null;
    }

    public function getInfoUserByIdSession()
    {
        if (isset($_SESSION['user'])) {
            $id = $_SESSION['user']['ID'];
            $query = "SELECT * FROM `customer` WHERE UserID = $id";
            return $this->selectOne($query);
        }
    }

    public function addNewUser($params)
    {
        $password = password_hash($params['password'], PASSWORD_DEFAULT);
        $query = sprintf(
            "INSERT INTO `user` (`Username`, `PasswordHash`, `role`, `IsActive`) 
            VALUES ('%s', '%s', '%s', %d)",
            $params['username'],
            $password,
            'customer',
            1
        );
        return $this->execute($query);
    }

    public function GetIdByUsername($username)
    {
        $query = "SELECT ID FROM `user` WHERE Username = '$username'";
        return $this->selectOne($query);
    }


    public function getUsersCurrentPageForAdmin($limit, $offset, $params)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;

        $query = "SELECT *, u.ID AS user_id, cu.ID AS customer_id FROM `user` u INNER JOIN `customer` cu ON u.ID = cu.UserID";

        if ($strsearch !== null) {
            $query .= " WHERE Username  LIKE '%{$strsearch}%' OR CustomerName  LIKE '%{$strsearch}%' AND role = 'customer'";
        }

        $query .= " LIMIT $limit OFFSET $offset";
        return $this->select($query);
    }

    public function getDetailsUserCustomersForAdmin($user_id)
    {
        $query = "SELECT *, u.ID AS user_id, cu.ID AS customer_id 
                    FROM `user` u 
                    INNER JOIN `customer` cu ON u.ID = cu.UserID
                    WHERE u.ID = $user_id";
        return $this->selectOne($query);
    }

    public function loginUserAdmin($params)
    {
        $username = $params['username'];
        $password = $params['password'];

        $query = "SELECT * FROM user WHERE username = ? AND `role` = 'admin'";
        $user = $this->selectOneByParams($query, [$username], "s");
        if ($user && password_verify($password, $user['PasswordHash'])) {

            return ['username' => $username];
        } else {

            return null;
        }
    }

    public function lockAccount($user_id)
    {
        $query = "UPDATE user SET IsActive = 0 WHERE `role` = 'CUSTOMER' AND ID = $user_id";
        return $this->execute($query);
    }
    public function unlockAccount($user_id)
    {
        $query = "UPDATE user SET IsActive = 1 WHERE `role` = 'CUSTOMER' AND ID = $user_id";
        return $this->execute($query);
    }
}
