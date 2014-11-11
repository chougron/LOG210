<h3>Éditer un menu</h3>

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            Nom
        </th>
        <th>
            Description
        </th>
        <th>
            Prix
        </th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($restaurant->getMenu()->getMenuItems() as $item): ?>
        <tr>
            <td>
                <?php echo $item->getName(); ?>
            </td>
            <td>
                <?php echo $item->getDescription(); ?>
            </td>
            <td>
                <?php echo $item->getPrice(); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br />
<form role="form" action="restaurateur/editeMenu/<?php echo $restaurant->getId(); ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nom" >
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Price">
    </div>

    <button type="submit" class="btn btn-default center-block" name="menu_edit_form">Ajouter</button>
</form>
<h5>Nom du menu</h5>
<form role="form" action="restaurateur/editeMenu/<?php echo $restaurant->getId(); ?>" method="POST">
    <div class="form-group">
        <input text="text" class="form-control" name="menuName" id="menuName" placeholder="MenuName" value="<?php echo $restaurant->getMenu()->getName();?>">
    </div>

    <button type="submit" class="btn btn-default center-block" name="menu_name_edit_form">Modifier</button>
</form>
