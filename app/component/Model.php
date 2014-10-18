<?php

namespace App\Component;

use App\Component\Database;

class Model {
    
    /**
     * The ID of the object in the DB
     * @var String
     */
    protected $_id;
    
    /**
     * Return the ID of the object
     * @return String
     */
    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
    }

        
    
    /**
     * Save a model in the DB
     * @return boolean
     * TODO: Work with errors, do updates if object have an _id
     */
    public function save()
    {
        Database::save(self::getCollectionName(), $this);
        return true;
    }
    
    /**
     * Delete a model in the DB
     */
    public function delete()
    {
        Database::delete(self::getCollectionName(), $this);
    }
    
    /**
     * Return Models found in the db where the var has the value $value
     * @param String $var The var to compare
     * @param mixed $value The value of the var
     * @return \App\Component\Model;
     */
    public static function getBy($array)
    {
        $objects = Database::getWhere(self::getCollectionName(), $array);
        
        $hydrated = array();
        
        foreach($objects as $object){
            $className = get_called_class();
            $model = new $className;
            $model->hydrate($object);
            
            $hydrated[] = $model;
        }
        
        return $hydrated;
    }
    
    /**
     * Return a Model found in the db checking the array
     * @param String $array
     * @param mixed $value
     * @return \App\Component\Model
     */
    public static function getOneBy($array)
    {
        $object = Database::getOne(self::getCollectionName(), $array);
        
        if(!$object){
            return null;
        }
        
        $className = get_called_class();
        $model = new $className;
        $model->hydrate($object);
        
        return $model;
    }
    
    /**
     * Return an usable collection name from the class name
     * @return String
     */
    private static function getCollectionName()
    {
        $className = get_called_class();
        $array = explode('\\',$className);
        return $array[count($array)-1];
    }
    
    /**
     * Hydrate a Model from an array of value
     * @param mixed $array
     */
    public function hydrate($array)
    {
        foreach($array as $key => $value){
            $this->$key = $value;
        }
    }
    
    /**
     * Return the Array created from the values of the Model
     * @return mixed
     */
    public function toArray()
    {
        $array = array();
        
        foreach($this as $key => $value){
            if($key != '_id'){
                $array[$key] = $value;
            } else {
                if(!is_null($value)){
                    $array[$key] = $value;
                }
            }
        }
        
        return $array;
    }
}