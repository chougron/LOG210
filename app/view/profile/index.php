



<h1>Profile</h1>
<form action="profile" method="post">
    <input type="email" placeholder="E-mail" name="mail" value="<?php echo $user->getMail(); ?>" disabled required><br/>
    <input type="password" placeholder="Mot de passe" name="password" ><br/>
    <input type="password" placeholder="Vérification" name="password_check" ><br/>
    <input type="text" placeholder="Prénom" name="firstName" value="<?php echo $user->getFirstName(); ?>" required><br/>
    <input type="text" placeholder="Nom" name="name" value="<?php echo $user->getName(); ?>" required><br/>
    <input type="text" placeholder="Adresse" name="mainAddress" value="<?php echo $user->getAdress(); ?>" required><br/>
    <input type="text" placeholder="Adresse secondaire" name="secAddress" value="<?php echo $user->getSecAdress(); ?>"><br/>
    <input type="tel" placeholder="Téléphone" name="phoneNumber" value="<?php echo $user->getPhoneNumber(); ?>" required><br/>
    <input type="date" placeholder="Date de Naissance" name="birthday" value="<?php echo $user->getBirthday(); ?>" required><br/>
    <input type="submit" value="Valider" name="profile_form">
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>