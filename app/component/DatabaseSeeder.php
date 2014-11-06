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
            $user->setFirstName("MacDonald");
            $user->setName("Ronald");
            $user->setMail("restaurateur@test.com");
            $user->setPassword("123123");
            $user->save();
        }
        
        //Add a Restaurateur if he doesn't exist
        if(! Restaurateur::getOneBy(array('_mail'=>"restaurateur2@test.com"))){
            $user = new Restaurateur();
            $user->setFirstName("Tiki");
            $user->setName("Ming");
            $user->setMail("restaurateur2@test.com");
            $user->setPassword("123123");
            $user->save();
        }

        //Add a Restaurateur if he doesn't exist
        if(! Restaurateur::getOneBy(array('_mail'=>"restaurateur3@test.com"))){
            $user = new Restaurateur();
            $user->setFirstName("Jean");
            $user->setName("Bono");
            $user->setMail("restaurateur3@test.com");
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
            $restaurant->setDescription('Un sympathique petit restaurant aux allures pitoresques, et qui ne manque pas de joyeux serveurs prêts à répondre à vos exigences !');
            $restaurant->setPicture("img/generic.jpg");
            $restaurant->save();
        }
        if(!Restaurant::getOneBy(array('name'=>'Kitchen For Chinese'))){
            $restaurant = new Restaurant();
            $restaurant->setName('Kitchen For Chinese');
            $restaurant->setDescription('Venez manger chinois dans ce joli restaurant. KFC et toute son équipe vous accueillent 24h/24, et travaillerons durs, comme des vrais petits chinois pour que vous puissiez profiter du buffet à volonté.');
            $restaurant->setPicture("img/chinois.jpg");
            $restaurant->save();
        }
        if(!Restaurant::getOneBy(array('name'=>'Sous-marins express'))){
            $restaurant = new Restaurant();
            $restaurant->setName('Sous-marins express');
            $restaurant->setDescription('Si tu veux des sous-marins, et vite, tu es au bon endroit. Notre chef, Pablo, est recordman du nombre de sou-marins préparés en 10 minutes. Goûte à notre spécial "moutarde/sirop d\'érable" !');
            $restaurant->setPicture("img/generic.jpg");
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