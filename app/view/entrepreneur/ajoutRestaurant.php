<h3>Ajout d'un restaurant</h3>

<form role="form" action="entrepreneur/ajoutRestaurant" method="POST">
  <div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" placeholder="Nom" name="name" required>
  </div>
    
  <div class="form-group">
    <label for="name">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
  </div>
    
  <div class="form-group">
    <label for="restaurateur">Restaurateur</label>
    <select name="restaurateur" id="restaurateur" class="form-control">
        <option value=""></option>
        <?php foreach ($restaurateurs as $restaurateur):?>
        <option value='<?php echo $restaurateur->getId();?>'><?php echo $restaurateur->getFirstName() . " " . $restaurateur->getName();?></option>
        <?php endforeach; ?>
    </select>
  </div>
    
  <button type="submit" class="btn btn-default center-block" name="restaurant_add_form">Valider</button>
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
