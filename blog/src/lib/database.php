<?php

namespace Application\Lib\Database;

class DatabaseConnection
{
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=mysql;dbname=blog;charset=utf8', 'root', 'dbroot');
        }

        return $this->database;
    }
}
