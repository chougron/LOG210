<h3>Gérer les commandes</h3>

<table class="table table-striped table-bordered">
    <?php $items = $commande->getItems(); ?>
    <thead>
    <th></th>
    <th></th>
    </thead>
    <tbody>
        <tr>
            <td>Numéro de validation :</td>
            <td><?php echo $commande->getConfirmation();?></td>
        </tr>
        <tr>
            <td>Date et heure :</td>
            <td><?php echo $commande->getDatetime(); ?></td>
        </tr>
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
    </tbody>
</table>

<form role="form" action="restaurateur/gererCommande/<?php echo $commande->getId(); ?>" method="POST">
    <button type="submit" class="btn btn-default center-block" name="finir_commande_form">Finir préparation</button>
</form>