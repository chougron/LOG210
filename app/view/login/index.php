
<h1>Login</h1>
<form action="login" method="post">
    <input type="email" placeholder="E-mail" name="mail" required><br/>
    <input type="password" placeholder="Mot de passe" name="password" required><br/>
    <input type="submit" value="Valider" name="login_form">
</form><br />

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
