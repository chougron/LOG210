<h3>Édition d'un restaurateur</h3>

<form role="form" action="entrepreneur/editeRestaurateur/<?php echo $restaurateur->getId(); ?>" method="POST">
  <div class="form-group">
    <label for="mail">Email</label>
    <input type="email" class="form-control" id="mail" placeholder="Email" name="mail" value="<?php echo $restaurateur->getMail(); ?>" required>
  </div>
    
  <div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" placeholder="Nom" name="name" value="<?php echo $restaurateur->getName(); ?>" required>
  </div>
    
  <div class="form-group">
    <label for="firstName">Prénom</label>
    <input type="text" class="form-control" id="firstName" placeholder="Prénom" name="firstName" value="<?php echo $restaurateur->getFirstName(); ?>" required>
  </div>
    
  <div class="form-group">
    <label for="restaurants">Restaurants</label>
    <select multiple name="restaurants[]" id="restaurants" class="form-control">
        <option value=""></option>
        <?php foreach ($restaurants as $restaurant):?>
        <option value='<?php echo $restaurant->getId();?>' <?php if(in_array($restaurant->getId(), $owned_restaurants)){ echo "selected"; } ?>><?php echo $restaurant->getName();?></option>
        <?php endforeach; ?>
    </select>
  </div>
    
  <button type="submit" class="btn btn-default center-block" name="restaurateur_edit_form">Valider</button>
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
