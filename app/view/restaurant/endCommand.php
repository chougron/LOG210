<h2>Validation de la commande</h2>
Votre commande a bien été validée.<br/>

Numéro de confirmation : <?php echo $command->getConfirmation(); ?><br/><br/>

Adresse de livraison : <?php echo $command->getAddress()->getAddress(); ?><br/><br/>
Date prévue de la livraison :  <?php echo $command->getDateTime(); ?><br/><br/>

Items : <br/><br/>
<?php foreach ($command->getItems() as $item):?>
- <?php echo $item->getName(); ?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Prix : <?php echo $item->getPrice();?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Quantité : <?php echo $item->quantity;?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Sous-Total : <?php echo $item->quantity * $item->getPrice();?><br/>
<?php endforeach; ?><br/>

Total : <?php echo $command->getPrice(); ?><br/><br/>

Adresse : <?php echo $command->getAddress()->getAddress(); ?><br/>

Un mail contenant les informations de la commande vous a été envoyé.