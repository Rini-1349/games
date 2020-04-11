<?php
require_once('model/Player.php');
require_once('model/CadavreExquis.php');
require_once('model/PlayGame.php');

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
        header('Location: index.php?action=homepage');
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

function enrollPlayer($playerId)
{      
    $playGame = new PlayGame();
    $cadavreExquis = new CadavreExquis();

    $enrolledInPlay = $playGame->enrolledInPlay($playerId);
    if (!$enrolledInPlay)
    {
        $uncompletedPlays = $cadavreExquis->uncompletedPlays($playerId);
        if ($uncompletedPlays)
        {
            $break=0;
            $result=0;
            while ($uncompletedPlay = $uncompletedPlays->fetch() AND $break==0)
            {
                $alreadyPlayedGame = $playGame->alreadyPlayedGame($uncompletedPlay['id'], $playerId);
                if (!$alreadyPlayedGame)
                {
                    $break=1;
                    $result=0;
                    $gameId = $uncompletedPlay['id'];

                    if ($uncompletedPlay['verb']==NULL)
                    {
                        $choice='verb';
                    }
                    else
                    {
                        $choice='complement';
                    }
                }
                else
                {                   
                    $result=1;
                }
            }
            if ($result==1)  
            {
                $newPlay = $cadavreExquis->newPlay();
                $uncompletedPlays = $cadavreExquis->uncompletedPlays($playerId);
                $uncompletedPlay = $uncompletedPlays->fetch();
                $gameId = $uncompletedPlay['id'];
                $choice = 'subject';
            }
        }
        else
        {
            $newPlay = $cadavreExquis->newPlay();
            $uncompletedPlays = $cadavreExquis->uncompletedPlays($playerId);
            $uncompletedPlay = $uncompletedPlays->fetch();
            $gameId = $uncompletedPlay['id'];
            $choice = 'subject';
        }
        $enrollPlayer = $playGame->enrollPlayer($playerId, $gameId, $choice);
    }
    else
    {
        echo 'Jeu en cours - Terminez votre partie';
    }   
}