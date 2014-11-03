<h2><?php echo $restaurant->getName(); ?></h2>
<?php echo $restaurant->getDescription(); ?><br/><br/>

<div class="form-group">
    <label for="menuItems">Items</label>
    <select multiple name="menuItems[]" id="menuItems" class="form-control">
        <option value=""></option>
        
        <?php foreach($menuItems as $menuItems): ?>

        <?php endforeach; ?>
    </select>
  </div>
<div class="btn">
    <button   class="btn btn-primary">Commander</button>
</div>
