<h3>Éditer le menu d'un restaurant</h3>

<table class="table table-striped table-bordered">
    <thead>
        <th>Nom</th>
        <th>Éditer</th>
    </thead>
    <tbody>
        <?php foreach($menus as $menu):?>
        <tr>
            <td><?php echo $menu->getName();?></td>
            <td>
                <a href="restaurateur/editeMenu/<?php echo $menu->getId();?>">Éditer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>