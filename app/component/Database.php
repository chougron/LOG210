<?php

namespace App\Component;

use \MongoClient;

class Database {
    /**
     * Connection to the Mongo DB
     * @var \MongoClient
     */
    private static $connection;
    /**
     * Database selected
     * @var \MongoDB
     */
    private static $database;
    /**
     * The name of the Mongo Database
     * @var String
     */
    private static $databaseName = 'log210';
    
    /**
     * Build an instance of the connection and database to use for later
     */
    public static function setInstance()
    {
        self::$connection = new MongoClient;
        self::$database = self::$connection->selectDB(self::$databaseName);
    }
    
    /**
     * Get one Object from the Database
     * @param String $table
     * @param mixed $array
     * @return type
     */
    public static function getOne($table, $array)
    {
        $collection = self::$database->$table;
        $object = $collection->findOne($array);
        
        return $object;
    }
    
    public static function getWhere($table, $array)
    {
        //TODO: Later
    }
    
    /**
     * 
     * @param String $table
     * @param \App\Component\Model $object
     */
    public static function insert($table, $object)
    {
        $collection = self::$database->$table;
        $collection->insert($object->toArray());
    }
    
    public static function update($table, $object)
    {
        //TODO: Later
    }
    
    public static function delete($table, $object)
    {
        //TODO: Later
    }
}

Database::setInstance();