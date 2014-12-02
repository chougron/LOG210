<h2>Paiement de la commande</h2>
<hr/>
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

<br/>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1" >
<input type="hidden" name="no_note" value="0" >
<input type="hidden" name="tax" value="0" >
<input type="hidden" name="rm" value="2" >
<?php $i=1; foreach($command->getItems() as $item): ?>
    <input type="hidden" name="item_name_<?php echo $i; ?>" value="<?php echo $item->getName();?>" >
    <input type="hidden" name="amount_<?php echo $i; ?>" value="<?php echo $item->getPrice();?>" >
    <input type="hidden" name="quantity_<?php echo $i; ?>" value="<?php echo $item->quantity;?>" >
<?php $i++; endforeach; ?>
<input type="hidden" name="business" value="log210-3@gmail.com" >
<input type="hidden" name="handling_cart" value="0" >
<input type="hidden" name="currency_code" value="CAD" >
<input type="hidden" name="return" value="http://localhost/log210/restaurant/payCommand/<?php echo $command->getId(); ?>" >
<input type="hidden" name="cbt" value="Retour au site" >
<input type="hidden" name="cancel_return" value="http://localhost/log210/restaurant/cancel/<?php echo $command->getId(); ?>" >
<div class="form-group">
    <input type="submit" value="Payer par paypal" class="btn btn-primary form-control">
</div>
</form>
    <a href="restaurant" class="btn btn-danger form-control">Annuler la commande</a>