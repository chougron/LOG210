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

Prix : <?php echo $command->getPrice(); ?><br/><br/>

<br/>
<?php $total = 0; ?>
<?php foreach($command->getItems() as $item): ?>
<?php if($item->quantity != 0): ?>
<?php echo $item->getName(); ?> | 
Unité : <?php echo $item->getPrice(); ?>$ | 
<?php echo $item->quantity; ?>x | 
<?php $_total = $item->getPrice() * $item->quantity; $total += $_total; ?>
Total : <?php echo $_total ?>$ <br/>
<?php endif; ?>
<?php endforeach; ?><br/><br/>

Total de la commande : <?php echo $total; ?>$ <br/>
Adresse : <?php echo $command->getAddress()->getAddress(); ?><br/>

Un mail contenant les informations de la commande vous a été envoyé.