<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Redirect;
use App\Model\Menu;
use App\Model\Restaurant;
use App\Model\Restaurateur;
use App\Model\ItemMenu;
use App\Component\Form;

class RestaurateurController extends Controller{
    
    public function index()
    {
        //If we are not connected as a restaurateur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR){
            return Redirect::to('/restaurateur/login');
        }
        
        return View::render("restaurateur/index.php", array('user' => Session::getUser()));
    }
    
    public function login()
    {
        //If the register form was sent
        if(Form::exists('restaurateur_login_form')){
            
            //Check if User exists
            $user = Restaurateur::getOneBy(array('_mail' => Form::get('mail')));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == Restaurateur::encryptPassword(Form::get('password'))){
                Session::connect($user);
                return Redirect::to('/restaurateur');
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("restaurateur/login.php", array('error'=>$error));
        }
        
        return View::render("restaurateur/login.php");
    }

    public function editeMenu($id = 0)
    {
        //If we are not connected as a Restaurateur, send to the login page
        if (!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR) {
            return Redirect::to('/restaurateur/login');
        }

        //If no restaurant is specified, display the list
        if ($id == 0) {
            $restaurants = Restaurant::getBy(array());
            return View::render("restaurateur/listeEditeMenu.php", array('restaurants' => $restaurants));
        }

        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($id)));
        $menu = $restaurant->getMenu();
        if (!$menu) {
            $menu = new Menu();
            $menu->setRestaurant($restaurant);
            $menu->save();
            $restaurant->setMenu($menu);
            $restaurant->save();
        }

        if (Form::exists('menu_edit_form'))
        {
            if(Form::checkEmpty(array('name', 'description', 'price'))){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'restaurant' => $restaurant));
            }

            //We check if the name is not already taken
            $found = ItemMenu::getOneBy(array('_name' => Form::get('name'), 'menu' => new \MongoId($restaurant->getMenu()->getId())));
            if ($found) {
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Nom déjà pris.");
                $error = "Ce nom est déjà enregistré dans le menu.";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'restaurant' => $restaurant));
            }

            //We associate the values
            $itemMenu = new ItemMenu();
            $itemMenu->setName(Form::get('name'));
            $itemMenu->setDescription(Form::get('description'));
            $itemMenu->setPrice(Form::get('price'));
            $itemMenu->setMenu($menu);
            $itemMenu->save();
            
            
            $menu->addItem($itemMenu);
            $menu->save();
        }

        if(Form::exists('menu_name_edit_form'))
        {
            if(Form::checkEmpty(array('menuName'))){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Tous les champs ne sont pas remplis.");
                $error = "Veuillez indiquer un nom de menu";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'restaurant' => $restaurant));
            }

            if($menu->getName()==Form::get('menuName')){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Le nom n'a pas été modifié.");
                $error = "Le nom n'a pas changé.";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'restaurant' => $restaurant));
            }

            $menu->setName(Form::get('menuName'));
            $menu->save();
        }

        return View::render("restaurateur/editeMenu.php", array('restaurant' => $restaurant));
    }
}