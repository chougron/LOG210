<h2><?php echo $restaurant->getName(); ?></h2>
<?php echo $restaurant->getDescription(); ?><br/>


<div class="form-group">
    <label for="menuItems">Items</label>
    <select multiple name="menuItems[]" id="menuItems" class="form-control">
        <option value=""></option>
        
        <?php foreach($menuItems as $menuItems): ?>
            
        <?php endforeach; ?>
    </select>
  </div>
<div class="btn">
    <button   onclick="myFunction()" class="btn btn-primary">Ajouter au panier</button>
</div>

<script>
function myFunction() {
    alert("Les items sélectionnés ont étés ajoutés au panier.");
}
</script>