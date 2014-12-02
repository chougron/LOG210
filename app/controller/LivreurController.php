<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Component\Redirect;
use App\Model\Commande;
use App\Model\Livreur;
use App\Component\Form;

class LivreurController extends Controller{
    
    public function index()
    {
        //If we are not connected as a livreur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_LIVREUR){
            Session::disconnect();
            return Redirect::to('/livreur/login');
        }
        
        return View::render("livreur/index.php", array('user' => Session::getUser()));
    }
    
    public function login()
    {
        //If the register form was sent
        if(Form::exists('livreur_login_form')){
            
            //Check if User exists
            $user = Livreur::getOneBy(array('_mail' => Form::get('mail')));
            
            //Confirm if PW matches
            if($user && $user->getPassword() == Livreur::encryptPassword(Form::get('password'))){
                Session::connect($user);
                return Redirect::to('/livreur');
            }
            
            $error = "Vos informations de connexion sont incorrects. Merci de réessayer.";
            return View::render("livreur/login.php", array('error'=>$error));
        }
        
        return View::render("livreur/login.php");
    }
    
    public function commandes()
    {
        //If we are not connected as a livreur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_LIVREUR){
            Session::disconnect();
            return Redirect::to('/livreur/login');
        }
        
        $commandes = Commande::getBy(array('_status'=>  Commande::COMMAND_STATUS_READY));
        
        return View::render("livreur/commandes.php", array('commandes'=>$commandes));
    }
    
    public function commande($idCommande)
    {
        //If we are not connected as a livreur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_LIVREUR){
            Session::disconnect();
            return Redirect::to('/livreur/login');
        }
        
        $commande = Commande::getOneBy(array('_id'=> new \MongoId($idCommande)));
        
        if(!$commande){
            return Redirect::to('/livreur/commandes');
        }
        
        return View::render("livreur/commande.php", array('commande'=>$commande, 'user' => Session::getUser()));
    }
    
    public function addCommande($idCommande)
    {
        //If we are not connected as a livreur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_LIVREUR){
            Session::disconnect();
            return Redirect::to('/livreur/login');
        }
        
        $commande = Commande::getOneBy(array('_id'=> new \MongoId($idCommande)));
        
        if(!$commande){
            return Redirect::to('/livreur/commandes');
        }
        
        //If the Commande already has a Livreur, redirect
        if($commande->getLivreur()){
            return Redirect::to('/livreur/commandes');
        }
        
        $commande->setLivreur(Session::getUser());
        $commande->save();
        
        return Redirect::to('/livreur/commande/'.$idCommande);
    }
    
    public function mesCommandes()
    {
        //If we are not connected as a livreur, send to the login page
        if(!Session::isConnected() || Session::getUser()->getType() != USER_LIVREUR){
            Session::disconnect();
            return Redirect::to('/livreur/login');
        }
        
        $commandes = Commande::getBy(array('_livreur'=>  Session::getUser()->getId()));
        
        return View::render("livreur/mesCommandes.php", array('commandes'=>$commandes));
    }
    
}