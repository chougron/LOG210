<h3>Suppression d'un restaurateur</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                Prénom
            </th>
            <th>
                Nom
            </th>
            <th>
                Supprimer
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($restaurateurs as $restaurateur): ?>
        <tr>
            <td>
                <?php echo $restaurateur->getFirstName(); ?>
            </td>
            <td>
                <?php echo $restaurateur->getName(); ?>
            </td>
            <td>
                <a href="entrepreneur/doSupprimeRestaurateur/<?php echo $restaurateur->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
