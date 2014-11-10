<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();
$menuItems = array(
    array("item1", "5.50"),
    array("item2", "5.51"),
    array("item3", "5.52"),
    array("item4", "5.53"));
if($restaurant->hasMenu()){
    $menuItemsTest = $restaurant->getMenu()->getMenuItems();  
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
    <button   onclick="addToOrder()" class="btn btn-primary">Rafraîchir la commande</button>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<div class="btn">
    <button   onclick="processOrder()" class="btn btn-primary">Commander</button>
</div>



