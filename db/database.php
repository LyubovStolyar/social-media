<?php

namespace Social\Pdo;

use PDO;
use Exception;



class Database {
    private
        $db,
        $affected = 0;

    public function connect()
    {
        try {
            $this->db = new PDO(DB_CONFIG, DB_USER, DB_PWD);
        } catch (Exception $err) {
            echo "Error: {$err->getMessage()}";
        }
    }

    public function dbQuery($sql, $params = [])
    {
        $this->affected = 0;

        if (!isset($db) || empty($db)) {
            $this->connect();
        }

        try {
            $query = $this->db->prepare($sql);
            $query->execute($params);
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            $this->affected = $query->rowCount();
        } catch (Exception $err) {
            echo "Error: {$err->getMessage()}";
        }
      
        return $result;
    }

    public function get($param)
    {
        return $this->$param;
    }

    public function close()
    {
        $this->db = null;
    }
}