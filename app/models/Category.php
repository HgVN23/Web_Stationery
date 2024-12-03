<?php

class Category extends Model
{
    public function countCategory($params = null)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;
        $query = "SELECT COUNT(*) AS numbercategory FROM category";

        if ($strsearch !== null) {
            $query .= " WHERE CategoryName LIKE '%{$strsearch}%'";
        }
        return $this->selectOne($query)['numbercategory'];
    }
    // Hàm lấy tất cả sản phẩm
    public function getAllCategory($categoryname = "")
    {
        $query = "SELECT * FROM `category` WHERE CategoryName LIKE '%$categoryname%'";
        return $this->select($query);
    }

    public function getCategoryFeature()
    {
        $query = "SELECT * FROM `category` WHERE IsFeature = 1 LIMIT 4";
        return $this->select($query);
    }

    public function getAllCategoryandCoundProduct()
    {
        $query = "SELECT c.ID, c.CategoryName, COUNT(p.ID) AS product_count
                    FROM category c
                    LEFT JOIN product p ON c.id = p.CategoryId
                    GROUP BY c.ID, c.CategoryName;";
        return $this->select($query);
    }

    public function GetCategoryByID($categoryID)
    {
        $query = "SELECT * FROM `category` WHERE ID = $categoryID";
        return $this->selectOne($query);
    }



    public function getCategoryCurrentPage($limit, $offset, $params)
    {
        $strsearch = isset($params['keyword']) ? $params['keyword'] : null;

        $query = "SELECT * FROM category ";

        if ($strsearch !== null) {
            $query .= "WHERE CategoryName LIKE '%{$strsearch}%'";
        }

        // Thêm giới hạn và bù trừ
        $query .= " LIMIT $limit OFFSET $offset";
        return $this->select($query);
    }

    // Hàm thêm sản phẩm mới
    public function addCategory($CategoryName, $Description, $IsFeature)
    {
        $query = "INSERT INTO `category`( `CategoryName`, `Description`, `IsFeature`) VALUES ('$CategoryName', '$Description', '$IsFeature')";
        return $this->execute($query);
    }


    public function UpdateCategory($categoryID, $CategoryName, $Description, $IsFeature)
    {
        $query = "UPDATE Category SET CategoryName = '$CategoryName', Description = '$Description', IsFeature = '$IsFeature' WHERE ID = '$categoryID'";
        return $this->execute($query);
    }

    public function UpdateIsFeature($categoryId, $IsFeature)
    {
        $query = "UPDATE category set IsFeature = $IsFeature where ID = $categoryId";
        return $this->execute($query);
    }


    public function DeleteCategory($categoryId)
    {
        $query = "DELETE FROM category where ID = $categoryId";
        return $this->execute($query);
    }

    // Hàm đóng kết nối
    public function close()
    {
        parent::close(); // Đóng kết nối của lớp cha
    }
}
