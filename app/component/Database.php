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
     * @return mixed
     */
    public static function getOne($table, $array)
    {
        $collection = self::$database->$table;
        $object = $collection->findOne($array);
        
        return $object;
    }
    
    /**
     * Get an array of objects from the Database
     * @param String $table
     * @param mixed $array
     * @return mixed
     */
    public static function getWhere($table, $array)
    {
        $collection = self::$database->$table;
        $cursor = $collection->find($array);
        
        $objects = array();
        
        foreach($cursor as $object){
            $objects[] = $object;
        }
        
        return $objects;
    }
    
    /**
     * Save an Object in the DB
     * @param String $table
     * @param \App\Component\Model $object
     */
    public static function save($table, $object)
    {
        $collection = self::$database->$table;
        $array = $object->toArray();
        $collection->save($array);
        $object->setId($array['_id']);
    }
    
    /**
     * Remove a given Object from the DB
     * @param String $table
     * @param \App\Component\Model $object
     */
    public static function delete($table, $object)
    {
        $collection = self::$database->$table;
        $collection->remove($object->toArray());
    }
}

Database::setInstance();