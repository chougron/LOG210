<h2><?php echo $restaurant->getName(); ?></h2>
<?php
echo $restaurant->getDescription();
if($restaurant->hasMenu()){
    $menuItems = $restaurant->getMenu()->getMenuItems();
    ?>
    <form action="order" method="post">
        Menu : 
    <input type="email" placeholder="E-mail" name="mail" required><br/>
    <input type="password" placeholder="Mot de passe" name="password" required><br/>
    <input type="password" placeholder="Vérification" name="password_check" required><br/>
    <input type="text" placeholder="Prénom" name="firstName" required><br/>
    <input type="text" placeholder="Nom" name="name" required><br/>
    <input type="text" placeholder="Adresse principale" name="mainAddress" required><br/>
    <input type="text" placeholder="Adresse secondaire" name="secAddress" ><br/>
    <input type="tel" placeholder="Téléphone" name="phoneNumber" required><br/>
    <input type="date" placeholder="Date de Naissance" name="birthday" required><br/>
    <input type="submit" value="Valider" name="register_form">
</form>
<?php 
}else{ 
    ?>
<div class="row">

    <form action="order" method="post">
        Menu : <br/>
        <div class="col-lg-10">Id : 005 | Nom : Item1 | Prix : 005 </div><br/>
        <div class="col-lg-10">Quantité : <input type="number" value="0" name="005" required></div><br/>
        
    <div class="col-lg-10">
        Adresse de livraison :
        <select>
            <option value="altAdress">Adresse alternative</option>
            <option value="primaryAdress" selected><?php echo $client->getAdress(); ?></option>
            <option value="secAdress"><?php echo $client->getSecAdress(); ?></option>
        </select>
    </div>
  <div class="col-lg-6">
    <div class="input-group">
        <input id="adresseTextField" type="text" class="form-control" placeholder="Adresse alternative">
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
        <input type="submit" value="Commander" name="order_form">
    </form>
<?php }