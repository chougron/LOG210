<h2>Résumé de la commande :</h2>

<?php $total = 0; ?>
<?php foreach($command->getItems() as $item): ?>
<?php if($item->quantity != 0): ?>
<?php echo $item->getName(); ?> | 
Unité : <?php echo $item->getPrice(); ?>$ | 
<?php echo $item->quantity; ?>x | 
<?php $_total = $item->getPrice() * $item->quantity; $total += $_total; ?>
Total : <?php echo $_total ?>$
<?php endif; ?>
<?php endforeach; ?><br/><br/>

Total de la commande : <?php echo $total; ?>$ <br/>
Adresse : <?php echo $command->getAddress()->getAddress(); ?>

<form method="post" action="restaurant/validateCommand/<?php echo $command->getId(); ?>">
    <div class="form-group">
        Date et heure de la commande
        <input type="text" class="form-control" placeholder="Date et heure" name="datetime">
    </div>

    <div class="form-group">
        <input type="submit" value="Valider la date et l'heure" name="validate_command_form" class="btn btn-primary form-control">
    </div>
</form>

<a href="<?php echo $address; ?>">Payer</a>