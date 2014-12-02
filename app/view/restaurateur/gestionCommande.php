<?php
use App\Model\Commande;
?>
<h3>Gérer les commandes</h3>

<table class="table table-striped table-bordered">
    <thead>
    <th>Numéro de validation</th>
    <th>Date et heure</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php foreach($commandes as $commande):
        if($commande->getStatus() == Commande::COMMAND_STATUS_PAYED) : ?>
            <tr>
                <td><?php echo $commande->getConfirmation();?></td>
                <td><?php echo $commande->getDatetime(); ?></td>
                <td>
                    <a href="restaurateur/editeMenu/<?php echo $commande->getId();?>">Préparer</a>
                </td>
            </tr>
    <?php endif;
    endforeach; ?>
    </tbody>
</table>