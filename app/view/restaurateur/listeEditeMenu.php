<h2>Éditer un Restaurant</h2>
<hr/>
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

<form role="form" action="restaurateur/selectRestaurant/<?php echo $restaurant->getId(); ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required value="<?php echo $restaurant->getName(); ?>">
    </div>

<div class="form-group">
    <button type="submit" class="btn btn-primary form-control" name="menu_edit_form">Ajouter un menu</button>
</div>
</form>

<div class="form-group">
    <a href="restaurateur/selectRestaurant" class="btn btn-danger form-control">Retour</a>
</div>