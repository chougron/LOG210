<?php

namespace App\Component;

use App\Model\Commande;

class MailSender {
    
    
    public static function sendConfirmationMail(Commande $command){
        $message = "Votre commande a bien été validée.<br/>";
        $message.= "Numéro de confirmation : " . $command->getConfirmation() . "<br/><br/>";
        $message.= "Adresse de livraison : " . $command->getAddress()->getAddress() . "<br/><br/>";
        $message.= "Date prévue de la livraison :  " . $command->getDateTime() . "<br/><br/>";
        $message.= "Items : <br/><br/>";
        foreach ($command->getItems() as $item){
            $message.= "- " . $item->getName() ."<br/>";
            $message.= "&nbsp;&nbsp;&nbsp;&nbsp;Prix : " . $item->getPrice() . "<br/>";
            $message.= "&nbsp;&nbsp;&nbsp;&nbsp;Quantité : " . $item->quantity ."<br/>";
            $message.= "&nbsp;&nbsp;&nbsp;&nbsp;Sous-Total : " . $item->quantity * $item->getPrice() ."<br/>";
        }
        $message.= "Total : " . $command->getPrice() . "<br/><br/>";
        $message.= "Adresse : " . $command->getAddress()->getAddress() . "<br/>";
        
        $objet = "Confirmation de votre commande";
        
        $destinataire = $command->getClient()->getMail();
        
        ini_set("SMTP", "aspmx.l.google.com");
        ini_set("sendmail_from", "camille.hougron@gmail.com");
        
        $headers = "From: YOURMAIL@gmail.com";
        
        mail("camille.hougron@gmail.com", $objet, $message, $headers);
    }
}
