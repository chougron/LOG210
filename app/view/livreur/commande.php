<h3>Description de la commande</h3>

<table class="table table-striped table-bordered">
    <?php $items = $commande->getItems(); ?>
    <tbody>
        <tr>
            <td>Numéro de validation :</td>
            <td><?php echo $commande->getConfirmation();?></td>
        </tr>
        <tr>
            <td>Date et heure :</td>
            <td><?php echo $commande->getDatetime(); ?></td>
        </tr>
        <?php if($commande->getTimeAcceptation()): ?>
        <tr>
            <td>Date et heure : (acceptation)</td>
            <td><?php echo date( "d/m/Y H:i", $commande->getTimeAcceptation() ) ?></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td>Items commandés :</td>
            <td>
                <?php
                    foreach($items as $item) :
                    echo $item->getName(); ?>
                    (x <?php echo $item->quantity;?>)
                <br />
                <?php endforeach; ?>
            </td>
        </tr>
        <tr>
            <td>Adresse de livraison :</td>
            <td>
                <?php echo $commande->getAddress()->getAddress(); ?>
            </td>
        </tr>
    </tbody>
</table>


<?php if(!$commande->getLivreur()): ?>
<form role="form" action="livreur/addCommande/<?php echo $commande->getId(); ?>" method="POST">
    <button type="submit" class="btn btn-default center-block">Accepter la commande</button>
</form>
<?php else: ?>
    <?php if($commande->getLivreur()->getId() != $user->getId()): ?>
    Cette commande a déjà été acceptée par un autre livreur. (<?php echo $commande->getLivreur()->getName(); ?>)
    <?php else: ?>
    Vous avez déjà accepté cette commande.
    <?php endif; ?>

<?php endif; ?>