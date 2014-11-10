<h3>Éditer le menu d'un restaurant</h3>

<table class="table table-striped table-bordered">
    <thead>
        <th>Nom</th>
        <th>Éditer</th>
    </thead>
    <tbody>
        <?php foreach($restaurants as $restaurant):?>
        <tr>
            <td><?php echo $restaurant->getName();?></td>
            <td>
                <a href="restaurateur/editeMenu/<?php echo $restaurant->getId();?>">Éditer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>