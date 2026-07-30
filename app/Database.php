<?php

class Database
{
    private $connection;

    public function __construct($config)
    {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";

        try {
            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password']
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    public function connection()
    {
        return $this->connection;
    }
}
