<?php

namespace App\Component;

use App\Model\Entrepreneur;
use App\Model\Restaurateur;
use App\Model\Restaurant;
use App\Model\Client;

class DatabaseSeeder {
    /**
     * Seed the Database with test users and restaurants
     */
    public function seed()
    {
        $this->addRestaurants();
        $this->addUsers();
        $this->associateRestaurants();
    }
    
    /**
     * Seed the Database with Users
     */
    private function addUsers()
    {
        //Add the Entrepreneur if he doesn't exist
        if(! Entrepreneur::getOneBy(array('_mail'=>"admin@test.com"))){
            $user = new Entrepreneur();
            $user->setFirstName("Bill");
            $user->setName("Gates");
            $user->setMail("admin@test.com");
            $user->setPassword("123123");
            $user->save();
        }
        
        //Add a Restaurateur if he doesn't exist
        if(! Restaurateur::getOneBy(array('_mail'=>"restaurateur@test.com"))){
            $user = new Restaurateur();
            $user->setFirstName("Mac");
            $user->setName("Donald");
            $user->setMail("restaurateur@test.com");
            $user->setPassword("123123");
            $user->save();
        }
        
        //Add a Restaurateur if he doesn't exist
        if(! Client::getOneBy(array('_mail'=>"client@test.com"))){
            $user = new Client();
            $user->setFirstName("Jean");
            $user->setName("Bon");
            $user->setMail("client@test.com");
            $user->setAdress("18 Rue des Roses");
            $user->setBirthday("10 Janvier 1973");
            $user->setPhoneNumber("593 489 2354");  
            $user->setPassword("123123");
            $user->save();
        }
    }
    
    private function addRestaurants()
    {
        if(!Restaurant::getOneBy(array('name'=>'Ma Queue Mickey'))){
            $restaurant = new Restaurant();
            $restaurant->setName('Ma Queue Mickey');
            $restaurant->save();
        }
        if(!Restaurant::getOneBy(array('name'=>'Kitchen For Chinese'))){
            $restaurant = new Restaurant();
            $restaurant->setName('Kitchen For Chinese');
            $restaurant->save();
        }
        if(!Restaurant::getOneBy(array('name'=>'Sous-marins express'))){
            $restaurant = new Restaurant();
            $restaurant->setName('Sous-marins express');
            $restaurant->save();
        }
    }
    
    private function associateRestaurants()
    {
        $user = Restaurateur::getOneBy(array('_mail'=>"restaurateur@test.com"));
        
        $restaurant = Restaurant::getOneBy(array('name'=>'Ma Queue Mickey'));
        $user->addRestaurant($restaurant);
        
        $user->save();
    }
}