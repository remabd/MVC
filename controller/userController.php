<?php
class userController
{
    private $userManager;
    private $db;
    public function __construct($db1)
    {
        require_once('./model/User.php');
        require_once('./model/UserManager.php');
        $this->userManager = new UserManager($db1);
        $this->db = $db1;
    }
    public function login()
    {
        $page = 'login';
        require('./View/default.php');
    }
    public function doLogin()
    {
        echo 'herrrre';
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $result = $this->userManager->findOneByEmail($email);
        $passwdCorrect = sha1($password) == $result->getPassword();

        if ($result && $passwdCorrect):
            $info = "Connexion reussie";
            $_SESSION['user'] = $result;
            $page = 'home';
        else:
            $info = "Identifiants incorrects.";
        endif;
        require('./View/default.php');
    }

    public function doCreate(
    ) {
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            isset($_POST['lastName']) &&
            isset($_POST['firstName']) &&
            isset($_POST['address']) &&
            isset($_POST['postalCode']) &&
            isset($_POST['city'])
        ) {
            $alreadyExist = $this->userManager->findOneByEmail($_POST['email']);
            if (!$alreadyExist) {
                $newUser = new User($_POST);
                $newUser->setPassword(sha1($newUser->getPassword()));
                $this->userManager->create($newUser);
                $info = "Utilisateur enregistré";
                $page = 'login';
            } else {
                $info = "ERROR : This email (" . $_POST['email'] . ") is used by another user";
                $page = 'createForm';
            }
        }
        require('./View/default.php');
    }

    public function create()
    {
        $page = 'createForm';
        require('./View/default.php');
    }

    public function home()
    {
        $page = 'home';
        require('View/default.php');
    }

    public function isConnected()
    {
        return isset($_SESSION['user']);
    }
    public function isAdmin()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin');
    }

    public function doDisconnect()
    {
        unset($_SESSION['user']);
        $page = 'home';
        require('View/default.php');
    }

}