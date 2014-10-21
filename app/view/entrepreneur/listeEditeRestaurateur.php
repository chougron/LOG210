<h3>Éditer un restaurateur</h3>

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
                Éditer
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
                <a href="entrepreneur/editeRestaurateur/<?php echo $restaurateur->getId(); ?>">Éditer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
