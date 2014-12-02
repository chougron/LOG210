<h3>Mes commandes</h3>

<table class="table table-striped table-bordered">
    <thead>
    <th>Numéro de validation</th>
    <th>Date et heure</th>
    <th>Action</th>
    </thead>
    <tbody>
    <?php foreach($commandes as $commande): ?>
        <tr>
            <td><?php echo $commande->getConfirmation();?></td>
            <td><?php echo $commande->getDatetime(); ?></td>
            <td>
                <a href="livreur/commande/<?php echo $commande->getId();?>">Sélectionner</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>