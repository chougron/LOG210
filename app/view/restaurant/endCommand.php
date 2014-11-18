<?php 
    $items = $command->getItems();
?>

<h2>Validation de la commande</h2>
Votre commande a bien été validée.<br/>

Numéro de confirmation : <?php echo $command->getConfirmation(); ?><br/><br/>

Adresse de livraison : <?php echo $command->getAddress()->getAddress(); ?><br/><br/>
Date prévue de la livraison :  <?php echo $command->getDateTime(); ?><br/><br/>

Items : <br/><br/>
<?php foreach ($items as $item) {
    ?> - <?php echo $item->getName(); ?><br/>&nbsp;&nbsp;&nbsp;&nbsp;Quantité : <?php echo $item->quantity;?> <br/> <?php
} ?><br/>

Un mail contenant les informations de la commande vous a été envoyé.
