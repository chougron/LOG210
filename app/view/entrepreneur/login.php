<h1 class="text-center">Accès Entrepreneur</h1>
<hr/>

<form action="entrepreneur/login" class="" method="post" role="form">
    <div class="form-group">
        <input type="text" placeholder="Email" name="mail" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="password" placeholder="Password" name="password" class="form-control" required>
    </div>
    <button type="submit" name="entrepreneur_login_form" class="btn btn-success form-control">Login</button>
</form>


<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
