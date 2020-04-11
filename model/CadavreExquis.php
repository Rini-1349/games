<?php 
require_once('Game.php');

class CadavreExquis extends Game
{
    protected $_name = 'Cadavre exquis';
    protected $_nbPlayer = 3;
    private $_gameId = 1;
    private $_subject;
    private $_verb;
    private $_complement;


    public function uncompletedPlays($playerId)
    {
        $db = $this->dbConnect();
        $uncompletedPlays = $db->prepare('SELECT * 
        FROM cadavre_exquis 
        WHERE (subject IS NULL OR verb IS NULL OR complement IS NULL)
        ORDER BY id');
        $uncompletedPlays->execute(array($playerId));
        

        return $uncompletedPlays;
    }

    public function newPlay()
    {
        $db = $this->dbConnect();
        $newPlay = $db->prepare('INSERT INTO cadavre_exquis(game_id) VALUES(?)');
        $newPlay->execute(array($this->_gameId));

        return $newPlay;
    }
}