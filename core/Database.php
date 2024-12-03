<?php
require './config/config.php';
class Database
{
    private $connection;

    public function __construct()
    {
        $this->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    }

    private function connect($host, $username, $password, $database, $port)
    {
        $this->connection = new mysqli($host, $username, $password, $database, $port);

        // Kiểm tra kết nối
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    // Thực hiện truy vấn SELECT và lấy 1 phần tử với tham số
    public function selectOneByParams($query, $params = [], $types = "")
    {
        $stmt = $this->connection->prepare($query);

        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        $stmt->close();

        return $row ? $row : null;
    }


    public function executeByParams($query, $params = [], $types = "")
    {
        $stmt = $this->connection->prepare($query);
        if ($params && $types) {
            $stmt->bind_param($types, ...$params);
        }

        $result =  $stmt->execute();
        return $result;
    }

    public function executeMultipleRecords($query, $records, $types = "")
    {
        $stmt = $this->connection->prepare($query);
        $successCount = 0;
        foreach ($records as $params) {

            $stmt->bind_param($types, ...$params);


            $result = $stmt->execute();


            if (!$result) {

                echo "Error inserting record: " . $stmt->error;
                return false;
            } else {
                $successCount++;
            }
        }
        return $successCount === count($records);
    }

    // Thực hiện truy vấn SELECT và lấy 1 phần tử
    public function selectOne($query)
    {
        $result = $this->connection->query($query);

        if ($result === FALSE) {
            return null;
        }

        // Lấy hàng đầu tiên trong kết quả
        $row = $result->fetch_assoc();

        return $row ? $row : null;
    }

    // Thực hiện truy vấn SELECT
    public function select($query)
    {
        $result = $this->connection->query($query);

        if ($result === FALSE) {
            return [];
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Thực hiện các truy vấn INSERT, UPDATE, DELETE
    public function execute($query)
    {
        return $this->connection->query($query);
    }

    // Đóng kết nối
    public function close()
    {
        $this->connection->close();
    }
}
