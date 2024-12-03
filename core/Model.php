<?php
require './core/Database.php';
class Model
{
    protected $db;

    public function __construct()
    {
        // Kết nối đến cơ sở dữ liệu
        $this->db = new Database();
    }

    public function selectOneByParams($query, $params = [], $types = "")
    {
        return $this->db->selectOneByParams($query, $params, $types);
    }

    public function executeByParams($query, $params = [], $types = "")
    {
        return $this->db->executeByParams($query, $params, $types);
    }

    public function executeMultipleRecords($query, $records, $types = "")
    {
        return $this->db->executeMultipleRecords($query, $records, $types);
    }

    public function selectOne($query)
    {
        return $this->db->selectOne($query);
    }

    public function select($query)
    {
        return $this->db->select($query);
    }

    // Hàm thực hiện các truy vấn INSERT, UPDATE, DELETE
    public function execute($query)
    {
        return $this->db->execute($query);
    }

    // Đóng kết nối
    public function close()
    {
        $this->db->close();
    }
}
