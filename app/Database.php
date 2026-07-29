<?php

class Database
{
    private $connection;

    public function __construct($config)
    {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";

        $this->connection = new PDO(
            $dsn,
            $config['username'],
            $config['password']
        );

        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function connection()
    {
        return $this->connection;
    }
}
