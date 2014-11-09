<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();
$menuItems = array(
    array("item1", "5.50"),
    array("item2", "5.51"),
    array("item3", "5.52"),
    array("item4", "5.53"));
?><br/>


<div class="form-group">
    <label for="menuItems">Items</label><br/>

<?php foreach ($menuItems as $menuItem): ?> 
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">  
                    
                    
                        <div class="text-left">
                            <?php echo $menuItem[0]; ?>
                        </div>
                        <div class="text-right">
    Prix : <?php echo $menuItem[1]; ?>
                        </div>
                    <div class="col-sm-offset-9">
                        <div class="input-group">

                            <input type="number" class="form-control" value="0">
                            <span class="input-group-addon">Quantité</span>
                        </div><!-- /input-group -->
                    </div>
                </div><!-- /.row -->
            </div></div>
<?php endforeach; ?>
</div>
<div class="btn">
    <button   onclick="myFunction()" class="btn btn-primary">Ajouter au panier</button>
</div>

<script>
    function myFunction() {
        alert("Les items sélectionnés ont étés ajoutés au panier.");
    }
</script>