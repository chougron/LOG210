<h1>Inscription</h1>
<form action="register" method="post">
    <input type="email" placeholder="E-mail" name="mail" required><br/>
    <input type="password" placeholder="Mot de passe" name="password" required><br/>
    <input type="password" placeholder="Vérification" name="password_check" required><br/>
    <input type="text" placeholder="Prénom" name="firstName" required><br/>
    <input type="text" placeholder="Nom" name="name" required><br/>
    <input type="text" placeholder="Adresse principale" name="mainAddress" required><br/>
    <input type="tel" placeholder="Téléphone" name="phoneNumber" required><br/>
    <input type="date" placeholder="Date de Naissance" name="birthday" required><br/>
    <input type="submit" value="Valider" name="register_form">
</form>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
