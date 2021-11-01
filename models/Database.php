<?php

class Database
{
    const HOST = 'db5005663974.hosting-data.io';
    const DBNAME = 'dbs4769581';
    const USERNAME = 'dbu2165274';
    const PASSWORD = 'Uujr24-ar';
    private static $obj;

    private static function getConn()
    {
        if (!isset(self::$obj)) {
            self::$obj = new PDO('mysql:host=' . self::HOST . '; dbname=' . self::DBNAME . '; charset=utf8', self::USERNAME, self::PASSWORD);
        }
        return self::$obj;
    }

    public static function getAllPlayers()
    {
        $connection = self::getConn();
        $query = 'SELECT * FROM characters';
        $statement = $connection->query($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public static function getAllCharacters()
    {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters');
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $characters;
    }

    public static function getOneCharacter($id)
    {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $character = $stmt->fetch(PDO::FETCH_ASSOC);
        return $character;
    }

    public static function getAllPlayers2()
    {
        $connection = self::getConn();
        $query = 'SELECT * FROM characters2';
        $statement = $connection->query($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }
    public static function getAllCharacters2()
    {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters2');
        $stmt->execute();
        $characters2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $characters2;
    }

    public static function getOneCharacter2($id)
    {
        $bdd = self::getConn();
        $stmt = $bdd->prepare('SELECT * FROM characters2 WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $character2 = $stmt->fetch(PDO::FETCH_ASSOC);
        return $character2;
    }
}
