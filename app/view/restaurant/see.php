<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();
if ($restaurant->hasMenu()):
    $menus = $restaurant->getMenus(); ?>

    <div class="row">
        <form action = "restaurant/see/<?php echo $restaurant->getId(); ?>" method = "post">
            <?php foreach ($menus as $menu):
                $menuItems = $menu->getMenuItems();?>

            <h3><?php echo $menu->getName(); ?> :</h3>

            <?php foreach ($menuItems as $menuItem): ?>
                <div class="form-group"><?php echo $menuItem->getName(); ?> | Prix : <?php echo $menuItem->getPrice(); ?>
                    | Quantité : <input type="number" value="0" name="<?php echo $menuItem->getId(); ?>" class="form-control" required min="0">
                </div>
            <?php endforeach; ?>
            <?php endforeach; ?>

            <div class="form-group">
                Adresse de livraison :
                <select name="address" class="form-control" required>
                    <?php $mainAddress = \App\Component\Session::getUser()->getAddress(); ?>
                    <?php /*
                    <?php var_dump($mainAddress); ?>
                    <?php var_dump(\App\Component\Session::getUser()); ?>
                     */?>
                    <?php foreach ($addresses as $address): ?>
                    <option value="<?php echo $address->getId(); ?>" <?php if($address->getId() == $mainAddress->getId()): ?> selected<?php endif; ?>>
                        <?php echo $address->getAddress(); ?>
                    </option>
                    <?php endforeach; ?>
                    <option value="altAddress">Adresse alternative</option>
                </select>
            </div>
            <div class="form-group">
                <input id="adresseTextField" type="text" class="form-control" placeholder="Adresse alternative" name="altAdress">
            </div><!-- /input-group -->

            <div class="form-group">
                <input type="submit" value="Commander" name="order_form" class="btn btn-primary form-control">
            </div>
        </form>
    </div><!-- /.row -->
<?php else: ?>
    Ce restaurant n'a pas encore de menu.
<?php endif; ?>