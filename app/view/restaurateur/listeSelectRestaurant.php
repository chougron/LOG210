<h2>Sélectionner un restaurant</h2>
<hr/>
<table class="table table-striped table-bordered">
    <thead>
        <th>Nom</th>
        <th>Éditer</th>
    </thead>
    <tbody>
        <?php foreach($restaurants as $restaurant):?>
        <tr>
            <td><?php echo $restaurant->getName();?></td>
            <td>
                <a href="restaurateur/selectRestaurant/<?php echo $restaurant->getId();?>">Sélectionner</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if(isset($error)):?>
    Erreur : <?php echo $error; ?>
<?php endif; ?>
    
<div class="form-group">
    <a href="restaurateur" class="btn btn-danger form-control">Retour</a>
</div>