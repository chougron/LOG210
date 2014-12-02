<?php

namespace App\Component;

use App\Model\Entrepreneur;
use App\Model\ItemMenu;
use App\Model\Restaurateur;
use App\Model\Restaurant;
use App\Model\Client;
use App\Model\Address;
use App\Model\Menu;
use App\Model\Commande;
use App\Model\Livreur;

class DatabaseSeeder {
    /**
     * Seed the Database with test users and restaurants
     */
    public function seed()
    {
        $this->addRestaurants();
        $this->addUsers();
        $this->associateRestaurants();
        $this->addMenu();
        $this->addCommande();
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
        
        //Add a Client if he doesn't exist
        $address = Address::getOneBy(array('address' => '18 Rue des Roses'));
        if(!$address){
            $address = new Address();
            $address->setAddress('18 Rue des Roses');
            $address->save();
        }
        if(! Client::getOneBy(array('_mail'=>"client@test.com"))){
            $user = new Client();
            $user->setFirstName("Jean");
            $user->setName("Bon");
            $user->setMail("client@test.com");
            $user->setAddress($address);
            $user->setBirthday("10 Janvier 1973");
            $user->setPhoneNumber("593 489 2354");  
            $user->setPassword("123123");
            $user->save();
            
            $address->setUser($user);
            $address->save();
        }
        
        //Add a Livreur if he doesn't exist
        if(!Livreur::getOneBy(array('_mail'=>"livreur@test.com"))){
            $user = new Livreur();
            $user->setFirstName("Jiang");
            $user->setName("Li");
            $user->setMail("livreur@test.com");
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

    private function addMenu()
    {
        $restaurant = Restaurant::getOneBy(array('name' => 'Ma Queue Mickey'));

        if(!$restaurant->hasMenu()){
            $menu = new Menu();
            $menu->setRestaurant($restaurant);

            $menu->setName("Les suplices de la gueule");
            $menu->save();

            $item1 = new ItemMenu();
            $item1->setName("Burger");
            $item1->setDescription("Un petit pas coupé en deux avec un steak entre les deux.");
            $item1->setPrice(6.95);
            $item1->setMenu($menu);
            $item1->save();

            $menu->addItem($item1);
            $menu->save();

            $item2 = new ItemMenu();
            $item2->setName("Sous-marin 2000");
            $item2->setDescription("Sandwich de 2000g avec pâté de volaille, oeufs brouillés, steak de kangourou et pilulles contre la toux.");
            $item2->setPrice(3.99);
            $item2->setMenu($menu);
            $item2->save();

            $menu->addItem($item2);
            $menu->save();

            $restaurant->addMenu($menu);
            $restaurant->save();
        }
        
        $restaurant = Restaurant::getOneBy(array('name' => 'Kitchen For Chinese'));

        if(!$restaurant->hasMenu()){
            $menu = new Menu();
            $menu->setRestaurant($restaurant);

            $menu->setName("Les plaisirs du palais");
            $menu->save();

            $item1 = new ItemMenu();
            $item1->setName("Poutine cantonaise");
            $item1->setDescription("Frites taillées en grain de riz avec du cantonais en grain");
            $item1->setPrice(25.45);
            $item1->setMenu($menu);
            $item1->save();

            $menu->addItem($item1);
            $menu->save();
            $restaurant->addMenu($menu);
            $restaurant->save();

            $item2 = new ItemMenu();
            $item2->setName("Pâté chinois");
            $item2->setDescription("Inventé en Amérique");
            $item2->setPrice(1.95);
            $item2->setMenu($menu);
            $item2->save();

            $menu->addItem($item2);
            $menu->save();

            $restaurant->addMenu($menu);
            $restaurant->save();
        }
    }

    private function addCommande()
    {
        $commandes = Commande::getBy(array());

        while(count($commandes) <= 5) {
            $commande = new Commande();
            $restaurant = Restaurant::getOneBy(array('name' => 'Ma Queue Mickey'));
            $item = ItemMenu::getOneBy(array('name' => 'Burger'));

            $address = Address::getOneBy(array('address' => '18 Rue des Roses'));
            
            $commande->setItem($item, 2);
            $commande->setStatus(Commande::COMMAND_STATUS_PAYED);
            $commande->setDatetime('12/12/12 12:12');
            $commande->createConfirmationCode();
            $commande->setAddress($address);
            $commande->save();
            
            $restaurant->save();

            $commandes = Commande::getBy(array());
        }
    }
}