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
        <th>
            Supprimer
        </th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($menu->getMenuItems() as $item): ?>
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
            <td>
                <a href="restaurateur/doSupprimeItemMenu/<?php echo $item->getId();?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<br />
<form role="form" action="restaurateur/editeMenu/<?php echo $menu->getId(); ?>" method="POST">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
    </div>

    <div class="form-group">
        <label for="price">Prix</label>
        <input type="text" class="form-control" name="price" id="price" placeholder="Price" required>
    </div>

    <button type="submit" class="btn btn-default center-block" name="menu_edit_form">Ajouter</button>
</form>
<h4>Nom du menu</h4>
<form role="form" action="restaurateur/editeMenu/<?php echo $menu->getId(); ?>" method="POST">
    <div class="form-group">
        <input text="text" class="form-control" name="menuName" id="menuName" placeholder="MenuName" value="<?php echo $menu->getName();?>" required>
    </div>

    <button type="submit" class="btn btn-default center-block" name="menu_name_edit_form">Modifier</button>
</form>

<br/><br/>
<div class="form-group">
    <a href="restaurateur/selectRestaurant/<?php echo $menu->getRestaurant()->getId(); ?>" class="btn btn-danger form-control">Retour</a>
</div>