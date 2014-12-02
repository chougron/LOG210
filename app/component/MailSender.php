<?php

namespace App\Component;

use App\Model\Commande;
use PHPMailer;
use SMTP;

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
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'log210.3@gmail.com';
        $mail->Password = 'YvanRoss';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->From = 'log210.3@gmail.com';
        $mail->FromName = 'LOG 210';
        $mail->addAddress('camille.hougron@gmail.com', 'Camille Hougron');
        $mail->addReplyTo('log210.3@gmail.com', 'LOG 210');
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        $mail->Subject = $objet;
        $mail->Body    = $message;
        if(!$mail->send()) {
           exit;
        }
    }
}
