<?php
use App\Component\Session;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <base href="http://localhost/log210/">
        <title>LOG210</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/main.css">
               
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>            
        <div class="navbar navbar-inverse" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            <?php if(Session::isConnected()): ?>
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="profile/">( tempo )</a></li> <!-- <?php// echo Session::getUser()->getFirstName(); ?> -->
                    <li><a href="disconnect/">Disconnect</a></li>
              </ul>  
            <?php else: ?>
              <form action="login" class="navbar-form navbar-right" method="post" role="form">
                  <div class="form-group">
                    <input type="text" placeholder="Email" name="mail" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="Password" name="password" class="form-control" required>
                  </div>
                  <button type="submit" name="login_form" class="btn btn-success">Login</button>
                </form>
            <?php endif; ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
            
      <div class="container">
      
