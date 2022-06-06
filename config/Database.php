<?php

class Database
{
    private $host = 'localhost';
    private $dbName = 'testdb';
    private $userName = 'postgres';
    private $password = 'muayyad';
    private $connection;


    // making connection with the database
    public function connectToDB()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->dbName, $this->userName, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
        }
        return $this->connection;
    }
}
