
<?php

namespace App\View;

use App\Component\View;

class AccountCreationView extends View{
    protected $controller, $model;
    
    public function __construct(AccountCreationController $controller, AccountCreationModel $model) {
        $this->$controller = $controller;
        $this->$model = $model;
    }
    
    public function output(){
        ?><h1>Account creation</h1>
        <p><span class="error">* required field.</span></p>
        $form_output = '<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
           Username: <input type="text" name="username" value="<?php echo $username;?>">
           <span class="error">* <?php echo $usernameErr;?></span>
           <br><br>
           Password: <input type="password" name="password" value="<?php echo $password;?>">
           <span class="error">* <?php echo $passwordErr;?></span>
           <br><br>
           Confirm password: <input type="password" name="passwordConfirm" value="<?php echo $passwordConfirm;?>">
           <span class="error">* <?php echo $passwordConfirmErr;?></span>
           <br><br>
           E-mail: <input type="text" name="email" value="<?php echo $email;?>">
           <span class="error">* <?php echo $emailErr;?></span>
           <br><br>
           <input type="submit" name="submit" value="Submit"> 
        </form>';<?php
        
        return $form_output;
    }

    
}








