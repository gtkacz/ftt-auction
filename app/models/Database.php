<?php

namespace App\models;

use PDO;
use PDOException;

class Database
{
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DB_NAME = "product_list";

    private $table;
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        if (!isset($this->connection)) {
            $this->createConnection();
        }
    }

    private function createConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    private function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        $query = 'INSERT INTO ' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        $this->execute($query, array_values($values));
    }

    public function select($where = null, $order = null, $fields = "*")
    {
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';

        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . '';

        return $this->execute($query);
    }

    public function update($where, $values)
    {
        $fields = array_keys($values);
        $query = 'UPDATE ' . $this->table . ' SET ' . implode('=?,', $fields) . '=? WHERE ' . $where;

        $this->execute($query, array_values($values));

        return true;
    }

    public function delete($where)
    {
        $query = "DELETE FROM {$this->table} WHERE {$where}";

        $this->execute($query);

        return true;
    }
}