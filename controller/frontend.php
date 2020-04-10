<?php
require_once('model/Player.php');

function signUpForm($errorMessage)
{
    require('view/frontend/signUpView.php');
}

function addPlayer($name, $firstName, $pseudo, $eMail, $pass)
{
    $player = new Player();
    $foundLines = $player->getPlayer($pseudo, $eMail);
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