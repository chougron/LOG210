<h3>Suppression d'un restaurant</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                Nom
            </th>
            <th>
                Supprimer
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($restaurants as $restaurant): ?>
        <tr>
            <td>
                <?php echo $restaurant->getName(); ?>
            </td>
            <td>
                <a href="entrepreneur/doSupprimeRestaurant/<?php echo $restaurant->getId(); ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
