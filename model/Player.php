<?php
require_once('Manager.php');

class Player extends Manager
{
    private $_name;
    private $_fisrtName;
    private $_pseudo;
    private $_email;
    private $_pass;

    public function loginAlreadyTaken($pseudo, $eMail)
    {
        $db = $this->dbConnect();
        $player = $db->prepare('SELECT * FROM player WHERE pseudo=? OR email=?');
        $player->execute(array($pseudo, $eMail));
        $foundLines = $player->rowCount();

        return $foundLines;
    }

    public function signPlayerUp($name, $firstName, $pseudo, $eMail, $pass)
    {
        $db = $this->dbConnect();
        $newPlayer = $db->prepare('INSERT INTO player(name, first_name, pseudo, email, pass) VALUES(:name, :first_name, :pseudo, :email, :pass)');
        $newPlayer->execute(array(
            'name' => $name,
            'first_name' => $firstName,
            'pseudo' => $pseudo,
            'email' => $eMail,
            'pass' => $pass
        ));

        return $newPlayer;
    }

    public function getPlayer($login)
    {
        $db = $this->dbConnect();
        $player = $db->prepare('SELECT * FROM player WHERE pseudo= :pseudo OR email= :email');
        $player->execute(array(
            'pseudo' => $login,
            'email' => $login
        ));
        $foundPlayer = $player->fetch();

        return $foundPlayer;
    }
    
}