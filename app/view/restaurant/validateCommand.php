<h2>Résumé de la commande :</h2>

Items : <br/><br/>
<?php foreach ($command->getItems() as $item):?>
- <?php echo $item->getName(); ?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Prix : <?php echo $item->getPrice();?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Quantité : <?php echo $item->quantity;?><br/>
&nbsp;&nbsp;&nbsp;&nbsp;Sous-Total : <?php echo $item->quantity * $item->getPrice();?><br/>
<?php endforeach; ?><br/>

Total : <?php echo $command->getPrice(); ?><br/><br/>

Adresse : <?php echo $command->getAddress()->getAddress(); ?><br/>

<form method="post" action="restaurant/validateCommand/<?php echo $command->getId(); ?>">
    <div class="form-group">
        Date et heure de la commande
        <input type="text" class="form-control" placeholder="Date et heure" name="datetime">
    </div>

    <div class="form-group">
        <input type="submit" value="Valider la date et l'heure" name="validate_command_form" class="btn btn-primary form-control">
    </div>
</form>