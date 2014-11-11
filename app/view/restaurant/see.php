<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();;
if($restaurant->hasMenu()){
    $menuItems = $restaurant->getMenu()->getMenuItems();  
    echo "got menu.";
    
     foreach ($menuItems as $menuItem): ?> 
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">  
                    
                    
                        <div class="text-left">
                            <?php echo $menuItem->getId(), " : " ,$menuItem->getName(); ?>
                        </div>
                        <div class="text-right">
                            Prix : <?php echo $menuItem->getPrice(); ?>
                        </div>
                    <div class="col-sm-offset-9">
                        <div class="input-group">

                            <input type="number" class="form-control" min="0" value="0" >
                            <span class="input-group-addon">Quantité</span>
                        </div><!-- /input-group -->
                    </div>
                </div><!-- /.row -->
            </div></div>
    $menuItemQty = $menuItem->getId() => "0" ;
<?php endforeach;
}else{
    echo "restaurant has no menu";
}
$menuItemQty = array();
?><br/>


<div class="form-group">
    <label for="menuItems">Items</label><br/>


</div>
<div class="btn">
    <button   onclick="" class="btn btn-primary">Rafraîchir la commande</button>
</div>
<div class="row">
    <div class="col-lg-6">
        Adresse de livraison :
        <select>
            <option value="altAdress">Adresse alternative</option>
            <option value="primaryAdress" selected><?php echo $client->getAdress(); ?></option>
            <option value="secAdress"><?php echo $client->getSecAdress(); ?></option>
        </select>
    </div>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
        <input id="adresseTextField" type="text" class="form-control" placeholder="Adresse alternative">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="btn">
    <button   onclick="" class="btn btn-primary">Commander</button>
</div>


