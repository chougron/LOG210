<?php

namespace App\Controller;

use App\Component\Controller;
use App\Component\View;
use App\Component\Session;
use App\Model\AccountCreationModel;

class AccountCreationController extends Controller {

    public function index() {

        $accountCreationModel = new AccountCreationModel("Valeur de test");
        $value = $accountCreationModel->getUsername();


        $usernameErr = $emailErr = $passwordErr = "";
        $username = $email = $password = $passwordConfirm = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Username is required";
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                    $nameErr = "Only letters and white space allowed";
                }
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = test_input($_POST["password"]);
                if (!preg_match($passwordConfirm, $password)) {
                    $nameErr = "Passwords does not match";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }
        }

        View::render("index/AccountCreationView.php", NULL);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function btnCreateAction() {
        debug_to_console("btnCreate was clicked");
        if (validateEntries()){
            
        }
    }
    
    public function validateEntries(){
        
        return true; //temporaire.
    }

    function debug_to_console($data) {

        if (is_array($data))
            $output = "<script>console.log( 'Debug Objects: " . implode(',', $data) . "' );</script>";
        else
            $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

        echo $output;
    }

}
