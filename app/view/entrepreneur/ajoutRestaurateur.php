<h3>Ajout d'un restaurateur</h3>

<form role="form" action="entrepreneur/ajoutRestaurateur" method="POST">
  <div class="form-group">
    <label for="mail">Email</label>
    <input type="email" class="form-control" id="mail" placeholder="Email" name="mail" required>
  </div>
    
  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password" required>
  </div>
    
  <div class="form-group">
    <label for="password_check">Confirmation du mot de passe</label>
    <input type="password" class="form-control" id="password_check" placeholder="Confirmation du mot de passe" name="password_check" required>
  </div>
    
  <div class="form-group">
    <label for="name">Nom</label>
    <input type="text" class="form-control" id="name" placeholder="Nom" name="name" required>
  </div>
    
  <div class="form-group">
    <label for="firstName">Prénom</label>
    <input type="text" class="form-control" id="firstName" placeholder="Prénom" name="firstName" required>
  </div>
    
  <div class="form-group">
    <label for="restaurants">Restaurants</label>
    <select multiple name="restaurants[]" id="restaurants" class="form-control">
        <option value=""></option>
        <?php foreach ($restaurants as $restaurant):?>
        <option value='<?php echo $restaurant->getId();?>'><?php echo $restaurant->getName();?></option>
        <?php endforeach; ?>
    </select>
  </div>
    
  <button type="submit" class="btn btn-default center-block" name="restaurateur_add_form">Valider</button>
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
