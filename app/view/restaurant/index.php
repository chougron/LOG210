<div class="row">
    
    <?php foreach($restaurants as $restaurant): ?>
    
    <div class="col-sm-4 restaurant">
        <div class="panel panel-info">
          <div class="panel-body restaurant-img" style="background: url('<?php echo $restaurant->getPicture(); ?>') center center no-repeat black;">
          </div>
          <div class="panel-heading restaurant-name">
              <h2 class="panel-title"><?php echo $restaurant->getName(); ?></h2>
          </div>
          <div class="panel-body restaurant-description">
              <?php echo $restaurant->getDescription(); ?>
              <br/><br/>
              <span class="pull-right">
                  <a href="restaurant/see/<?php echo $restaurant->getId(); ?>">Choisir ce restaurant</a>
              </span>
          </div>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>