<?php

    use thecodeisbae\Viewing\View as View;
    use thecodeisbae\Accumulator\Accumulator;
    use thecodeisbae\Model\User;

    include_once(_MODELS_PATH.'User.php');

    final class LoginController

    {

        static public $uri;

        static public $params;

        static public $method;

        function index()
        {
            return View::render('login');
        }

        function checkLogin()
        {
            $login = $_REQUEST['login'];
            $password = $_REQUEST['password'];
            $user = User::where('user_email',$login)->first();
            if($user)
            {
                if(password_verify($password,$user->user_password))
                {
                    echo "true||Authentification réussie";
                    exit;
                }else{
                    echo "false||Vérifier vos paramètres de connexions";
                    exit;
                }
            }
            
            echo "false||Votre adresse email est introuvable";
            exit;
           
        }

    }

    

    LoginController::$uri = $main_segment;

    LoginController::$method = $method;

    LoginController::$params = $params;

    

    switch($function)
    {
        case 'index':
            LoginController::index();
            break;

        case 'checkLogin':
            LoginController::checkLogin();
            break;

        default:

            break;

    }
