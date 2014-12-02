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
use App\Model\Commande;

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

    public function selectRestaurant($id = 0){
        //If we are not connected as a Restaurateur, send to the login page
        if (!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR) {
            return Redirect::to('/restaurateur/login');
        }

        //If no restaurant is specified, display the list
        if ($id == 0) {
            $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId(Session::getUser()->getId())));
            $restaurants = $restaurateur->getRestaurants();
            return View::render("restaurateur/listeSelectRestaurant.php", array('restaurants' => $restaurants));
        }

        $restaurant = Restaurant::getOneBy(array('_id' => new \MongoId($id)));
        $menus = $restaurant->getMenus();

        if (Form::exists('menu_edit_form'))
        {
            $name = Form::get('name');
            if($name == "" || is_null($name)){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("restaurateur/listeEditeMenu.php", array('error' => $error, 'restaurant' => $restaurant, 'menus' => $menus));
            }

            //We check if the name is not already taken
            $found = Menu::getBy(array('name' => Form::get('name'), 'restaurant' => $restaurant->getId()));
            if ($found) {
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Le nom déjà pris.");
                $error = "Ce nom est déjà enregistré dans le menu.";
                return View::render("restaurateur/listeEditeMenu.php", array('error' => $error, 'restaurant' => $restaurant, 'menus' => $menus));
            }

            //We associate the values
            $menu = new Menu();
            $menu->setName(Form::get('name'));
            $menu->setRestaurant($restaurant);
            $menu->save();


            $restaurant->addMenu($menu);
            $restaurant->save();
        }

        $menus = $restaurant->getMenus();

        return View::render("restaurateur/listeEditeMenu.php", array('menus' => $menus, 'restaurant' => $restaurant));
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
            return View::render("restaurateur/listeSelectRestaurant.php", array('restaurants' => $restaurants));
        }

        $menu = Menu::getOneBy(array('_id' => new \MongoId($id)));

        if (Form::exists('menu_edit_form'))
        {
            $name = Form::get('name');
            $price = Form::get('price');
            if($name == "" || is_null($name) || $price == "" || is_null($price)){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Tous les champs ne sont pas remplis.");
                $error = "Veuillez remplir tous les champs";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'menu' => $menu));
            }
            
            $description = Form::get('description');
            if($description == "" || is_null($description)){
                Session::addFlashMessage("Attention :",
                    'warning',
                    "Vous n'avez pas rempli de description pour cet item.");
            }

            //We check if the name is not already taken
            $found = ItemMenu::getBy(array('name' => Form::get('name'), 'menu' => $menu->getId()));
            if ($found) {
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Le nom déjà pris.");
                $error = "Ce nom est déjà enregistré dans le menu.";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'menu' => $menu));
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
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'menu' => $menu));
            }

            if($menu->getName()==Form::get('menuName')){
                Session::addFlashMessage("Erreur :",
                    'error',
                    "Le nom n'a pas été modifié.");
                $error = "Le nom n'a pas changé.";
                return View::render("restaurateur/editeMenu.php", array('error' => $error, 'menu' => $menu));
            }

            $menu->setName(Form::get('menuName'));
            $menu->save();
        }

        return View::render("restaurateur/editeMenu.php", array('menu' => $menu));
    }

    public function gererCommande($id = 0)
    {
        $restaurateur = Restaurateur::getOneBy(array('_id' => new \MongoId(Session::getUser()->getId())));
        //If we are not connected as a Restaurateur, send to the login page
        if (!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR) {
            return Redirect::to('/restaurateur/login');
        }

        //If no restaurant is specified, display the list
        if ($id == 0) {
            //$commandes = $restaurateur->getCommandes();
            $commandes = Commande::getByRestaurateur($restaurateur);
            return View::render("restaurateur/gestionCommande.php", array('commandes' => $commandes));
        }

        $commande = Commande::getOneBy(array('_id' => new \MongoId($id)));

        if($commande->getStatus() < Commande::COMMAND_STATUS_PREPARING)
        {
            $commande->setStatus(Commande::COMMAND_STATUS_PREPARING);
            $commande->save();
        }

        if(Form::exists('finir_commande_form'))
        {
            $commande->setStatus(commande::COMMAND_STATUS_READY);
            $commande->save();
            $commandes = $restaurateur->getCommandes();
            return View::render("restaurateur/gestionCommande.php", array('commandes' => $commandes));
        }

        return View::render("restaurateur/prepareCommande.php", array('commande' => $commande));

    }

    public function doSupprimeItemMenu($id)
    {
        //If we are not connected as an entrepreneur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_RESTAURATEUR){
            Redirect::to('/restaurateur/login/');
        }

        $itemMenu = ItemMenu::getOneBy(array('_id' => new \MongoId($id)));
        $menu = $itemMenu->getMenu();

        if(!$itemMenu){
            //If the restaurateur doesn't exist, we redirect to the list
            Session::addFlashMessage("Suppression impossible :",
                'error',
                "Cet item n'existe pas.");
            Redirect::to("/restaurateur/editeMenu/".$menu->getId());
        }
        //Then we delete the restaurateur
        $itemMenu->delete();
        Session::addFlashMessage("Item supprimé",
            'success',
            "L'item a été supprimé avec succès.");
        Redirect::to("/restaurateur/editeMenu/".$menu->getId());
    }
}