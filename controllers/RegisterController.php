<?php

    use thecodeisbae\Viewing\View as View;
    use thecodeisbae\Accumulator\Accumulator;
    use thecodeisbae\Model\User;

    include_once(_MODELS_PATH.'User.php');

    final class RegisterController

    {

        static public $uri;

        static public $params;

        static public $method;

        function index()
        {
            return View::render('register');
        }

        function register()
        {
            try{
                User::create([
                    'user_firstname'=>$_REQUEST['nom'],
                    'user_lastname'=>$_REQUEST['prenoms'],
                    'user_email'=>$_REQUEST['email'],
                    'user_password'=>password_hash($_REQUEST['password'],PASSWORD_DEFAULT)
                ]);
                echo "true||Compte crée avec succès";
                exit;
            }catch(Exception $ex)
            {
                debug($ex);
                echo "false||Une erreur s'est produite";
                exit;          
            } 
        }

    }

    

    RegisterController::$uri = $main_segment;

    RegisterController::$method = $method;

    RegisterController::$params = $params;

    

    switch($function)
    {

        case "index":
            RegisterController::index();
            break;

        case "submitRegisterAjax":
            RegisterController::register();
            break;

        default:

            break;

    }
