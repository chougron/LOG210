<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();
if ($restaurant->hasMenu()) {
    $menuItems = array();
    $menuItems = $restaurant->getMenu()->getMenuItems();
    ?>
    <div class = "row">
        <form action = "order" method = "post">
        Menu : <br/>
        <?php foreach ($menuItems as $menuItem): ?>
            <div class = "col-lg-10">Id : <?php echo $menuItem->getId();
        ?> | Nom : <?php echo $menuItem->getName(); ?> | Prix : <?php echo $menuItem->getPrice(); ?> </div><br/>
            <div class="col-lg-10">Quantité : <input type="number" value="0" name="<?php echo $menuItem->getId();
        ?>" required></div><br/>
    <?php endforeach; ?>
        <div class="col-lg-10">
            Adresse de livraison :
            <select name="adress">
                <option value="altAdress">Adresse alternative</option>
                <option value="primaryAdress" selected><?php echo $client->getAdress(); ?></option>
                <option value="secAdress"><?php echo $client->getSecAdress(); ?></option>
            </select>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input id="adresseTextField" type="text" class="form-control" placeholder="Adresse alternative" name="altAdress">
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    <input type="submit" value="Commander" name="order_form">
    </form>
    <?php }else{ ?>
        Ce restaurant n'a pas encore de menu.
    <?php
}