<h2>Résumé de la commande :</h2>

<?php foreach($command->getItems() as $item): ?>
<?php if($item->quantity != 0): ?>
<?php echo $item->quantity; ?>x <?php echo $item->getName(); ?>
<?php endif; ?>
<?php endforeach; ?>

Adresse : <?php echo $command->getAddress()->getAddress(); ?>

