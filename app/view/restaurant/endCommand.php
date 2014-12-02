<h2>Validation de la commande</h2>
Votre commande a bien été validée.<br/>

Numéro de confirmation : <?php echo $command->getConfirmation(); ?><br/>

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
