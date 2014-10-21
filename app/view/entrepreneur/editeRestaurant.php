<h3>Édition d'un restaurant</h3>

<form role="form" action="entrepreneur/editeRestaurant/<?php echo $restaurant->getId(); ?>" method="POST">
  <div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" placeholder="Nom" name="name" value="<?php echo $restaurant->getName(); ?>" required>
  </div>
    
  <div class="form-group">
    <label for="restaurateur">Restaurateur</label>
    <select name="restaurateur" id="restaurateur" class="form-control">
        <option value=""></option>
        <?php foreach ($restaurateurs as $restaurateur):?>
        <option value='<?php echo $restaurateur->getId();?>' <?php if($restaurant->getRestaurateur() && $restaurateur->getId() == $restaurant->getRestaurateur()->getId()){ echo "selected"; } ?>><?php echo $restaurateur->getFirstName() . " " . $restaurateur->getName();?></option>
        <?php endforeach; ?>
    </select>
  </div>
    
  <button type="submit" class="btn btn-default center-block" name="restaurant_edit_form">Valider</button>
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
