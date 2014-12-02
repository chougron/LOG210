<h1>Profile</h1>
<hr/>

<form action="profile" method="post">

    <div class="form-group">
        <input type="email" placeholder="E-mail" name="mail" value="<?php echo $user->getMail(); ?>" disabled required class="form-control">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Mot de passe" name="password"  class="form-control">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Vérification" name="password_check"  class="form-control">
    </div>
    <div class="form-group">
        <input type="text" placeholder="Prénom" name="firstName" value="<?php echo $user->getFirstName(); ?>" required class="form-control">
    </div>
    <div class="form-group">
        <input type="text" placeholder="Nom" name="name" value="<?php echo $user->getName(); ?>" required class="form-control">
    </div>
    <div class="form-group">
        <input type="text" placeholder="Adresse" name="mainAddress" value="<?php echo $user->getAddress()->getAddress(); ?>" required class="form-control">
    </div>
    <div class="form-group">
        <input type="tel" placeholder="Téléphone" name="phoneNumber" value="<?php echo $user->getPhoneNumber(); ?>" required class="form-control">
    </div>
    <div class="form-group">
        <input type="date" placeholder="Date de Naissance" name="birthday" value="<?php echo $user->getBirthday(); ?>" required class="form-control">
    </div>
    <button type="submit" name="profile_form" class="btn btn-success form-control">Valider</button>
</form>

<?php if (isset($error)): ?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>