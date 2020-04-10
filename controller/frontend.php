<?php
require_once('model/Player.php');

function homepage()
{
    require('view/frontend/homepageView.php');
}

function signUpForm($errorMessage)
{
    require('view/frontend/signUpView.php');
}

function connectionForm()
{
    require('view/frontend/connectionView.php');
}

function addPlayer($name, $firstName, $pseudo, $eMail, $pass)
{
    $player = new Player();
    $foundLines = $player->loginAlreadyTaken($pseudo, $eMail);
    if ($foundLines == 0)
    {
        $player->signPlayerUp($name, $firstName, $pseudo, $eMail, $pass);
        echo 'Inscription effectuée';
    }
    else
    {
        $errorMessage = 'Pseudo ou adresse mail déjà utilisé(e)';
        signUpForm($errorMessage);
    }
}

function connectionPlayer($login, $pass)
{
    $player = new Player();
    $foundPlayer = $player->getPlayer($login);
    if (!$foundPlayer)
    {
        echo 'Login ou mot de passe incorrect';
    }
    else
    {
        $isPasswordCorrect = password_verify($pass, $foundPlayer['pass']);
        if ($isPasswordCorrect)
        {
            session_start();
            $_SESSION = array(
                'name' => $foundPlayer['name'],
                'first_name' => $foundPlayer['first_name'],
                'pseudo' => $foundPlayer['pseudo'],
            );
            header('Location: index.php?action=homepage');
        }
        else
        {
            echo 'Mot de passe incorrect';
        }
    }
}
