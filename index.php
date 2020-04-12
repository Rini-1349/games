<?php 
session_start();

require('controller/frontend.php');

try 
{
    if (isset ($_GET['action']))
    {
        $action = htmlspecialchars($_GET['action']);

        if ($action == 'homepage')
        {
            homepage();
        }
        elseif ($action == 'connection')
        {
            $errorMessageConnection = '';
            $errorMessageSignUp = '';
            if (isset($_POST['login']) AND isset($_POST['pass']))
            {
                $login=htmlspecialchars($_POST['login']);
                $pass=htmlspecialchars($_POST['pass']);
                connectionPlayer($login, $pass);
            }
            elseif (isset ($_POST['name']) AND isset ($_POST['first_name']) AND isset ($_POST['pseudo']) AND isset ($_POST['email']) AND isset ($_POST['pass']) and isset ($_POST['pass_confirm']))
            {
                $name = htmlspecialchars($_POST['name']);
                $first_name = htmlspecialchars($_POST['first_name']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $email = htmlspecialchars($_POST['email']);
                $pass = htmlspecialchars($_POST['pass']);
                $pass_confirm = htmlspecialchars($_POST['pass_confirm']);

                if (!preg_match("#^[a-z0-9_.-]+@[a-z0-9_.-]{2,}\.[a-z]{2,4}$#", $email))
                {
                    $errorMessageSignUp = 'Format d\'adresse email non valide';
                    connectionForm($errorMessageConnection, $errorMessageSignUp);
                }
                elseif (!preg_match("#^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[0-9])(?=\S*[\W])\S{8,20}$#", $pass))
                {
                    $errorMessageSignUp = 'Le mot de passe doit contenir entre 8 et 20 caractères dont 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial';
                    connectionForm($errorMessageConnection, $errorMessageSignUp);
                }
                elseif ($pass != $pass_confirm)
                {
                    $errorMessageSignUp = 'Mots de passe différents';
                    connectionForm($errorMessageConnection, $errorMessageSignUp);
                }
                else
                {
                    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                    addPlayer($name, $first_name, $pseudo, $email, $hashedPass);
                }              
            }
            else
            {
                connectionForm($errorMessageConnection, $errorMessageSignUp);
            }
        }
        elseif ($action == 'sessionDestoy')
        {
            session_unset();
            session_destroy();
            homepage();
        }
        elseif ($action == 'play')
        {
            if (isset($_GET['playerId']) AND isset($_GET['gameId']) AND isset($_GET['choice']) AND isset($_POST['response']))
            {
                $playerId = htmlspecialchars($_GET['playerId']);
                $gameId = htmlspecialchars($_GET['gameId']);
                $choice = htmlspecialchars($_GET['choice']);
                $response = htmlspecialchars($_POST['response']);     
                saveResponse($playerId, $gameId, $choice, $response);  
            }
            elseif ($_SESSION)
            {
                enrollPlayer($_SESSION['player_id']);
            }
            else
            {
                header('Location: index.php?action=connection');
            }
        }
    }
    else 
    {
        homepage();
    }
}
catch(Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}