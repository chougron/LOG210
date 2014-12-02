<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Model\Restaurant;
use App\Component\Redirect;
use App\Model\Commande;
use App\Component\Form;
use App\Component\Session;
use App\Model\Address;
use App\Model\Restaurateur;

class RestaurantController extends Controller{
    
    public function index(){
        //Get all the restaurants
        $restaurants = Restaurant::getBy(array());
        
        return View::render("restaurant/index.php", array('restaurants'=>$restaurants));
    }
    
    public function see($idRestaurant){
        //Get the restaurant by its id
        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($idRestaurant)));
        $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId($restaurant->getRestaurateur()->getId())));
        
        //If User is not logged in
        if(!Session::isConnected() || Session::getUser()->getType() != USER_CLIENT){
            Session::addFlashMessage("Non connecté", "error", "Veuillez vous connecter avant de continuer.");
            Redirect::to('/restaurant');
        }
        //If it doesn't exist, return to the list
        if(!$restaurant){
            Redirect::to('/restaurant');
        }
        
        $client = Session::getUser();
        $addresses = Address::getBy(array('user' => $client->getId()));
        
        if(Form::exists('order_form')){
            $commande = new Commande();
            $restaurateur->addCommande($commande);
            $restaurant->save();
            $menus = $restaurant->getMenus();

            foreach ($menus as $menu) {
                $menuItems = $menu->getMenuItems();

                foreach ($menuItems as $menuItem):
                    $quantity = Form::get($menuItem->getId()->__toString());
                    $commande->setItem($menuItem, $quantity);
                endforeach;
            }
            
            $commande->setClient($client);
            
            $addressId = Form::get('address');
            $address = null;
            if($addressId == 'altAddress'){ //Then we take in accout the altAdress field
                $address = new Address();
                $address->setAddress(Form::get('altAdress'));
                $address->setUser($client);
            } else {
                $address = Address::getOneBy(array('_id' => new \MongoId($addressId)));
                if(!$address){
                    die("Erreur à gérer.");
                    //TODO: ERROR
                }
            }
            $address->setByDefault();
            $address->save();
            
            $commande->setAddress($address);
            $commande->setStatus(Commande::COMMAND_STATUS_TEMPORARY);
            $commande->save();
            
            return Redirect::to("/restaurant/validateCommand/" . $commande->getId());
        }
        
        return View::render("restaurant/see.php", array('restaurant'=>$restaurant, 'client'=> Session::getUser(), 'addresses' => $addresses));
    }
    
    public function validateCommand($commandId){
        
        //If User is not logged in
        if(!Session::isConnected() || Session::getUser()->getType() != USER_CLIENT){
            Session::addFlashMessage("Non connecté", "error", "Veuillez vous connecter avant de continuer.");
            Redirect::to('/restaurant');
        }
        //If it doesn't exist, return to the list
        $command = Commande::getOneBy(array('_id' => new \MongoId($commandId))); //TODO: Add the user ID in the array
        if(!$command){
            Redirect::to('/restaurant');
        }
        
        //If we just validated the command
        if(Form::exists('validate_command_form')){
            $command->setDateTime(Form::get('datetime'));
            
            $command->createConfirmationCode();
            $command->setStatus(Commande::COMMAND_STATUS_VALIDATED);
            
            
            $client = $command->getClient();
            $address = $command->getAddress();
            $client->setAddress($address);
            $client->save();
            
            return View::render("restaurant/payCommand.php", array('command' => $command));
        }
        
        $total = 0;
        foreach($command->getItems() as $item){
            $total += $item->quantity * $item->getPrice();
        }
        $command->setPrice($total);
        $command->save();
        
        return View::render("restaurant/validateCommand.php", array('command' => $command));
    }
    
    public function payCommand($commandId){
        //If User is not logged in
        if(!Session::isConnected() || Session::getUser()->getType() != USER_CLIENT){
            Session::addFlashMessage("Non connecté", "error", "Veuillez vous connecter avant de continuer.");
            Redirect::to('/restaurant');
        }
        
        //If it doesn't exist, return to the list
        $command = Commande::getOneBy(array('_id' => new \MongoId($commandId))); //TODO: Add the user ID in the array
        if(!$command){
            Redirect::to('/restaurant');
        }
        
        $command->setStatus(Commande::COMMAND_STATUS_PAYED);
        $command->save();
        
        return View::render("restaurant/endCommand.php", array('command' => $command));
    }
}