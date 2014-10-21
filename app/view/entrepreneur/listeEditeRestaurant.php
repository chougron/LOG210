<h3>Éditer un restaurant</h3>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>
                Nom
            </th>
            <th>
                Éditer
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
                <a href="entrepreneur/editeRestaurant/<?php echo $restaurant->getId(); ?>">Éditer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
