<?php
require_once('model/Player.php');
require_once('model/CadavreExquis.php');
require_once('model/PlayGame.php');

function homepage()
{
    require('view/frontend/homepageView.php');
}

function connectionForm($errorMessageConnection, $errorMessageSignUp)
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
    $errorMessageSignUp='';
    if (!$foundPlayer)
    {
        $errorMessageConnection = 'Login ou mot de passe incorrect';
        connectionForm($errorMessageConnection, $errorMessageSignUp);
    }
    else
    {
        $isPasswordCorrect = password_verify($pass, $foundPlayer['pass']);
        if ($isPasswordCorrect)
        {
            session_start();
            $_SESSION = array(
                'player_id' => $foundPlayer['id'],
                'name' => $foundPlayer['name'],
                'first_name' => $foundPlayer['first_name'],
                'pseudo' => $foundPlayer['pseudo'],
            );
            header('Location: index.php?action=homepage');
        }
        else
        {
            $errorMessageConnection = 'Login ou mot de passe incorrect';
            connectionForm($errorMessageConnection, $errorMessageSignUp);
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
        $uncompletedPlay = $cadavreExquis->uncompletedPlays($playerId);
        if (empty($uncompletedPlay))
        {
            $newPlay = $cadavreExquis->newPlay();
            $createdPlay = $cadavreExquis->createdPlay();
            $gameId = $createdPlay['id'];
            $choice = 'subject';
        }
        else
        {
            $gameId = $uncompletedPlay['id'];
            if ($uncompletedPlay['verb']==NULL)
            {
                $choice = 'verb';
                $response = 'Verbe';
                $chooseVerb = $cadavreExquis->updateResponse($gameId, $choice, $response);
            }
            else
            {
                $choice = 'complement';
                $response = 'Complément';
                $chooseComplement = $cadavreExquis->updateResponse($gameId, $choice, $response);
            }
        }
        $enrollPlayer = $playGame->enrollPlayer($playerId, $gameId, $choice);
    }
    else
    {
        $gameId = $enrolledInPlay['game_id'];
        $choice = $enrolledInPlay['choice'];
    }   
    require('view/frontend/playView.php');
}

function saveResponse($playerId, $gameId, $choice, $response)
{
    $playGame = new PlayGame();
    $cadavreExquis = new CadavreExquis();
    $updatedResponse = $cadavreExquis->updateResponse($gameId, $choice, $response);
    $endGame = $playGame->endGame($playerId, $gameId);
    header('Location: index.php?action=homepage');
}