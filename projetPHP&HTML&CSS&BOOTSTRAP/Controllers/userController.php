<?php

require_once("../Models/Database.class.php");
require_once("../Models/UserManager.php");

class userController {

    private $bdd;
    private $UserManager;

    public function __construct()
    {
        $bd = new database();
        $this->bdd = $bd->connectDb();
        $this->UserManager = new UserManager($this->bdd);
    }

    public function addU()
    {
        $login = htmlspecialchars($_POST["login"]);
        $email = htmlspecialchars($_POST["email"]);
        $pwd = password_hash($_POST["pwd"], PASSWORD_DEFAULT);  
        $u = array("login" => "$login", "email" => "$email", "pwd" => "$pwd");
        $new_user = new User($u);
        if ($this->UserManager->noRegister($new_user))
        {
            if ($this->UserManager->addUser($new_user)){
                $msg = "Votre inscription a été validée";
                include("../Views/connexion.php");
            } else {
                $msg = "Votre inscription n'a pas été validée";
                include("../Views/inscription.php");
            }
        } else {
            $msg = "L'adresse email ou le pseudo est déjà utilisé";
            include("../Views/inscription.php");
        }
    }

    public function connexion()
    {
        $loginmail = htmlspecialchars($_POST["loginmail"]);
        $pwd = htmlspecialchars($_POST["pwd"]);
        $u = array("login" => "$loginmail", "email" => "$loginmail", "pwd" => "$pwd");
        $new_user = new User($u);
        if ($this->UserManager->checkConnection($new_user)){
            $_SESSION["id"] = $new_user->Id();
            $_SESSION["login"] = $new_user->Login();
            $_SESSION["pwd"] = $new_user->Pwd();
            $_SESSION["email"] = $new_user->Email();
            include("../Views/profil.php");
        } else {
            $msg = "Identifiant ou mot de passe incorrect";
            include("../Views/connexion.php");
        }
    }

    public function deconnexion(){
        session_destroy();
        $msg = "Vous êtes bien déconnecté";
        Header("location: index.php");
    }

    public function afficheP(){
        include("../Views/profil.php");
    }

    public function afficheI(){
        include("../Views/inscription.php");
    }

    public function afficheC(){
        include("../Views/connexion.php");
    }
}

?>